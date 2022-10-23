<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;

    public function add_brand($data) {
        $resutl = DB::table('brand') -> insert($data);
        return $resutl;
    }

    public function getBrandList() {
        $list_categories = DB::table('brand')->get();

        return $list_categories;
    }

    public function active($id) {
        $active = DB::table('brand')-> where('id', $id)-> update(['status'=>1]);
        return $active;
    }

    public function unactive($id) {
        $unactive = DB::table('brand')-> where('id', $id)-> update(['status'=>0]);
        return $unactive;
    }

    public function deleteBrand($id) {
        $del = DB::table('brand')->where('id', $id)->delete();
        return $del;
    }

    public function updateBrand($data, $id) {
        $up = DB::table('brand')->where('id', $id)->update($data);
        return $up;
    }

    // get brand active
    public function getBrandActive() {
        $list = DB::table('brand')-> where('status', 0) ->get();
        return $list;
    }
    // get name brand 
    public function getBrandName($id) {
        $name = DB::table('brand')->where('id', $id)-> select('name')-> first();
        return $name; 

    }
}
