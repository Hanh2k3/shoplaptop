<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    use HasFactory;


    public function getListProducts() {

        $list = DB::table('product')
                    -> join('brand', 'product.brand_id', '=', 'brand.id')
                    -> join('category', 'product.category_id', '=', 'category.id')
                    ->select('product.*', 'brand.name as brand_name', 'category.name as category_name')
                    -> get();
        return $list;

    }

    public function add_product($data) {
        $add = DB::table('product') -> insert($data);
        return $add; 
    }

    public function active($id) {
        $active = DB::table('product')-> where('id', $id)-> update(['status'=>1]);
        return $active;
    }
    public function unactive($id) {
        $active = DB::table('product')-> where('id', $id)-> update(['status'=>0]);
        return $active;
    }

    public function deleteProduct($id) {
        $del = DB::table('product')->where('id', $id)-> delete();
        return $del;
    }

    public function updateProduct($data, $id) {
        $update = DB::table('product')->where('id', $id) -> update($data);
        return $update;
    }

    // get product active
    public function getProductActive() {
        $list = DB::table('product')-> where('status', 0) -> limit(4)-> get();
        return $list;
    }

    // get brand_product for home page only
    public function getBrandProduct($id) {
        $products = DB::table('product')
                    -> join('brand', 'product.brand_id', '=', 'brand.id')
                    -> orderBy('brand_id', 'DESC')
                    -> select('product.*', 'brand.name as brand_name')
                    -> where('product.brand_id', $id)
                    -> get();
        return $products;
    }
    
    // get category_product 
    public function getCategoryProduct($id) {
        $products = DB::table('product')
                    -> join('category', 'product.category_id', '=', 'category.id')
                    -> orderBy('category_id', 'DESC')
                    -> select('product.*', 'category.name as category_name')
                    -> where('product.category_id', $id)
                    -> get();
        return $products;

    }

    // get detail product 
    public function getProduct($id) {
        $product = DB::table('product')
                   -> join('category', 'product.category_id', '=', 'category.id')
                   -> join('brand', 'product.brand_id', '=', 'brand.id')
                   -> where('product.id', '=', $id)
                   -> select('product.*', 'brand.name as brand_name', 'category.name as category_name')
                   -> first();
        return $product; 
    }

    public function getCategoryProductDe($id, $id_product) {
        $products = DB::table('product')
                    -> join('category', 'product.category_id', '=', 'category.id')
                    -> orderBy('category_id', 'DESC')
                    -> select('product.*', 'category.name as category_name')
                    -> where('product.category_id', $id)
                    -> whereNotIn('product.id', [$id_product])
                    -> limit(3)
                    -> get();
        return $products;

    }

    public function getBrandProductDe($id, $id_product) {
        $products = DB::table('product')
                    -> join('brand', 'product.brand_id', '=', 'brand.id')
                    -> orderBy('brand_id', 'DESC')
                    -> select('product.*', 'brand.name as brand_name')
                    -> where('product.brand_id', $id)
                    -> whereNotIn('product.id', [$id_product])
                    -> limit(3)
                    -> get();
        return $products;
    }

    // get detail product for order_detail 
    public function get_product_order_detail($id) {
        $product = DB::table('product') -> where('id', $id)->first();
    }

}
