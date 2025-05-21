<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ArticleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'string|min:3|max:255',
            'description' => 'nullable|string',
            'text' => 'string|min:3',
            'preview' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'article_category_id' => 'exists:article_categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'title.string' => 'Поле "Заголовок" должно быть строкой.',
            'title.min' => 'Поле "Заголовок" должно содержать не менее :min символов.',
            'title.max' => 'Поле "Заголовок" не должно превышать :max символов.',

            'description.string' => 'Поле "Описание" должно быть строкой.',

            'text.required' => 'Поле "Текст статьи" обязательно для заполнения.',
            'text.string' => 'Поле "Текст статьи" должно быть строкой.',
            'text.min' => 'Поле "Текст статьи" должно содержать не менее :min символов.',

            'preview.image' => 'Файл должен быть изображением (jpeg, png, jpg или svg).',
            'preview.mimes' => 'Изображение должно быть формата: jpeg, png, jpg или svg.',
            'preview.max' => 'Превью не должно превышать :max килобайт.',
        ];
    }
}
