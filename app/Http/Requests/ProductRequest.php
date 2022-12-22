<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required',
            'star'=> 'required',
            'info'=> 'required',
            'description'=> 'required',
            'category'=> 'required',
            'type'=> 'required',
            'price'=> 'required',
            'discount'=> 'required',
            'discount_price'=> 'required',
            'count'=> 'required'
        ];
    }
}
