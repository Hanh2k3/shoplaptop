<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Order; 
use App\Models\Order_detail;

class OrderController extends Controller
{
    private $db_order ; 

    public function __construct() {
        $this->db_order = new Order();
    }

    public function AuthLogin(Request $request) {
        $admin_id = $request->session()->get('admin_id');
       
        if(!$admin_id) {
          
            return true;
        }
    }

    public function index(Request $request) {
        $auth = $this->AuthLogin($request);
        if($auth) {
            return redirect()->route('admin.login');
        }


        $all_order = $this->db_order-> get_list_order();
 
        
        return view('admin.order.all_order', compact('all_order'));
    }

    public function order_detail($id, Request $request) {
        $auth = $this->AuthLogin($request);
        if($auth) {
            return redirect()->route('admin.login');
        }
        $order = $this->db_order -> get_order($id);
        $order_detail = new Order_detail();
        $list_detail = $order_detail-> get_order_detail($id);
       
        return view('admin.order.order_detail', compact('order', 'list_detail'));

    }

    public function delete_order($id, Request $request) {
        $auth = $this->AuthLogin($request);
        if($auth) {
            return redirect()->route('admin.login');
        }

        $this->db_order -> remove_order($id);
        $request->session()->put('msg', 'Xóa đơn đặt hàng thành công');
        return redirect()->route('manager_order.');

        
    }
}
