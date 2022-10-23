<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    use HasFactory;
    
    public function __construct(){

    }

    public function checkAdmin($email, $password) {
        $result = DB::table('tbl_admin') ->where('admin_email', $email) ->where('admin_password',$password) ->first();

        return $result; 

    }

    public function createAccount($data) {
        $result = DB::table('tbl_admin') -> insert($data);
    }
}
