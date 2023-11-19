<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreSellerRequest extends FormRequest
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
            'id'=>'required',
            'name' => 'required',
            'email' => 'required|mimes:jpg,jpeg,png,bmp|max:2000'

        ];
    }
    public function messages()
    {
        return [
            'id.required'=>'Product is required',
            'images.required' => 'Please upload an image only',
            'images.*.required' => 'Please upload an image only',
            'images.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
            'images.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        ];
    }
}
