<?php

namespace App\Repositories\Cart;

use App\Cart\Cart;
use App\Models\admin\Extra;
use App\Models\admin\Item;
use App\Models\admin\Size;
use App\Models\Book;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
class CartRepository implements CartRepositoryInterface
{
    public function getCart(){
        $oldCart = request()->session()->has('cart') ? session()->get('cart'):null;
        $cart = new Cart($oldCart);
        return $cart;
    }
    public function addItem($id,$qty){
        $product = Product::find($id);
        $oldCart = request()->session()->has('cart') ? session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id,$qty);
        request()->session()->put('cart',$cart);
    }
    public function incItem($id){
        $oldCart = request()->session()->has('cart') ? session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->incItem($id);
        request()->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function decItem($id){
        $oldCart = request()->session()->has('cart') ? session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->decItem($id);
        request()->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function deleteItem($id){
        $oldCart = request()->session()->has('cart') ? session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        request()->session()->put('cart',$cart);
    }

}
