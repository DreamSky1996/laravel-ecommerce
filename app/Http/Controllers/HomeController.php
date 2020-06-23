<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use  App\User;
use  App\Order;
use  App\Customer;
use  Cart;
use Session;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function dashboard() {
        $perPage = 5;
        $pagNam = 1;
        $subdate_Option = 0;


        $subdate = null;
        switch ($subdate_Option){
            case 0:
                $subdate = Carbon::now()->subDays(30);
                break;
            case 1:
                $subdate = Carbon::now()->subMonth();
                break;
            case 2:
                $subdate = Carbon::now()->subMonths(6);
                break;
            case 3:
                $subdate = Carbon::now()->subYear();
                break;
        }

        $orders = Order::whereDate('created_at', '>',$subdate )->orderBy('updated_at', 'DESC')->paginate($perPage,['*'],'page',$pagNam);
        return view('backend.dashboard',array('orders' => $orders,'pageNum' => $pagNam,'perPage' => $perPage));
    }

    public function orders(){
        $perPage = 7;
        $pagNam = 1;
        $orders = Order::orderBy('updated_at', 'DESC')->paginate($perPage,['*'],'page',$pagNam);
        return view('backend.orders',array('orders' => $orders, 'pageNum' => $pagNam,'perPage' => $perPage));
    }
    public function orderInfo(Request $request){
        $order_id = $request->input('order_id');
        $order = Order::whereId($order_id)->get()->first();
        $customer = Customer::whereId($order->customer_id)->get()->first();
        $items = $order->items()->get();
        foreach ($items as $item)
        {
            $product = Product::find($item->product_id);
            Cart::add(array('id' => $product->id, 'name' => $product->product_name, 'qty' => $item->quantity, 'price' => $item->price, 'weight' => 0));
        }
        $cart = Cart::content();
        Cart::destroy();
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }
        return view('backend.Individual_order',array('customer'=> $customer,'cart' => $cart,'total_price' => $total_price));
    }
    function order_data(Request $request)
    {
        if($request->ajax())
        {
            $perPage = 7;
            $pagNam = $request->get('page');
            $orders = Order::orderBy('updated_at', 'DESC')->paginate($perPage,['*'],'page',$pagNam);
            return view('backend.ordersPagination', array('orders' => $orders,'pageNum' => $pagNam,'perPage' => $perPage))->render();
        }
    }

    public function order_info(Request $request){
        $order_id = $request->input('order_id');
        $order = Order::whereId($order_id)->get()->first();
        $customer = Customer::whereId($order->customer_id)->get()->first();
        $items = $order->items()->get();
        foreach ($items as $item)
        {
            $product = Product::find($item->product_id);
            Cart::add(array('id' => $product->id, 'name' => $product->product_name, 'qty' => $item->quantity, 'price' => $item->price, 'weight' => 0));
        }
        $cart = Cart::content();
        Cart::destroy();
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }
        return view('backend.dashboard_order',array('customer'=> $customer,'cart' => $cart,'total_price' => $total_price));
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $perPage = 5;
            $subdate_Option = $request->get('option');
            $pagNam = $request->get('page');

            $subdate = null;
            switch ($subdate_Option){
                case 0:
                    $subdate = Carbon::now()->subDays(30);
                    break;
                case 1:
                    $subdate = Carbon::now()->subMonth();
                    break;
                case 2:
                    $subdate = Carbon::now()->subMonths(6);
                    break;
                case 3:
                    $subdate = Carbon::now()->subYear();
                    break;
            }

            $orders = Order::whereDate('updated_at', '>',$subdate )->orderBy('updated_at', 'DESC')->paginate($perPage,['*'],'page',$pagNam);
            return view('backend.pagination_orders', array('orders' => $orders,'pageNum' => $pagNam,'perPage' => $perPage))->render();
        }
    }


    public function addUser()
    {
        return view('backend.add-user');
    }

    public function saveUser(Request $request)
    {
        $user = new User();
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->role = $request->input('role');
        $tempUser = User::where('email',$request->input('email'))->get();
        if($tempUser->count() > 0){
            Session::flash('warning', 'Email already exists!');
            return back();
        }
        $user->email = $request->input('email');
        $user->phone = $request->input('phoneNumber');
        $user->password = Hash::make($request->input('password'));
//        $user->lat = '12.31232, 13.34544';
        $address_latitude = $request->input('address_latitude');
        $address_longitude = $request->input('address_longitude');
        $user->lat = $address_latitude . ',' . $address_longitude;
        $user->save();
        Session::flash('message', 'Successful Added!');
        print $request->input('role');
        return back();
    }

    public function employeeShow()
    {
        $employees = User::all();
        $employee_id = session()->get('employee_id');
        session()->remove('employee_id');
        $employee = User::find($employee_id);

        return view('backend.employee', compact('employees','employee'));
    }

    public function customerInfo(Request $request)
    {
        $customers = Customer::all();
        $cart = Cart::content();
        Cart::destroy();
        $customer_id = session()->get('customer_id');
        session()->remove('customer_id');
        $custom = Customer::find($customer_id);
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->qty * $item->price;
        }
        $edit_flag = session()->get('edit_flag');
        session()->remove('edit_flag');
        return view('backend.CustomInfo',array('customers' => $customers, 'cart' => $cart, 'total_price' => $total_price,'custom' => $custom, 'editFlag' =>$edit_flag));
    }

    public function customerMoreInfo(Request $request)
    {
        $customer_id = $request->get('customer_id');
        session()->put('customer_id', $customer_id);
        session()->put('edit_flag', false);
        $customer = Customer::find($customer_id);
        $orders = $customer->orders()->get();
        foreach ($orders as $order)
        {
            $items = $order->items()->get();
            foreach ($items as $item)
            {
                $product = Product::find($item->product_id);
                Cart::add(array('id' => $product->id, 'name' => $product->product_name, 'qty' => $item->quantity, 'price' => $item->price, 'weight' => 0));
            }
        }
        return back();
    }

    public function customerEdit(Request $request){
        $customer_id = $request->get('customer_id');
        session()->put('customer_id', $customer_id);
        session()->put('edit_flag', true);
        return back();
    }

    public function customerUpdate(Request $request){
        $customer_id = $request->get('customer_id');
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $email = $request->get('email');
        $phone = $request->get('phoneNumber');
        $city = $request->get('city');
        $address = $request->get('address');
        $province = $request->get('province');
        $postalCode = $request->get('postalCode');
        $shipping_city = $request->get('shipping_city');
        $shipping_address = $request->get('shipping_address');
        $shipping_province = $request->get('shipping_province');
        $shipping_postalCode = $request->get('shipping_postalCode');
        session()->put('customer_id', $customer_id);
        session()->put('edit_flag', true);
        $data = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'Address' => $address,
            'City' => $city,
            'Phone' => $phone,
            'Province' => $province,
            'PostalCode' => $postalCode,
            'shipping_Address' => $shipping_address,
            'shipping_City' => $shipping_city,
            'shipping_Province' => $shipping_province,
            'shipping_PostalCode' => $shipping_postalCode,
            );
        Customer::whereId($customer_id)->update($data);
        Session::flash('message', 'Successful Updated!');

        return back();
    }

    public function customerReset()
    {
        echo 'coming soon!';
    }

    //profile update
    public function myProfile()
    {
        return view('backend.profile');
    }

    public function updateProfile(Request $request)
    {
        $id = $request->currentUser;
        $data = array(
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phoneNumber,
            'password' => Hash::make($request->input('password')),
        );
        User::whereId($id)->update($data);
        Session::flash('message', 'Successful Updated!');
        return back();
    }

    public function employeeMoreInfo(Request $request)
    {
        $employee_id = $request->input('employee_id');
        session()->put('employee_id', $employee_id);
        return back();
    }

    public function saveUpdatedUser(Request $request)
    {
        $id = $request->input('userId');
//        $username = $request->input('firstName');
//        $message = $username . ' Was Updated!';
		 $lat = $request->input('address_latitude').",".$request->input('address_longitude');
        $data = array(
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phoneNumber,
            'role' => $request->role,
            'lat' => $lat
        );
        User::whereId($id)->update($data);
//        Session::flash('message', $message);
        //$employees = User::all();
        //return view('backend.employee', compact('employees'));
        return back();
    }

    public function adminPassword(){
        return view('backend.adminpassword');
    }

    public function resetAdminPassword(Request $request){
        $password = $request->input('password');
        $re_password = $request->input('re_password');
        if ($password == $re_password){
            $data = array('password' => Hash::make($password));
            DB::table('users')->where('role', 'Admin')->update($data);
            return view('backend.dashboard');
        }
        else{
            return view('backend.adminpassword');
        }
    }
}
