<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{

    public function index()
    {
        $payments = Payment::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.pages.orders.index', [
            'payments' => $payments
        ]);
    }
    public function create()
    {
        return view('admin.pages.orders.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'shop_name'=>['required', 'string', 'max:255'],
            'phone_number'=>['required','numeric'],
            'address'=>['required', 'max:1000']
        ]);



        // $shop = Shop::create([
        //     'name' => $request->shop_name,
        //     'phone_number' => $request->phone_number,
        //     'address' => $request->address,
        //     'seller_id' => $seller->id,

        // ]);

        return redirect()->back()->with('message', 'Successfully!');
    }
    public function edit($id)
    {
        $seller = Payment::findOrfail($id);
        return view('admin.pages.orders.edit', [
            'seller' => $seller
        ]);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'shop_name'=>['required', 'string', 'max:255'],
            'phone_number'=>['required','numeric'],
            'address'=>['required', 'max:1000']
        ]);
        $seller = Payment::findOrfail($id);

        return redirect()->back()->with('message', 'Successfully!');
    }
    public function softDelete(Payment $seller)
    {
        $seller->delete();
        return redirect()->route('admin.orders.index');
    }

    public function destroy($id)
    {
        $seller = Payment::findOrFail($id);
        $seller->forceDelete();
        return redirect()->route('admin.orders.index');
    }
}
