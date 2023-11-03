<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'year' => 'required|integer|min:0',
            'description' => 'required',
            'quantity' => 'required|integer|min:0',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
        ];
    }
}
