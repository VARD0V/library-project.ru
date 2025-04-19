<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }
    public function rules(): array
    {
        return [
            'birthday' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
            'login' => 'required|string|min:2|max:32|unique:users',
            'avatar_url' => 'nullable|mimes:jpeg,png,jpg,svg|max:4096',
        ];
    }
    public function messages(): array
    {
        return [
            'birthday.required' => 'Поле Дата рождения обязательно для заполнения',
            'email.required' => 'Поле Электронная почта обязательно для заполнения',
            'password.required' => 'Поле Пароль обязательно для заполнения',
            'login.required' => 'Поле Никнейм обязательно для заполнения',

            'password.min' => 'Поле Пароль должно содержать минимум 6 символов',
            'password.max' => 'Поле Пароль должно содержать максимум 255 символов',

            'login.min' => 'Поле Никнейм должно содержать минимум 2 символа',
            'login.max' => 'Поле Никнейм должно содержать максимум 32 символа',

            'avatar.max' => 'Файл аватара не должен превышать 4MB',

            'email.max' => 'Поле электронная почта должно содержать максимум 255 символов',

            'birthday.date' => 'Дата рождения должна быть в формате YYYY-MM-DD',
            'email.email' => 'Электронная почта должна быть в правильном формате электронного адреса',
            'email.unique' => 'Электронная почта уже используется другим пользователем',
            'avatar.mimes' => 'Файл должен быть формата jpeg, png, jpg, svg',
        ];
    }
}
