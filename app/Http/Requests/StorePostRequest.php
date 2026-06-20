<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->type === 'admin';
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'type' => 'required|in:announcement,news,blog',
            'body' => 'required|string',
            'is_published' => 'boolean',
            'default_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 👈 ADD PHOTO VALIDATION
        ];
    }
}