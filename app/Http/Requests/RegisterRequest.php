<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|string|min:2|max:32|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
            'birthday' => 'required|date',
            'avatar_url' => 'nullable|mimes:jpeg,png,jpg,svg|max:4096',
        ];
    }
}
