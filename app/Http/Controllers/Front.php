<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Cart;
use App\Product;
use App\Customer;
use App\Order;
use App\OrderItem;
use Stripe;
use Session;


class Front extends Controller
{


    function  __construct()
    {
        $this->customer_FN = "";
        $this->customer_LN = "";
        $this->customer_Email = "";
        $this->customer_Address = "";
        $this->customer_City = "";
        $this->customer_Province = "";
        $this->customer_PostalCode = "";
        $this->customer_shipping_Address = "";
        $this->customer_shipping_City = "";
        $this->customer_shipping_Province = "";
        $this->customer_shipping_PostalCode = "";
        $this->customer_Phone = "";
    }

    public function cart(Request $request) {

        if ($request->isMethod('post')) {
            $product_id = $request->get('product_id');

            $product = Product::find($product_id);
            $price = (int)str_replace("$","",$product->price);
            Cart::add(array('id' => $product_id, 'name' => $product->product_name, 'qty' => 1, 'price' => $price, 'weight' => 0));
        }
        if($request->get('product_id') && ($request->get('decrease')) == 1){
            $rowId = Cart::search(function($cartItem, $rowID) use($request) {
                return $cartItem->id == $request->get('product_id');
            })->first();
            $change_qty = $rowId->qty - 1;
            Cart::update($rowId->rowId,['qty' => $change_qty]);

        }
        if($request->get('product_id') && ($request->get('increment')) == 1){
            $rowId = Cart::search(function($cartItem, $rowID) use($request) {
                return $cartItem->id == $request->get('product_id');
            })->first();
            $change_qty = $rowId->qty + 1;
            Cart::update($rowId->rowId,['qty' => $change_qty]);

        }
        return redirect('Cart');

    }

