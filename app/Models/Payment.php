<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;
    public function insert_payment($data) {
        $insert_payment = DB::table('payment') -> insertGetId($data);
        return $insert_payment;
    }
}
