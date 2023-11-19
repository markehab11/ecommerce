<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExProductRequest extends FormRequest
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
            'price'=>'required|numeric',
            'excategory_id'=>'required|integer',
            'negotiable'=>'required|boolean',
            'user_id'=>'required',



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

            'excategory_id.required'=>'Excategory is required',
            'excategory_id.integer'=>'Excategory is integer',



        ];
    }
}
