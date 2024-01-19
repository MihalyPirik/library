<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>'required|string|max:100',
            'pages' =>'required|integer',
            'ISBN' =>'required|string|max:13|unique:books,ISBN',
            'year' =>'required|integer',
            'category_id' =>'required|integer|exists:categories,id',
        ];
    }
}
