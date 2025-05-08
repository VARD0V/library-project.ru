<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscussionRequest extends FormRequest
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
            'preview' => 'nullable|image|max:2048',
            'status' => 'image|max:2048',
            'discussion_category_id' => 'required|exists:discussion_categories,id',
        ];
    }
}
