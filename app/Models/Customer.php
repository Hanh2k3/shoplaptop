<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

  
    public function insertCustomer($data) {
        $customerId = DB::table("customer")->insertGetId($data);
        return $customerId;
    }

    public function checkCustomer($data) {
        $result = DB::table("customer")-> where('email', $data['email']) -> where('password', $data['password']) -> first();
        return $result;
    }
}
