<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\S3\UploadFileRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.pages.categories.index', [
            'categories' => $categories
        ]);
    }
    public function create()
    {
        return view('admin.pages.categories.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',

        ]);
        $add_category = Category::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Successfully!');
    }
    public function edit(Category $category)
    {

        return view('admin.pages.categories.edit', [
            'category' => $category
        ]);
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $update_category = $category->Update([
            'title' => $request->title,

        ]);
        return redirect()->back()->with('message', 'Successfully!');
    }
    public function softDelete(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->forceDelete();
        return redirect()->route('admin.categories.index');
    }
}
