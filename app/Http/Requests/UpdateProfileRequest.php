<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = Auth::id();
        return [
            'login' => 'string|min:2|max:32|unique:users,login,' . $userId,
            'email' => 'email|min:10|max:255|unique:users,email,' . $userId,
            'birthday' => [
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isFuture()) {
                        $fail('Дата рождения не может быть в будущем.');
                    }
                },
            ],
            'avatar_url' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'password' => 'nullable|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'birthday.date' => 'Неверный формат даты.',
            'login.unique' => 'Этот логин уже занят.',
            'email.unique' => 'Этот email уже занят.',
            'email.min' => 'Поле email должно содержать минимум 10 символов.',
            'login.min' => 'Поле login должно содержать минимум 2 символа.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'password.confirmed' => 'Поля нового пароля не совпадают',
            'avatar_url.mimes' => 'Аватар должен быть в формате jpeg, png или jpg.',
            'avatar_url.max' => 'Размер аватара не должен превышать 4MB.',
        ];
    }
}
