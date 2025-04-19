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
            'trial' => 'nullable|boolean',
            'conversion_from' => 'nullable|string|min:3',
            'conversion_to' => 'nullable|string|min:3',
            'task_ids' => 'nullable|array',
            'task_ids.*' => 'exists:tasks,id',
        ];
    }
}
