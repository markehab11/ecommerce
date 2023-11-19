<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $sliders = SliderResource::collection(Slider::get());
        return $this->apiResponse($sliders,'Success', 200);
    }

    public function show($id)
    {
        $slider = Slider::find($id);

        if($slider)
        {
            return $this->apiResponse(new SliderResource( $slider),'Success', 200);
        }
        return $this->apiResponse(null,'This Slider Not Found', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
            'image' => 'required',
//            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $slider = Slider::create($request->all());

        if($slider)
        {
            return $this->apiResponse(new SliderResource( $slider),'This Slider Added', 201);
        }
        return $this->apiResponse(null,'This Slider Not Found', 404 );
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
            'image' => 'required',
//            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(), 400 );
        }

        $slider = Slider::find($id) ;

        if(!$slider)
        {
            return $this->apiResponse(null,'This Slider Not Found', 404 );
        }

        $slider->update($request->all());

        if($slider)
        {
            return $this->apiResponse(new SliderResource( $slider),'This Slider Updated', 202);
        }
    }

    public function destroy($id)
    {
        $slider = Slider::find($id) ;

        if(!$slider)
        {
            return $this->apiResponse(null,'This Slider Not Found', 404 );
        }

        $slider->delete($id);

        if($slider)
        {
            return $this->apiResponse(null,'This Slider Deleted', 201);
        }
    }
}
