<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request,Category $category){


        $id= $request->id;
        if($request->get('sort')=="name_asc"){
            $single_cat = $category->products()->orderBy('title','asc')->paginate(10);
        }elseif($request->get('sort')=="name_desc"){
            $single_cat = $category->products()->orderBy('title','desc')->paginate(10);
        }elseif($request->get('sort')=="price_asc"){
            $single_cat = $category->products()->orderBy('price','asc')->paginate(10);
        }
        elseif($request->get('sort')=="price_desc"){
            $single_cat = $category->products()->orderBy('price','desc')->paginate(10);
        }
        else{
            $single_cat = $category->products()->paginate(3);
        }
        $single_cat->appends($request->all());
        return view('user.categories.show',[
            'single_cat'=>$single_cat
        ]);
    }
    public function show_sub(Request $request,$category,$subcategory){
        if($request->get('sort')=="name_asc"){
            $subcategory = Product::where('category_id',$category)->where('subcategory_id',$subcategory)->orderBy('title','asc')->paginate(10);
        }elseif($request->get('sort')=="name_desc"){
            $subcategory = Product::where('category_id',$category)->where('subcategory_id',$subcategory)->orderBy('title','desc')->paginate(10);
        }elseif($request->get('sort')=="price_asc"){
            $subcategory = Product::where('category_id',$category)->where('subcategory_id',$subcategory)->orderBy('price','asc')->paginate(10);
        }
        elseif($request->get('sort')=="price_desc"){
            $subcategory = Product::where('category_id',$category)->where('subcategory_id',$subcategory)->orderBy('price','desc')->paginate(10);
        }
        else{
            $subcategory = Product::where('category_id',$category)->where('subcategory_id',$subcategory)->paginate(10);
        }
        $subcategory->appends($request->all());
        return view('user.subcategories.show',[
            'subcategory'=>$subcategory
        ]);
    }
}
