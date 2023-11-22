<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use App\Models\Blog;
use Illuminate\Http\Request;

class blogController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.pages.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->image, 'images/blogs');
        Blog::create([
            'name' => $request->name,
            'image' => $file_name,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blogs = Blog::findOrFail($id);
        return view('admin.pages.blogs.edit', compact('blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        {
            $blogs = blog::findOrFail($id);
            $blogs->update([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            if (!isset($request->image)) {
                $blogs->update([
                    'image' => $request->old_image
                ]);
            }else{
                $file_name = $this->saveImage($request->image, 'images/blogs');
                $blogs->update([
                    'image' => $file_name
                ]);
            }
            return redirect()->route('blogs.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        blog::findOrFail($id)->delete();
        return redirect()->route('blogs.index');
    }
}
