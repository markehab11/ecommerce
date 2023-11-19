<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

    }
    public function show(Product $product){
        $related = Product::where('subcategory_id',$product->subcategory_id)->get();

        return view('user.products.show',[
            'product'=>$product,
            'related'=>$related
        ]);
    }
}
