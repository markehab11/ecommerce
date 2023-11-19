<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(){
        return view('seller.auth.login');
    }
    public function store(Request $request){
        if(!Auth::guard('seller')->attempt($request->only('email','password'),$request->filled('remember'))){
            throw ValidationException::withMessages([
                'email'=>'Invalid email or password'
            ]);
        }

        return redirect()->intended(route('seller.home'));
    }
    public function destroy(Request $request){
        Auth::guard("seller")->logout();
        return redirect()->route('seller.home');
    }

}

