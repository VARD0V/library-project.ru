<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class DiscussionCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'text' => 'required|string',
            'preview' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discussion_category_id' => 'required|exists:discussion_categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'title.string' => 'Поле "Заголовок" должно быть строкой.',
            'title.max' => 'Поле "Заголовок" не должно превышать :max символов.',

            'description.string' => 'Поле "Описание" должно быть строкой.',
            'description.max' => 'Поле "Описание" не должно превышать :max символов.',

            'text.required' => 'Поле "Текст обсуждения" обязательно для заполнения.',
            'text.string' => 'Поле "Текст обсуждения" должно быть строкой.',

            'preview.image' => 'Файл должен быть изображением (jpeg, png, jpg или gif).',
            'preview.mimes' => 'Изображение должно быть формата: jpeg, png, jpg или gif.',
            'preview.max' => 'Превью не должно превышать :max килобайт.',

            'status.string' => 'Поле "Статус" должно быть строкой.',
            'status.max' => 'Поле "Статус" не должно превышать :max символов.',
            'status.required' => 'Поле "Статус" обязательно для заполнения.',
        ];
    }
}
