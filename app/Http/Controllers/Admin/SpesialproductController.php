<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ImageTrait;
use App\Http\Controllers\Controller;
use App\Models\Spesialproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpesialproductController extends Controller
{
    use ImageTrait;
    public function index()
    {
        $spesial_products = Spesialproduct::all();
        return view('admin.pages.spesialproduct.index', compact('spesial_products'));
    }
    public function create()
    {
        return view('admin.pages.spesialproduct.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'desc' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $file_name = $this->saveImage($request->image, 'images/specialpro');
        Spesialproduct::create([
            'name' => $request->name,
            'image' => $file_name,
            'desc' => $request->desc
        ]);
        return redirect()->back()->with('message', 'Successfully!');
    }
    public function show(Spesialproduct $spesialproduct)
    {
        //
    }

    public function edit($id)
    {
        $spesial_product = Spesialproduct::findOrFail($id);
        return view('admin.pages.spesialproduct.edit', compact('spesial_product'));
    }

    public function update(Request $request, $id )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $spesial_pro = Spesialproduct::findOrFail($id);
        $spesial_pro->update([
            'name' => $request->name,
            'desc' => $request->desc
        ]);
        if (!isset($request->image)) {
            $spesial_pro->update([
                'image' => $request->old_image,
            ]);
        }else{
            $file_name = $this->saveImage($request->image, 'images/specialpro');
            $spesial_pro->update([
                'image' => $file_name,
            ]);
        }
        return redirect()->route('spicial_pro.index')->with('message', 'Successfully!');
    }
    public function destroy($id)
    {
        Spesialproduct::findOrFail($id)->delete();
        return redirect()->route('spicial_pro.index');
    }
}
