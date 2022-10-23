<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    public function insert_order($data) {
        $insert_order = DB::table('order') -> insertGetId($data);
        return $insert_order;
    }


    public function get_list_order() {
        $list = DB::table('order') 
                -> join('customer', 'order.id', '=', 'customer.id')
                -> join('payment', 'order.payment_id', '=', 'payment.id')
                -> select('order.*', 'customer.name as customer_name', 'payment.method')
                -> orderBy('order.id', 'ASC')
                -> get();
        return $list;
    }

    public function get_order($id) {
        $order = DB::table('order') 
                -> where('order.id', $id)
                -> join('customer', 'order.id', '=', 'customer.id')
                -> join('shipping', 'order.shipping_id', '=', 'shipping.id')
                -> select('customer.*', 'shipping.name as shipping_name', 'shipping.phone as shipping_phone', 'shipping.address as address')
                -> first();
        return $order ; 
    }

    public function remove_order($id) {
        $delete = DB::table('order') -> where('id', $id)-> delete();
        return $delete;
    }




}
