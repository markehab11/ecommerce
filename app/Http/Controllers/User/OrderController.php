<?php

namespace App\Http\Controllers\User;

use App\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function newOrder(Request $request){

        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        try {
            DB::beginTransaction(); // Begin the transaction
            $user = auth()->user()->details;
            if($user->city == null || $user->country == null || auth()->user()->last_name == null || auth()->user()->phone_number == null){
                return redirect()->back()->withErrors(['error' => 'Please update your data']);
            }
            $payment = Payment::create([
                'user_id'=>auth()->user()->id,
                'amount'=>$cart->totalPrice,
                'method'=>1,
                'status'=>1,
            ]);
            DB::commit(); // Commit the transaction
            foreach($cart->items as $item){
                $order = Order::create([
                    'payment_id'=>$payment->id,
                    'product_id'=>$item['item']->id,
                    'qty'=>$item['qty'],
                ]);
            }
            $request->session()->forget('cart');
                return redirect()->back()->with('message', 'Thank You'); // Return true if successful

        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving data.']); // Return false if there was an error

            throw $e; // Rethrow the exception
        }


    }
}
