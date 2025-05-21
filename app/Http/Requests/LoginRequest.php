<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Некорректный формат email',
            'email.exists' => 'Пользователь с таким email не найден',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен быть не менее 6 символов',
        ];
    }
}
