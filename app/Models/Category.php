<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public function add_category($data) {
        $resutl = DB::table('category') -> insert($data);
        return $resutl;
    }

    public function getCategoryList() {
        $list_categories = DB::table('category')->get();

        return $list_categories;
    }

    public function active($id) {
        $active = DB::table('category')-> where('id', $id)-> update(['status'=>1]);
        return $active;
    }

    public function unactive($id) {
        $unactive = DB::table('category')-> where('id', $id)-> update(['status'=>0]);
        return $unactive;
    }

    public function deleteCategory($id) {
        $del = DB::table('category')->where('id', $id)->delete();
        return $del;
    }

    public function updateCategory($data, $id) {
        $up = DB::table('category')->where('id', $id)->update($data);
        return $up;
    }
    // get category active 
    public function getCategoryActive() {
        $list = DB::table('category')-> where('status',0) -> get();
        return $list;
    }

    public function getCategoryName($id = null) {
        $name = DB::table('category')->where('id', $id)-> select('name')-> first();
        return $name; 

    }

    public function getCategoryMeta($id) {
        $meta = DB::table('category')->where('id', $id)-> select('meta_keyword', 'meta_desc') -> first();
        return $meta; 
    }
}
