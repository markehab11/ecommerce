<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'desc'=>$this->desc,
            'stock'=>$this->stock,
            'price'=>$this->price,
            'discount'=>$this->discount,
//            'seller_id'=>$this->seller_id,
            'category_id'=>$this->category_id,
//            'subcategory_id'=>$this->subcategory_id,
            'images'=>ProductimagesResource::collection($this->images),
            'detais'=> DetailsproductResource::collection($this->detail)
        ];
    }
}
