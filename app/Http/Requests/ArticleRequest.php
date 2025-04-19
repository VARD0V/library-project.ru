<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'text' => 'required|string|min:3',
            'preview' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'article_category_id' => 'required|exists:article_categories,id',
        ];
    }
}
