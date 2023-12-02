<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $blogs = BlogResource::collection(Blog::get());
        return $this->apiResponse($blogs,'Success', 200);
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if($blog)
        {
            return $this->apiResponse(new BlogResource( $blog),'Success', 200);
        }
        return $this->apiResponse(null,'This blog Not Found', 401);
    }

    public function store(Request $request)
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

        $blog = Blog::create($request->all());

        if($blog)
        {
            return $this->apiResponse(new BlogResource( $blog),'This blog Added', 201);
        }
        return $this->apiResponse(null,'This Product Not Found', 404 );
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
