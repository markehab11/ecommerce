<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailController extends Controller
{

    public function index()
    {
        $details = Detail::all();
        return view('admin.pages.details.index', compact('details'));
    }


    public function create()
    {
        $products = Product::all();
        return view('admin.pages.details.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'value' => 'required',
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        Detail::create([
            'title' => $request->title,
            'value' => $request->value,
            'product_id' => $request->product_id
        ]);
        return redirect()->route('details.index')->with('message', 'Successfully!');


    }

    public function show(Detail $detail)
    {
        //
    }

    public function edit($id)
    {
        $products = Product::all();
        $detail = Detail::findOrFail($id);
        return view('admin.pages.details.edit', compact('detail','products'));
    }

    public function update(Request $request, $id )
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'value' => 'required',
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $detail = Detail::findOrFail($id);
        $detail->update([
            'title' => $request->title,
            'value' => $request->value,
            'product_id' => $request->product_id
        ]);
        return redirect()->route('details.index')->with('message', 'Successfully!');
    }

    public function destroy($id)
    {
        Detail::findOrFail($id)->delete();
        return redirect()->route('details.index');
    }
}
