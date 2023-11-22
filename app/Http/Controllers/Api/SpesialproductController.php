<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialproResource;
use App\Models\Spesialproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpesialproductController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $spesial_products = SpecialproResource::collection(Spesialproduct::get());
        return $this->apiResponse($spesial_products,'Success', 200);
    }

    public function show($id)
    {
        $spesial_product = Spesialproduct::find($id);

        if($spesial_product)
        {
            return $this->apiResponse(new SpecialproResource($spesial_product),'Success', 200);
        }
        return $this->apiResponse(null,'This Product Not Found', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $spesial_product = Spesialproduct::create($request->all());

        if($spesial_product)
        {
            return $this->apiResponse(new SpecialproResource( $spesial_product),'This Slider Added', 201);
        }
        return $this->apiResponse(null,'This Product Not Found', 404 );
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $spesial_product = Spesialproduct::find($id) ;

        if(!$spesial_product)
        {
            return $this->apiResponse(null,'This Product Not Found', 404 );
        }

        $spesial_product->update($request->all());

        if($spesial_product)
        {
            return $this->apiResponse(new SpecialproResource( $spesial_product),'This Product Updated', 202);
        }
    }

    public function destroy($id)
    {
        $spesial_product = Spesialproduct::find($id) ;

        if(!$spesial_product)
        {
            return $this->apiResponse(null,'This Product Not Found', 404 );
        }

        $spesial_product->delete($id);

        if($spesial_product)
        {
            return $this->apiResponse(null,'This Product Deleted', 201);
        }
    }
}
