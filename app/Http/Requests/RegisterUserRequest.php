<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            "first_name"=>"bail|required|min:3",
            "last_name"=>"bail|required|min:3",
            "username"=>"bail|required|unique:blog_users,username|min:3",
            "password"=>"bail|required|min:8",
            "email"=>"bail|required|email:rfc,dns|unique:blog_users,email",
            "street"=>"bail|required",


        ];
    }
    public function messages()
    {
        return [

        ];
    }

}
