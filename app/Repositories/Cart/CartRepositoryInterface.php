<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function getCart();
    public function addItem($id,$qty);
    public function deleteItem($id);
    public function incItem($id);
    public function decItem($id);

}
