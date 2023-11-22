<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){
        if(!auth()->user())
        {
            return $this->apiResponse('','You Are Not Login', 404);
        }

        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return $this->apiResponse($wishlist,'Success', 200);
    }

    public function store(Request $request){
        $add_whitelist = Wishlist::create([
            'user_id'=>auth()->user()->id,
            'product_id'=>$request->id
        ]);

        if($add_whitelist)
        {
            return $this->apiResponse($add_whitelist, 'This Category Added', 201);
        }
        return $this->apiResponse(null,'This Category Not Found', 404 );
    }
    public function destroy($id){
        $add_whitelist = Wishlist::where([
            'user_id'=>auth()->user()->id,
            'product_id'=>$id
        ])->firstOrfail();
        $add_whitelist->delete();

        if($add_whitelist)
        {
            return $this->apiResponse(null,'This Category Deleted', 201);
        }
    }
}
