<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title"=>"bail|required|min:3|max:20|unique:tags",
            "content"=>"bail|required|min:10|max:255"
        ];
    }
}
