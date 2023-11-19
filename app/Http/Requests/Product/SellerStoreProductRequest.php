<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SellerStoreProductRequest extends FormRequest
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
            'title'=>'required|max:100',
            'desc'=>'required|max:5000',
            'category_id'=>'required|integer',
            'subcategory_id'=>'required|integer',

            'price'=>'required|numeric',
            'discount'=>'numeric|nullable',
            'images' => 'required',
            'images.*' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Title is required',
            'desc.required'=>'Description is required',
            'category_id.required'=>'Category is required',

            'category_id.integer'=>'Category is integer',

            'images.required' => 'Please upload an image only',
            'images.*.required' => 'Please upload an image only',
            'images.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
            'images.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',


        ];
    }
}
