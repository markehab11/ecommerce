<?php
namespace App\Cart;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $subTotal = 0;
    public $paymethod = 0;
    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->subTotal = $oldCart->subTotal;
            $this->paymethod = $oldCart->paymethod;
        }

    }
    public function add($item,$id,$qty){

        $storedItem =[
            'qty'=>0,
            'price'=>$item->price,
            'item'=>$item,
            'subTotal'=>0,
            'paymethod'=>0
        ];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']+=$qty;
        $storedItem['price'] = ($item->price-(($item->price*intval($item->discount))/100))*$storedItem['qty'];
        $this->items[$id]= $storedItem;
        $this->totalQty+=$qty;
        $this->totalPrice +=($item->price-(($item->price*intval($item->discount))/100))*$qty;

    }
    public function incItem($id){
        $this->items[$id]['qty']++;
        $this->items[$id]['price']+=$this->items[$id]['item']['price']-(($this->items[$id]['item']['price']*intval($this->items[$id]['item']['discount']))/100);
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['item']['price']-(($this->items[$id]['item']['price']*intval($this->items[$id]['item']['discount']))/100);
    }
    public function decItem($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['price']-=$this->items[$id]['item']['price']-(($this->items[$id]['item']['price']*intval($this->items[$id]['item']['discount']))/100);
        $this->totalQty--;
        $this->totalPrice -=$this->items[$id]['item']['price']-(($this->items[$id]['item']['price']*intval($this->items[$id]['item']['discount']))/100);

        if($this->items[$id]['qty']<=0){
            unset($this->items[$id]);
        }
    }
    public function removeItem($id){
        $this->totalQty -=$this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['item']['price']*$this->items[$id]['qty']-(($this->items[$id]['item']['price']*$this->items[$id]['qty']*intval($this->items[$id]['item']['discount']))/100);
        unset($this->items[$id]);
    }
    public function paymentOption($id){
        if($id == 1 ){ //Pay 15% from total order
            $subTotal = 0;
            $this->subTotal = 0;
            $this->paymethod = 1;
        }else if ($id == 2){ //Pay 100% from total order
            $subTotal = 50;
            $this->subTotal = $subTotal;
            $this->paymethod = 2;
        }else{
            $subTotal = 0;
            $this->subTotal = 0;
            $this->paymethod = 0;
        }

    }
    public function destroyCart(){
        unset($this->items);
    }


}

?>
