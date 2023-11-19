<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $products = ProductResource::collection(Product::get());
        return $this->apiResponse($products,'Success', 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if($product)
        {
            return $this->apiResponse(new ProductResource( $product),'Success', 200);
        }
        return $this->apiResponse(null,'This Product Not Found', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'desc'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'discount'=>'required',
            'seller_id '=>'required',
            'category_id '=>'required',
//            'subcategory_id '=>'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $product = Product::create($request->all());

        if($product)
        {
            return $this->apiResponse(new ProductResource( $product),'This Product Added', 200);
        }
        return $this->apiResponse(null,'This Product Not Found', 404 );
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'desc'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'discount'=>'required',
            'seller_id'=>'required',
            'category_id'=>'required',
//          'subcategory_id'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $product = Product::find($id) ;

        if(!$product)
        {
            return $this->apiResponse(null,'This Product Not Found', 404 );
        }

        $product->update($request->all());

        if($product)
        {
            return $this->apiResponse(new ProductResource( $product),'This Product Updated', 202);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id) ;

        if(!$product)
        {
            return $this->apiResponse(null,'This Product Not Found', 404 );
        }

        $product->delete($id);

        if($product)
        {
            return $this->apiResponse(null,'This Product Deleted', 201);
        }
    }
}
