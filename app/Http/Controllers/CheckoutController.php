<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Payment; 
use Cart; 

class CheckoutController extends Controller
{   
    private $db = null ;
    private $db_order ; 
    private $db_payment ; 
    private $db_order_detail ; 

    public function __construct() {
        $this->db = new Shipping();
        $this->db_order = new Order();
        $this->db_order_detail = new Order_Detail();
        $this->db_payment = new Payment();
    }
    
    public function login_checkout() {
        return view('pages.check_out.login_checkout');
    }

   public function checkout(){

        return view('pages.check_out.check_out');

   }


   // save shipping
   public function save_checkout(Request $request) {
            $request -> validate([
                'email' => ['required', 'email'],
                'name' => ['required'],
                'phone' => ['required'],
               
                'address' => ['required']
               ],[
                'email.required' => "Vui lòng nhập email",
                'email.email' => "Email không đúng định dạng",
               
                'phone.required' => "Vui lòng nhập số điện thoại",
                'name.required' => "Vui lòng nhập tên",
                'address.required' => "Vui lòng nhập địa chỉ"            
                ]); 

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['customer_id'] = $request->session() -> get('customer_id');
        $data['address'] = $request->address;
        if(!empty($request-> notes)) {
            $data['notes'] = $request->notes;
        }
        
        $shipping_id = $this ->db->  addShipping($data);
        $request-> session()->put('shipping_id',$shipping_id);
        return redirect() -> route('checkout.payment');
        
   }

   public function payment() {
            return view('pages.check_out.payment');
   }


   public function order_place(Request $request) {

        // add data into table payment 
        $payment['method'] = $request->payment_option;
        $payment['status'] = 1 ; 
        $payment_id = $this->db_payment -> insert_payment($payment);


        // add data into table order
        $content = Cart::content();
        $total = Cart::total();

        $order['customer_id'] = $request-> session()-> get('customer_id');
        $order['payment_id'] = $payment_id;
        $order['shipping_id'] = $request-> session()-> get('shipping_id');
        $order['status'] = 1;
        $order['total'] = $total;

        $order_id = $this->db_order -> insert_order($order);

        // add data into table order_detail
        foreach ($content as $item) {
            $order_detail['order_id'] = $order_id;
            $order_detail['product_id'] = $item->id;
            $order_detail['product_name'] = $item->name;
            $order_detail['product_price'] = $item->price;
            $order_detail['sales_quantity'] = $item->qty;
            
            $this-> db_order_detail -> insert_order_detail($order_detail);
        } 
        Cart::destroy();

        return view('pages.check_out.susseces');
    
   }


   
}
