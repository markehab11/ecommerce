<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(){
        return view('admin.auth.login');
    }
    public function store(Request $request){
        if(!Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            throw ValidationException::withMessages([
                'email'=>'Invalid email or password'
            ]);
        }

        return redirect()->intended(route('admin.home'));
    }
    public function destroy(Request $request){
        Auth::guard("admin")->logout();
        return redirect()->route('admin.home');
    }

}

