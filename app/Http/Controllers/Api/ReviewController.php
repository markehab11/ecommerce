<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

use App\Http\Resources\ReviewResource;
use App\Models\Blog;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $reviews = ReviewResource::collection(ProductReview::get());
        return $this->apiResponse($reviews,'Success', 200);
    }

    public function show($id)
    {
        $review = ProductReview::where('product_id' === $id);

        if($review)
        {
            return $this->apiResponse(new ReviewResource($review),'Success', 200);
        }
        return $this->apiResponse(null,'This blog Not Found', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'title'=>'required',
            'review'=>'required',
            'product_id'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $review = ProductReview::create($request->all());

        if($review)
        {
            return $this->apiResponse(new ReviewResource( $review),'This review Added', 201);
        }
        return $this->apiResponse(null,'This review Not Found', 404 );
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'image'=>'required',
            'title'=>'required',
            'description'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $blog = Blog::find($id) ;

        if(!$blog)
        {
            return $this->apiResponse(null,'This blog Not Found', 404 );
        }

        $blog->update($request->all());

        if($blog)
        {
            return $this->apiResponse(new BlogResource($blog),'This blog Updated', 202);
        }
    }

    public function destroy($id)
    {
        $blog = Blog::find($id) ;

        if(!$blog)
        {
            return $this->apiResponse(null,'This blog Not Found', 404 );
        }

        $blog->delete($id);

        if($blog)
        {
            return $this->apiResponse(null,'This blog Deleted', 201);
        }
    }
}
