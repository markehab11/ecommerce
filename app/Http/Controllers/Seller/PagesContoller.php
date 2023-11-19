<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesContoller extends Controller
{
    public function index(){
        return view('seller.index');
    }
}
