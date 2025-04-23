<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'login' => 'string|max:32|unique:users,login,' . $userId,
            'email' => 'email|max:255|unique:users,email,' . $userId,
            'birthday' => 'date',
            'avatar_url' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'password' => 'nullable|min:6|confirmed', // Пароль должен быть не менее 8 символов, если введён
        ];
    }
}
