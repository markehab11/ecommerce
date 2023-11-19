<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Cart\Cart;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request){
        if(!$request->session()->has('cart')){
            return view('user.cart.checkout',['products'=>null]);
        }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        return view('user.cart.checkout',[
            'products'=>$cart->items,
            'totalPrice'=>$cart->totalPrice,
            'subTotal'=>$cart->subTotal
        ]);
    }
    public function update(Request $request){
        $request->validate([
            'last_name'=>'required',
            'street'=>'required',
            'city'=>'required',
            'postcode'=>'required',
            'phone_number'=>'required',

        ]);
        $last_name = $request->last_name;
        $street = $request->street;
        $apartment = $request->apartment;
        $city = $request->city;
        $state = 'Egypt';
        $postcode = $request->postcode;
        $phone_number = $request->phone_number;
        $get_user = User::find(auth()->user()->id);


        $update = $get_user->update([
            'phone_number' =>$phone_number,
            'last_name' =>$last_name,
        ]);
        UserDetail::updateOrCreate([
            'user_id'=>auth()->user()->id
        ], [
            'apartment' =>$apartment,
            'street' =>$street,
            'city' =>$city,
            'state' =>$state,
            'country' =>$state,
            'postal_code'=>$postcode
        ]);




        return redirect()->back();
    }


}
