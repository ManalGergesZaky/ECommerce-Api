<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name'=>['required', 'min:4'],
            'last_name'=>['required','min:4'],
            'email'=>['required','email'],
            'password'=>['required','min:9'],
            'phone'=>['required','max:11','min:11','alpha_num'],
        ];
    }
    public function messages()
    {
        return [
            'first_name.required'=> 'Please Enter First Name',
            'last_name.required'=> 'Please Enter First Name',
            'first_name.min'=> 'Please Enter First Name at least 4 character',
            'last_name.min'=> 'Please Enter First Name at least 4 character',
            'email.required'=> 'Please Enter Your Email',
            'password.required'=> 'please enter your password',
            'password.min'=> 'password at least leanth is 9',
            'phone.required'=> 'please enter your phone',
            'phone.min'=> 'phone should be 11 number',
            'phone.max'=> 'phone should be 11 number',
        ];
    }
}
