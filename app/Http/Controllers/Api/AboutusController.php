<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutusResource;
use App\Models\Aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutusController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $about_us = AboutusResource::collection(Aboutus::get());
        return $this->apiResponse($about_us,'Success', 200);
    }

    public function show($id)
    {
        $about_us = Aboutus::find($id);

        if($about_us)
        {
            return $this->apiResponse(new AboutusResource( $about_us),'Success', 200);
        }
        return $this->apiResponse(null,'This Slider Not Found', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:255',
//            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $about_us = Aboutus::create($request->all());

        if($about_us)
        {
            return $this->apiResponse(new AboutusResource( $about_us),'This Slider Added', 201);
        }
        return $this->apiResponse(null,'This Slider Not Found', 404 );
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:255',
//            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $about_us = Aboutus::find($id) ;

        if(!$about_us)
        {
            return $this->apiResponse(null,'This Slider Not Found', 404 );
        }

        $about_us->update($request->all());

        if($about_us)
        {
            return $this->apiResponse(new AboutusResource( $about_us),'This Slider Updated', 202);
        }
    }

    public function destroy($id)
    {
        $about_us = Aboutus::find($id) ;

        if(!$about_us)
        {
            return $this->apiResponse(null,'This Slider Not Found', 404 );
        }

        $about_us->delete($id);

        if($about_us)
        {
            return $this->apiResponse(null,'This Slider Deleted', 201);
        }
    }
}
