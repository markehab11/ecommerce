<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SellerStoreProductRequest;
use App\Http\Requests\Product\SellerUpdateProductRequest;
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
        $products = Product::where('seller_id',auth('seller')->user()->id)->with('category')->orderBy('created_at','asc')->paginate(10);

        return view('seller.pages.products.index',[
            'products'=>$products
        ]);
    }
    public function create(){
        $categories = Category::all(['id','title']);

        $users = Seller::all(['id','name']);
        return view('seller.pages.products.create',[
            'categories'=>$categories,
            'users'=>$users
        ]);
    }
    public function store(SellerStoreProductRequest $request){
        $product = $this->productRepository->addNewProduct($request);
        if($product == true){
            return redirect()->route('seller.products.create')->with('message', 'Successfully!');
        }else{
            return redirect()->route('seller.products.create')->withErrors('Server Error');
        }
    }
    public function edit($id){
        $product = Product::where([
            'seller_id'=>auth('seller')->user()->id,
            'id'=>$id
        ])->firstOrfail();
        $categories = Category::all(['id','title']);

        $users = Seller::all(['id','name']);

        return view('seller.pages.products.edit',[
            'product'=>$product,
            'categories'=>$categories,
            'users'=>$users,

        ]);
    }
    public function update(SellerUpdateProductRequest $request,$id){
        $updateProduct = $this->productRepository->updateProduct($request,$id);
        if($updateProduct == true){
            return redirect()->back()->with('message', 'Successfully!');
        }else{
            return redirect()->back()->withErrors('Server Error');
        }
    }
    public function softDelete(Product $product){
        $product->delete();
        return redirect()->route('seller.products.index');
    }
    public function destroy($id){
        $product = Product::where([
            'seller_id'=>auth('seller')->user()->id,
            'id'=>$id
        ])->firstOrfail();
        $product->delete();
        return redirect()->route('seller.products.index');
    }
    public function restore($product){
        $getProduct = Product::findOrFail($product)->restore();
        return redirect()->route('seller.products.index');
    }
    public function deleteImage(Request $request){
        $image = ProductImage::findOrfail($request->id);
        $image->delete();
        return redirect()->back()->with('message', 'Successfully!');
    }


}
