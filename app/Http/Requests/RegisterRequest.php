<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }/**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
/*        'email'=>'required|email|unique:users',*/

        return [
            'name'=>'required',
     /*       'email'=>'required',
            'avatar'=>'required',*/
            'phone_number'=>'numeric|unique:users|min:9',
            'password'=>'required|min:5',
            'password_confirm'=>'required|same:password',
        ];
    }
}

