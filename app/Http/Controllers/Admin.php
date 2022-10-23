<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel; 
use Session;

session_start();


class Admin extends Controller
{   
    
    private $db = null ;
    public function __construct(){
        $this->db = new AdminModel(); 

    }
    public function AuthLogin(Request $request) {
        $admin_id = $request->session()->get('admin_id');
       
        if(!$admin_id) {
          
            return true;
        }
    }
    public function index() {
        return view('admin_login'); 
    }

    public function logout(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }

        $request->session()->put('admin_name', null);
        $request->session()->put('admin_id',null);

        return redirect()->route('admin.login'); 
    }

    public function dashboard_show(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    public function dashboard(Request $request) {
       
        $email = $request->admin_email;
        $password = trim(MD5($request->admin_password));

        // hanh dep trai
  
        $result = $this->db->checkAdmin($email, $password);

        if($result) {
            
            $request->session()->put('admin_name', $result->admin_name);
            $request->session()->put('admin_id',$result->id);
            return view('admin.dashboard', compact('result')); 
        } else {
            $request->session()->put('message', 'Email hoặc mật khẩu không đúng');
            return redirect() -> route('admin.login'); 
        }
        

        return view('admin.dashboard');
    }



    public function createAdmins() {
        $data = [
            'admin_name' => 'Hanh',
            'admin_password' => MD5('1'),
            'admin_phone' => '123',
            'admin_email' => 'h@gmail.com',

        ];
        $this->db->createAccount($data);


    }
}
