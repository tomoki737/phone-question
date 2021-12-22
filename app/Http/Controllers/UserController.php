<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::where('name', $name)->with('isFollowedBy')->withCount(['followers', 'followings'])->first();
        return ['user' => $user];
    }
    public function questions($name)
    {
        $user = User::where('name', $name)->first();
        $questions = $user->questions->sortByDesc('created_at')->load(['user', 'answers']);
        return ['questions' => $questions];
    }

    public function likes($name){
        $user = User::where('name', $name)->first();
        $questions = $user->likes->sortByDesc('created_at')->load(['user', 'answers']);
        return ['questions' => $questions];
    }

    public function answers($name){
        $user = User::where('name', $name)->first();
        $answers = $user->answers->sortByDesc('created_at')->load('question');
        return ['answers' => $answers];
    }
    public function followings($name){
        $user = User::where('name', $name)->first();
        $followings = $user->followings->sortByDesc('created_at');
        return [
            'user' => $user,
            'followings' => $followings,
        ];
    }

    public function followers($name){
        $user = User::where('name', $name)->first();
        $followers = $user->followers->sortByDesc('created_at');
        return [
            'user' => $user,
            'followers' => $followers,
        ];
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
