<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $categories = categoryResource::collection(Category::get());
        return $this->apiResponse($categories,'Success', 200);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if($category)
        {
            return $this->apiResponse(new CategoryResource( $category),'Success', 200);
        }
        return $this->apiResponse(null,'This Category Not Found', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $category = Category::create($request->all());

        if($category)
        {
            return $this->apiResponse(new CategoryResource( $category),'This Category Added', 201);
        }
        return $this->apiResponse(null,'This Category Not Found', 404 );
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $category = Category::find($id) ;

        if(!$category)
        {
            return $this->apiResponse(null,'This Category Not Found', 404 );
        }

        $category->update($request->all());

        if($category)
        {
            return $this->apiResponse(new CategoryResource( $category),'This Category Updated', 202);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id) ;

        if(!$category)
        {
            return $this->apiResponse(null,'This Category Not Found', 404 );
        }

        $category->delete($id);

        if($category)
        {
            return $this->apiResponse(null,'This Category Deleted', 201);
        }
    }
}
