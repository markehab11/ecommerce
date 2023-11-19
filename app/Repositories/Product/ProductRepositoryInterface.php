<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function addNewProduct($request);
    public function updateProduct($request,$id);

}
