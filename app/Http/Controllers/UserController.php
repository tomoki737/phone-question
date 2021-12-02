<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\User;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::where('name', $name)->first();
        $questions = $user->questions->sortByDesc('created_at');
        return view('users.show', ['user' => $user, 'questions' => $questions]);
    }

    public function follow(Request $request, $name)
    {
        $user = User::where('name' ,$name)->first();
        if($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
        return ['name' => $name];
    }

    public function unfollow(Request $request, $name)
    {
        $user = User::where('name' ,$name)->first();
        if($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->followings()->detach($user);
        return ['name' => $name];
    }
}
