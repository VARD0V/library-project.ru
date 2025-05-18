<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class DiscussionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'description' => 'nullable|string|max:255',
            'text' => 'string',
            'preview' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'string|max:2048',
            'discussion_category_id' => 'exists:discussion_categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.string' => 'Поле "Заголовок" должно быть строкой.',
            'title.max' => 'Поле "Заголовок" не должно превышать :max символов.',

            'description.string' => 'Поле "Описание" должно быть строкой.',
            'description.max' => 'Поле "Описание" не должно превышать :max символов.',

            'text.string' => 'Поле "Текст обсуждения" должно быть строкой.',

            'preview.image' => 'Файл должен быть изображением (jpeg, png, jpg или gif).',
            'preview.mimes' => 'Изображение должно быть формата: jpeg, png, jpg или gif.',
            'preview.max' => 'Превью не должно превышать :max килобайт.',

            'status.string' => 'Поле "Статус" должно быть строкой.',
            'status.max' => 'Поле "Статус" не должно превышать :max символов.',
        ];
    }
}
