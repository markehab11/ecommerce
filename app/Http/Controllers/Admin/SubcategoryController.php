<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use App\Repositories\S3\UploadFileRepositoryInterface;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories  = Subcategory::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.pages.subcategories.index', [
            'subcategories' => $subcategories
        ]);
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.subcategories.create',[
            'categories'=>$categories
        ]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'category_id'=>'required'
        ]);
        $add_category = Subcategory::create([
            'title' => $request->title,
            'category_id'=>$request->category_id,
        ]);

        return redirect()->back()->with('message', 'Successfully!');
    }
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.pages.subcategories.edit', [
            'subcategory' => $subcategory,
            'categories'=>$categories

        ]);
    }
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'title' => 'required',
            'category_id'=>'required'
        ]);

        $update_category = $subcategory->Update([
            'title' => $request->title,
            'category_id'=>$request->category_id,

        ]);
        return redirect()->back()->with('message', 'Successfully!');
    }
    public function softDelete(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index');
    }

    public function destroy($id)
    {
        $category = Subcategory::findOrFail($id);
        $category->forceDelete();
        return redirect()->route('admin.subcategories.index');
    }
    public function getSubCategories(Request $request, $category)
    {
        $subcategories = Category::find($category)->subcategories;
        return response()->json($subcategories);
    }

}
