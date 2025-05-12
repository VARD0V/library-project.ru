<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
            'birthday' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minAge = Carbon::now()->subYears(5);
                    if (Carbon::parse($value)->gt($minAge)) {
                        $fail('Возраст должен быть не менее 5 лет.');
                    }
                },
            ],
            'avatar_url' => 'nullable|mimes:jpeg,png,jpg|max:4096',
        ];
    }
    public function messages()
    {
        return [
            'birthday.required' => 'Поле даты рождения обязательно для заполнения.',
            'birthday.date' => 'Неверный формат даты.',
            'login.required' => 'Поле логина обязательно для заполнения.',
            'login.unique' => 'Этот логин уже занят.',
            'email.required' => 'Поле email обязательно для заполнения.',
            'email.unique' => 'Этот email уже занят.',
            'password.required' => 'Поле пароля обязательно для заполнения.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'avatar_url.mimes' => 'Аватар должен быть в формате jpeg, png или jpg.',
            'avatar_url.max' => 'Размер аватара не должен превышать 4MB.',
        ];
    }
}
