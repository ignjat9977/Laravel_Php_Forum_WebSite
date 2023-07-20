<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            "mega_title"=>"bail|required|min:5",
            "title"=>"bail|required|min:5",
            "content"=>"bail|required|min:20",
            "id_category.*"=>"bail|numeric|gt:0|exists:categories,id_category",
            "id_tag.*"=>"bail|numeric|gt:0|exists:tags,id_tag",
            "picture_href"=>"bail|file|mimes:jpg,bmp,png"
        ];
    }
}
