<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CommentCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'text' => 'required|string|min:1',
            'article_id' => 'nullable|exists:articles,id',
            'discussion_id' => 'nullable|exists:discussions,id',
        ];
    }
    public function messages(): array
    {
        return [
            'text.required' => 'Комментарий не может быть пустым',
            'text.min' => 'Текст комментария должен содержать хотя бы :min символ',
        ];
    }
}
