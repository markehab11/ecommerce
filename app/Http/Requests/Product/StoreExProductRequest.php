<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreExProductRequest extends FormRequest
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
            'title'=>'required|max:50',
            'desc'=>'required|max:1000',
            'conditions'=>'required|max:1000',
            'category_id'=>'required|integer',
            'available'=>'boolean',
            'city_id'=>'required|integer',
            'user_id'=>'required',

            'price'=>'required|numeric',
            'excategory_id'=>'required|integer',
            'negotiable'=>'required|boolean',

            'images' => 'required',
            'images.*' => 'required|max:2000'


        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Title is required',
            'desc.required'=>'Description is required',
            'conditions.required'=>'Conditions is required',
            'category_id.required'=>'Category is required',
            'available.required'=>'Available is required',
            'available.boolean'=>'Available is boolean',
            'price.required'=>'Price is required',
            'price.numeric'=>'Price is numeric',
            'category_id.integer'=>'Category is integer',

            'images.required' => 'Please upload an image only',
            'images.*.required' => 'Please upload an image only',
            'images.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
            'images.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',

            'excategory_id.required'=>'Excategory is required',
            'excategory_id.integer'=>'Excategory is integer',



        ];
    }
}
