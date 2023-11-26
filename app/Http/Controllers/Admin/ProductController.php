<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Seller;
use App\Models\User;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\S3\UploadFileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $uploadFileRepository;
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository,UploadFileRepositoryInterface $uploadFileRepository)
    {
        $this->uploadFileRepository = $uploadFileRepository;
        $this->productRepository = $productRepository;

    }
    public function index(){
        $products = Product::with('category')->orderBy('created_at','asc')->paginate(10);

        return view('admin.pages.products.index',[
            'products'=>$products
        ]);
    }
    public function create(){
        $categories = Category::all(['id','title']);

        $users = Seller::all(['id','name']);
        return view('admin.pages.products.create',[
            'categories'=>$categories,
            'users'=>$users
        ]);
    }
    public function store(StoreProductRequest $request){
        $product = $this->productRepository->addNewProduct($request);
        if($product == true){
            return redirect()->route('admin.products.create')->with('message', 'Successfully!');
        }else{
            return redirect()->route('admin.products.create')->withErrors('Server Error');
        }
    }
    public function edit(Product $product){
        $categories = Category::all(['id','title']);

        $users = Seller::all(['id','name']);

        return view('admin.pages.products.edit',[
            'product'=>$product,
            'categories'=>$categories,
            'users'=>$users,

        ]);
    }
    public function update(UpdateProductRequest $request,$id){
        $updateProduct = $this->productRepository->updateProduct($request,$id);
        if($updateProduct == true){
            return redirect()->back()->with('message', 'Successfully!');
        }else{
            return redirect()->back()->withErrors('Server Error');
        }
    }
    public function softDelete(Product $product){
        $product->delete();
        return redirect()->route('admin.products.index');
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }
    public function restore($product){
        $getProduct = Product::findOrFail($product)->restore();
        return redirect()->route('admin.products.index');
    }
    public function deleteImage(Request $request){
        $image = ProductImage::findOrfail($request->id);
        $image->delete();
        return redirect()->back()->with('message', 'Successfully!');
    }

    public function search()
    {
        $query = request()->input('query');
        $products = Product::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('desc', 'like', '%' . $query . '%')
                    ->orWhere('price', 'like', '%' . $query . '%');
            });
        })->get();
        return response($products);
    }
}
