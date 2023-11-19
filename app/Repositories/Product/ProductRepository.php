<?php

namespace App\Repositories\Product;

use App\Models\Exchange;
use App\Models\ExchangesProduct;
use App\Models\Image;
use App\Models\Price;
use App\Models\Product;
use App\Repositories\S3\UploadFileRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    private $UploadFileRepository;
    public function __construct(UploadFileRepositoryInterface $UploadFileRepository)
    {
        $this->UploadFileRepository = $UploadFileRepository;

    }

    public function addNewProduct($request){
        try {
            DB::beginTransaction(); // Begin the transaction
//            if($request->seller_id){
//                $seller = $request->seller_id;
//            }elseif(Auth::guard('seller')->check()){
//                $seller = auth('seller')->user()->id;
//            }
            $product = Product::create([
                'title'=>$request->title,
                'desc'=>$request->desc,
                'category_id'=>$request->category_id,
//                'subcategory_id'=>$request->subcategory_id,
                'stock'=>$request->stock,
//                'seller_id'=>$seller,
                'city_id'=>$request->city_id,
                'discount'=>$request->discount,
                'price'=>$request->price,
            ]);

            DB::commit(); // Commit the transaction

            if($request->images){
                //----------- Upload Image ---------------//
                //$images -> file data forloop for in images
                foreach($request->images as $image){
                    // upload here
                    $imageName = $this->UploadFileRepository->upload($image);
                    $image = $product->images()->create([
                        'image'=>$imageName,
                    ]);
                }
                //----------- Upload Image ---------------//
            }

            return true; // Return true if successful
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return false; // Return false if there was an error

            throw $e; // Rethrow the exception
        }
    }

    public function updateProduct($request,$id){
//        if($request->seller_id){
//            $seller = $request->seller_id;
//            $product = Product::where([
//                'id'=>$id,
//            ])->firstOrfail();
//        }elseif(Auth::guard('seller')->check()){
//            $seller = auth('seller')->user()->id;
//            $product = Product::where([
//                'id'=>$id,
//                'seller_id'=>$seller
//            ])->firstOrfail();
//        }

        $product = Product::where([
            'id'=>$id,
        ])->firstOrfail();

        try {



            DB::beginTransaction(); // Begin the transaction
            $product->update([
                'title'=>$request->title,
                'desc'=>$request->desc,
                'category_id'=>$request->category_id,
//                'subcategory_id'=>$request->subcategory_id,
                'stock'=>$request->stock,
//                'seller_id'=>$seller,
                'city_id'=>$request->city_id,
                'discount'=>$request->discount,
                'price'=>$request->price,
            ]);
            DB::commit(); // Commit the transaction

            if($request->images){
                //----------- Upload Image ---------------//
                //$images -> file data forloop for in images
                foreach($request->images as $image){
                    // upload here
                    $imageName = $this->UploadFileRepository->upload($image);
                    $image = $product->images()->create([
                        'image'=>$imageName,
                    ]);
                }
                //----------- Upload Image ---------------//
            }

            return true; // Return true if successful

        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            // return false; // Return false if there was an error

            throw $e; // Rethrow the exception
        }

    }


}
