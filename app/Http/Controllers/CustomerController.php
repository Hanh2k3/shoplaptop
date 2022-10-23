<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
session_start();

class CustomerController extends Controller
{
    //
    private $db = null ; 
    public function __construct() {
        $this->db = new Customer();
    }

    public function signup(Request $request) {

       $request -> validate([
            'email' => ['required', 'email', 'unique:customer,email'],
            'name' => ['required'],
            'phone' => ['required'],
            'password' => ['required']

       ],[
            'email.required' => "Vui lòng nhập email",
            'email.email' => "Email không đúng định dạng",
            'email.unique' => "Email đã đăng ký tài khoản",
            'password.required' => "Vui lòng nhập mật khẩu",
            'phone.required' => "Vui lòng nhập số điện thoại",
            'name.required' => "Vui lòng nhập tên"

        
       ]); 

       $data['name'] = $request->name;
       $data['email'] = $request->email;
       $data['phone'] = $request->phone;
       $data['password'] = MD5($request->password);

       $customerId = $this->db -> insertCustomer($data);
       $request->session()->put('customer_name', $request->name);
       $request->session()->put('customer_id', $customerId);
       return redirect() -> route('checkout.');
        
    }

    public function logout(Request $request) {
        $request->session()->put('customer_name', null);
        $request->session()->put('customer_id', null);
        $request->session()->put('shipping_id', null);
      
        return back();
    }

    public function login(Request $request) {
        
        $request -> validate([
            'email_login' => ['required', 'email'],
            'password_login' => ['required',]

        ],[
            'email_login.required' => 'Vui lòng nhập email',
            'email_login.email' => 'Email không đúng định dạng',
            'password_login.required' => 'Vui lòng nhập mật khẩu'

        ]);
        $email = $request -> email_login;
        $password = MD5($request -> password_login);
        $data['email'] = $email;
        $data['password'] = $password;

       

        $result = $this->db-> checkCustomer($data);
        if($result) {
            $request->session()->put('customer_name', $result->name);
            $request->session()->put('customer_id', $result->id);
            return redirect() -> route('checkout.');
        } else {
            // $request->session()->put('err','Mật khẩu hoặc tài khoản không đúng');
            return redirect() -> route('checkout.login_checkout') -> with('er', "Mật khẩu hoặc emai không đúng");
        }
    }


}
