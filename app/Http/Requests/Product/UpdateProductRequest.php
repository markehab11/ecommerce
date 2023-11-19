<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price'=>'required|numeric',
            'discount'=>'numeric|nullable',
            'seller_id'=>'required',
            'subcategory_id'=>'required|integer',

            // 'images.*' => 'required|mimes:jpg,jpeg,png,bmp|max:2000'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Title is required',
            'desc.required'=>'Description is required',
            'category_id.required'=>'Category is required',

            'category_id.integer'=>'Category is integer',

            'price.required'=>'Price is required',
            'discount.required'=>'Discount must be numeric',


        ];
    }
}
