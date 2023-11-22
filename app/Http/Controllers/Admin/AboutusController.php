<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutusController extends Controller
{
    public function index()
    {
        $about_us = Aboutus::all();
        return view('admin.pages.about_us.index', compact('about_us'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.about_us.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

//        $file_name = $this->saveImage($request->image, 'images/sliders');
        Aboutus::create([
            'text' => $request->text,
//            'image' => $file_name,
        ]);
        return redirect()->back()->with('message', 'Successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
//        $products = Product::where(['Slider_id' => $id ])->get();
//        return view('products_category', compact('products') );
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $about_us = Aboutus::findOrFail($id);
        return view('admin.pages.about_us.edit', compact('about_us'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id )
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $about_us = Aboutus::findOrFail($id);
        $about_us->update([
            'text' => $request->text,
        ]);
//        if (!isset($request->image)) {
//            $slider->update([
//                'image' => $request->old_image,
//            ]);
//        }else{
//            $file_name = $this->saveImage($request->image, 'images/sliders');
//            $slider->update([
//                'image' => $file_name,
//            ]);
//        }
        return redirect()->route('aboutus.index')->with('message', 'Successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Aboutus::findOrFail($id)->delete();
        return redirect()->route('aboutus.index');
    }
}
