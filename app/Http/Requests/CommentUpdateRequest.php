<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CommentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }
    public function rules(): array
    {
        return [
            'text' => 'string|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'text.min' => 'Текст комментария должен содержать хотя бы :min символ.',
        ];
    }
}
