<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        if($request->q && $request->cat_id != 0){
            $res = Product::where('category_id',$request->cat_id)->where('title', 'LIKE', '%'.$request->q.'%')->orderBy('created_at','desc')->paginate(10);
        }elseif($request->q && $request->cat_id == 0){
            $res = Product::where('title', 'LIKE', '%'.$request->q.'%')->orderBy('created_at','desc')->paginate(10);
        }
        elseif(!$request->q && $request->cat_id != 0){
            $res = Product::where('category_id',$request->cat_id)->orderBy('created_at','desc')->paginate(10);
        }
        else{
            $res = Product::orderBy('created_at','desc')->paginate(10);
        }
        $res->appends($request->all());
        return view('user.search',[
            'result'=>$res
        ]);
    }
}
