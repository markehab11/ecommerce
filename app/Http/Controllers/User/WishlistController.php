<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('user.wishlists.index',[
            'wishlist'=>$wishlist
        ]);
    }

    public function store(Request $request){
        $add_whitelist = Wishlist::create([
            'user_id'=>auth()->user()->id,
            'product_id'=>$request->id
        ]);
        return redirect()->back()->with('message', 'Favourite Added Succesfully');
    }
    public function destroy($id){
        $add_whitelist = Wishlist::where([
            'user_id'=>auth()->user()->id,
            'product_id'=>$id
        ])->firstOrfail();
        $add_whitelist->delete();
        return redirect()->back()->with('message', 'Favourite Deleted Succesfully');
    }
}
