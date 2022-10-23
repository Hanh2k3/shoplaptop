<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shipping extends Model
{
    use HasFactory;

    public function addShipping($data) {
        $add = DB::table('shipping') -> insertGetId($data);
        return $add ; 
    }
}
