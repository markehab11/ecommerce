<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ask;
use Illuminate\Http\Request;

class AskController extends Controller
{
    public function index()
    {
        $asks = Ask::all();
        return view('admin.pages.asks.index', compact('asks'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show(Ask $ask)
    {
        //
    }

    public function edit(Ask $ask)
    {
        //
    }

    public function update(Request $request, Ask $ask)
    {
        //
    }

    public function destroy($id)
    {
        Ask::findOrFail($id)->delete();
        return redirect()->route('asks.index');
    }
}
