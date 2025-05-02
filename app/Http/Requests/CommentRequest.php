<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'text' => 'required|string|max:1000',
            'article_id' => 'nullable|exists:articles,id',
            'discussion_id' => 'nullable|exists:discussions,id',
        ];
    }
}