    public function checkout () {
        $cart = Cart::content();

        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }
        return view('checkout',array('cart' => $cart,'totalPrice' => $total_price));
    }

    public function CartAgain () {
        $cart = Cart::content();

        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }
        return view('cart',array('cart' => $cart,'totalPrice' => $total_price));
    }

    public function checkoutContinue (Request $request) {

        $cart = Cart::content();

        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }
        //save CustomerData and CartData
        if ($request->isMethod('post')) {

            $this->customer_FN = $request->get('validationFN');
            $this->customer_LN = $request->get('validationLN');
            $this->customer_Email = $request->get('validationEmail');
            $this->customer_Address = $request->get('validationAddress');
            $this->customer_City = $request->get('validationCity');
            $this->customer_Province = $request->get('validationProvince');
            $this->customer_PostalCode = $request->get('validationPostal_Code');
            $this->customer_shipping_Address = $request->get('shipping_validationAddress');
            $this->customer_shipping_City = $request->get('shipping_validationCity');
            $this->customer_shipping_Province = $request->get('shipping_validationProvince');
            $this->customer_shipping_PostalCode = $request->get('shipping_validationPostal_Code');
            $this->customer_Phone = $request->get('validationPhone');

            $checked = $request->get('same_billing_address');
            session()->put('customer_FN', $this->customer_FN);
            session()->put('customer_LN', $this->customer_LN);
            session()->put('customer_Email', $this->customer_Email);
            session()->put('customer_Address', $this->customer_Address);
            session()->put('customer_City', $this->customer_City);
            session()->put('customer_Province', $this->customer_Province);
            session()->put('customer_PostalCode', $this->customer_PostalCode);
            session()->put('customer_Phone', $this->customer_Phone);
            if($checked == 'on'){
                session()->put('customer_shipping_Address', $this->customer_Address);
                session()->put('customer_shipping_City', $this->customer_City);
                session()->put('customer_shipping_Province', $this->customer_Province);
                session()->put('customer_shipping_PostalCode', $this->customer_PostalCode);
            }else{
                session()->put('customer_shipping_Address', $this->customer_shipping_Address);
                session()->put('customer_shipping_City', $this->customer_shipping_City);
                session()->put('customer_shipping_Province', $this->customer_shipping_Province);
                session()->put('customer_shipping_PostalCode', $this->customer_shipping_PostalCode);
            }


        }



        return view('stripe',array('cart' => $cart,'totalPrice' => $total_price));
    }

    public function stripe()
    {
        return view('stripe');
    }
    public function stripePost(Request $request)
    {

        $this->customer_FN = session()->get('customer_FN');
        $this->customer_LN = session()->get('customer_LN');
        $this->customer_Email = session()->get('customer_Email');
        $this->customer_Address = session()->get('customer_Address');
        $this->customer_City = session()->get('customer_City');
        $this->customer_Province = session()->get('customer_Province');
        $this->customer_PostalCode = session()->get('customer_PostalCode');
        $this->customer_Phone = session()->get('customer_Phone');
        $this->customer_shipping_Address = session()->get('customer_shipping_Address');
        $this->customer_shipping_City = session()->get('customer_shipping_City');
        $this->customer_shipping_Province = session()->get('customer_shipping_Province');
        $this->customer_shipping_PostalCode = session()->get('customer_shipping_PostalCode');
        $cart = Cart::content();

        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $total_price * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        //save or update customer...
        $customer = DB::table('customers')->where('email', $this->customer_Email)->first();

        if($customer){
            $customer_ID = $customer->id;
            DB::table('customers')
                ->where('id', $customer_ID)
                ->update([
                    'firstName' => $this->customer_FN,
                    'lastName' => $this->customer_LN,
                    'Address' => $this->customer_Address,
                    'City' =>$this->customer_City,
                    'Province' => $this->customer_Province,
                    'PostalCode' => $this->customer_PostalCode,
                    'Phone' => $this->customer_Phone,
                    'shipping_Address' => $this->customer_shipping_Address,
                    'shipping_City' =>$this->customer_shipping_City,
                    'shipping_Province' => $this->customer_shipping_Province,
                    'shipping_PostalCode' => $this->customer_shipping_PostalCode,
                ]);
        }else{
            $customer1 = new Customer();
            $customer1->firstName = $this->customer_FN;
            $customer1->lastName = $this->customer_LN;
            $customer1->email = $this->customer_Email;
            $customer1->Address = $this->customer_Address;
            $customer1->City = $this->customer_City;
            $customer1->Province = $this->customer_Province;
            $customer1->PostalCode = $this->customer_PostalCode;
            $customer1->Phone = $this->customer_Phone;
            $customer1->shipping_Address = $this->customer_shipping_Address;
            $customer1->shipping_City = $this->customer_shipping_City;
            $customer1->shipping_Province = $this->customer_shipping_Province;
            $customer1->shipping_PostalCode = $this->customer_shipping_PostalCode;
            $customer1->save();

            $customer_ID = $customer1->id;
        }


        // save orders.....
        $order = new Order();
        $order->order_number = Hash::make($order->id);
        $order->customer_id = $customer_ID;
        $order->grand_total = $total_price;
        $order->item_count = $cart->count();
        $order->first_name = $this->customer_FN;
        $order->last_name = $this->customer_LN;
        $order->address = $this->customer_Address;
        $order->city = $this->customer_City;
        $order->province = $this->customer_Province;
        $order->post_code = $this->customer_PostalCode;
        $order->phone_number = $this->customer_Phone;
        $order->save();

        $orderID = $order->id;

        // save order items ...
        foreach ($cart as $order_item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $orderID;
            $orderItem->product_id = $order_item->id;
            $orderItem->quantity = $order_item->qty;
            $orderItem->price = $order_item->price;
            $orderItem->save();
        }



        $cart = Cart::content();

        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }

        Session::flash('success', 'Payment successful!');
        Cart::destroy();


        return view('stripe',array('cart' => $cart,'totalPrice' => $total_price));
    }

}
