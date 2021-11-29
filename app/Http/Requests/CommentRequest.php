<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => 'required|max:500',
        ];
    }

    public function attributes()
    {
        return [
            'body' => '本文',
        ];
    }
}
