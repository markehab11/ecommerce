<?php

namespace App\Http\Controllers\User;

use App\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;

    }
    public function getCart(Request $request){
        // if(!$request->session()->has('cart')){
        //     return view('home.payment.cart',['products'=>null]);
        // }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        return view('user.cart.cart',[
            'cart'=>$cart
        ]);
    }
    public function addToCart(Request $request){
        $addToCart = $this->cartRepository->addItem($request->id,$request->qty);
        return redirect()->back()->with('message', 'Added Succesfully');
    }
    public function incItem(Request $request){
        $incItem = $this->cartRepository->incItem($request->id);
        return redirect()->back()->with('message', 'Edited Succesfully');
    }
    public function decItem(Request $request){
        $decItem = $this->cartRepository->decItem($request->id);
        return redirect()->back()->with('message', 'Edited Succesfully');
    }
    public function removeFromCart(Request $request){
        $addToCart = $this->cartRepository->deleteItem($request->id);
        return redirect()->back()->with('message', 'Deleted Succesfully');

    }
}
