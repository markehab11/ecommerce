<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {
        $product_reviews = ProductReview::with('product')->get();
        return view('admin.pages.reviews.index', compact('product_reviews'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show(ProductReview $productReview)
    {
        //
    }

    public function edit(ProductReview $productReview)
    {
        //
    }

    public function update(Request $request, ProductReview $productReview)
    {
        //
    }

    public function destroy($id)
    {
        ProductReview::findOrFail($id)->delete();
        return redirect()->route('reviews.index');
    }
}
