<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order_detail extends Model
{
    use HasFactory;

    public function insert_order_detail($data) {
        $insert_order_detail = DB::table('order_detail') -> insertGetId($data);
        return $insert_order_detail;
    }

    public function get_order_detail($id) {
        $order_detail = DB::table('order_detail')
                        -> where('order_id', $id)
                        -> get();
        return $order_detail;
    }
}

