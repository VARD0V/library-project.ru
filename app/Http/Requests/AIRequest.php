<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AIRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'paid' => 'nullable|boolean',
            'trial' => 'nullable|string|max:255',
            'description' => 'required|string',
            'link' => 'required|string|max:2048',
            'transformation_ids' => 'nullable|array',
            'transformation_ids_ids.*' => 'exists:transformations,id',
            'task_ids' => 'nullable|array',
            'task_ids.*' => 'exists:tasks,id',
        ];
    }
}
