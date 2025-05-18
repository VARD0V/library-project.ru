<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AICreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'paid' => 'nullable|boolean',
            'trial' => 'nullable|string|max:255',
            'description' => 'required|string',
            'link' => 'required|string|min:8|max:2048',
            'transformation_ids' => 'nullable|array',
            'transformation_ids.*' => 'exists:transformations,id',
            'task_ids' => 'nullable|array',
            'task_ids.*' => 'exists:tasks,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.string' => 'Поле "Название" должно быть строкой.',
            'name.min' => 'Поле "Название" должно содержать не менее :min символов.',
            'name.max' => 'Поле "Название" не должно превышать :max символов.',

            'paid.boolean' => 'Поле "Платный" должно иметь значение "да" или "нет".',

            'trial.string' => 'Поле "Пробная версия" должно быть строкой.',
            'trial.max' => 'Поле "Пробная версия" не должно превышать :max символов.',

            'description.required' => 'Поле "Описание" обязательно для заполнения.',
            'description.string' => 'Поле "Описание" должно быть строкой.',

            'link.required' => 'Поле "Ссылка" обязательно для заполнения.',
            'link.string' => 'Поле "Ссылка" должно быть строкой.',
            'link.min' => 'Поле "Ссылка" должно содержать не менее :min символов.',
            'link.max' => 'Поле "Ссылка" не должно превышать :max символов.',
        ];
    }
}
