<?php

namespace App\Cart;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
Class CheckOut
{

    public function getToken(){
        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => env('PAYMOB_API_KEY')
        ]);
        return $response->object()->token;
    }

    public function createOrder($token,$dataItem,$totalPrice){
        $items = array();
        foreach ($dataItem as $item){
            $items[]=[
                'name'=>$item['item']['name'],
                "amount_cents"=> $item['price']*100,
                "description"=> $item['item']['description'],
                "quantity"=> $item['qty']

            ];
        }
        $data = [
            "auth_token" =>   $token,
            "delivery_needed" =>"false",
            "amount_cents"=> $totalPrice*100,
            "currency"=> "EGP",
            "items"=> $items,

        ];
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', $data);

        return $response->object();
    }

    public function getPaymentToken($order, $token,$totalPrice)
    {

        $billingData = [
            "apartment" => "NA",
            "email" => auth()->user()->email,
            "floor" => "NA",
            "building" => "NA",
            "shipping_method"=> "NA",
            "first_name" => auth()->user()->name,
            "street" => "NA",
            "phone_number" => "NA",
            "postal_code" => "NA",
            "city" => "NA",
            "country" => "NA",
            "last_name" => "NA",
            "state" => "NA",
        ];
        $data = [
            "auth_token" => $token,
            "amount_cents" => $totalPrice*100,
            "expiration" => 3600,
            "order_id" => $order->id,
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_INTEGRATION_ID')
        ];
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
        return $response->object()->token;
    }
    // public function callback(Request $request)
    // {

    //     $data = $request->all();
    //     ksort($data);
    //     $hmac = $data['hmac'];
    //     $array = [
    //         'amount_cents',
    //         'created_at',
    //         'currency',
    //         'error_occured',
    //         'has_parent_transaction',
    //         'id',
    //         'integration_id',
    //         'is_3d_secure',
    //         'is_auth',
    //         'is_capture',
    //         'is_refunded',
    //         'is_standalone_payment',
    //         'is_voided',
    //         'order',
    //         'owner',
    //         'pending',
    //         'source_data_pan',
    //         'source_data_sub_type',
    //         'source_data_type',
    //         'success',
    //     ];
    //     $connectedString = '';
    //     foreach ($data as $key => $element) {
    //         if(in_array($key, $array)) {
    //             $connectedString .= $element;
    //         }
    //     }
    //     $secret = env('PAYMOB_HMAC');
    //     $hased = hash_hmac('sha512', $connectedString, $secret);
    //     if ( $hased == $hmac) {

    //         return redirect()->route('home.index');
    //         exit;

    //     }else{
    //         return redirect()->route('checkout.show');
    //         exit;
    //     }


    // }
        public function saveFreeBook($item){
            $new_payment = Payment::create([
                'user_id'=>auth()->user()->id,
                'status'=>1,
                'amount'=>0
            ]);

            $new_order = Order::create([
                'book_id'=>$item->id,
                'payment_id'=>$new_payment->id,
                'qty'=>1
            ]);


            $new_payment->user->books()->syncWithoutDetaching($item->id);
            return $new_payment;
        }
    public function saveOrder($items,$total){
        $new_payment = Payment::create([
            'user_id'=>auth()->user()->id,
            'status'=>1,
            'amount'=>$total
        ]);
        foreach($items as $item){
            $new_order = Order::create([
                'book_id'=>$item['item']['id'],
                'payment_id'=>$new_payment->id,
                'qty'=>$item['qty']
            ]);
        }

        $new_payment->user->books()->syncWithoutDetaching(array_keys($items));

        request()->session()->forget('cart');


    }

    public function saveOrderMob($id,$book){
        $payment = Payment::findOrfail($id);
            $payment->update([
                'status'=>1
            ]);
            $new_order = Order::create([
                'book_id'=>$book,
                'payment_id'=>$id,
            ]);


            $payment->user->books()->syncWithoutDetaching([$book]);
    }

    public function charge($payment){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tap.company/v2/charges",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($payment),
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer sk_test_AVc4MJmXfHWZ35qbRIL8N0xv", // SECRET API KEY
            "content-type: application/json"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);
        return $response;
    }

    public function getPaymentDetails($amount , $items){
        $dataItem = array();
        foreach ($items as $item){
            $dataItem[]=[
                'id'=>$item['item']['id'],
                'name'=>$item['item']['name'],
                "amount_cents"=> $item['price']*100,
                "description"=> $item['item']['description'],
                "quantity"=> $item['qty']

            ];
        }
        $payment = [
            "amount" => $amount,
            "description" => json_encode($dataItem,JSON_UNESCAPED_UNICODE),
            "currency" => env('TAP_CURRENCY'),
            "receipt" => [
                "email" => true,
                "sms" => true
            ],
            "customer"=> [
                "first_name"=> auth()->user()->name,
                "last_name"=> null,
                "email"=> auth()->user()->email,
                "phone"=> [
                    "country_code" => 'EG',
                    "number" =>"01016778335"
                ]
            ],
            "source"=> [
                "id"=> "src_card"
            ],
            "redirect"=> [
                "url"=> route('tap.callback')
            ]
        ];

        return $payment;

    }


    public function getPaymentDetailsMob($amount , $items,$payment_id){
        $dataItem = array();
        foreach ($items as $item){
            $dataItem[]=[
                'book_id'=>$item['item']['id'],
                'payment_id'=>$payment_id,
                "amount_cents"=> $item['price']*100,
                "quantity"=> $item['qty']

            ];
        }
        $payment = [
            "amount" => $amount,
            "description" => json_encode($dataItem,JSON_UNESCAPED_UNICODE),
            "currency" => env('TAP_CURRENCY'),
            "receipt" => [
                "email" => true,
                "sms" => true
            ],
            "customer"=> [
                "first_name"=> auth()->user()->name,
                "last_name"=> null,
                "email"=> auth()->user()->email,
                "phone"=> [
                    "country_code" => 'EG',
                    "number" =>"01016778335"
                ]
            ],
            "source"=> [
                "id"=> "src_card"
            ],
            "redirect"=> [
                "url"=> route('tap.callback_mob')
            ]
        ];
        return $payment;


    }

    public function callback($tap_id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tap.company/v2/charges/".$tap_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        CURLOPT_HTTPHEADER => array(
                "authorization: Bearer sk_test_AVc4MJmXfHWZ35qbRIL8N0xv" //SECRET API KEY
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $responseTap = json_decode($response);
        return $responseTap;

    }



}
