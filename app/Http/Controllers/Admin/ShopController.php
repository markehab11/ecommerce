<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shop;
use App\Repositories\S3\UploadFileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class ShopController extends Controller
{

    public function index()
    {
        $sellers = Seller::orderBy('created_at', 'asc')->has('shop')->paginate(10);
        return view('admin.pages.shops.index', [
            'sellers' => $sellers
        ]);
    }
    public function create()
    {
        return view('admin.pages.shops.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Seller::class],
            'password' => ['required', Rules\Password::defaults()],

            'shop_name'=>['required', 'string', 'max:255'],
            'phone_number'=>['required','numeric'],
            'address'=>['required', 'max:1000']
        ]);

        $seller = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $shop = Shop::create([
            'name' => $request->shop_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'seller_id' => $seller->id,

        ]);

        return redirect()->back()->with('message', 'Successfully!');
    }
    public function edit($id)
    {
        $seller = Seller::findOrfail($id);
        return view('admin.pages.shops.edit', [
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
        $seller = Seller::findOrfail($id);

        if($request->password == null ){
            $password = $seller->password;
        }else{
            $password = Hash::make($request->password);
        }
        $update_seller = $seller->Update([
            'name' => $request->name,
            'password' => $password,
        ]);
        $seller->shop->Update([
            'name' => $request->shop_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        return redirect()->back()->with('message', 'Successfully!');
    }
    public function softDelete(Seller $seller)
    {
        $seller->delete();
        return redirect()->route('admin.shops.index');
    }

    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->forceDelete();
        return redirect()->route('admin.shops.index');
    }
}
