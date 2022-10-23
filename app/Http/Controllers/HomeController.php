<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index() {
        $brad = new Brand();
        $list_brand = $brad->getBrandActive();

        $category = new Category();
        $list_categories = $category->getCategoryActive();

        $product = new Product();
        $list_product = $product->getProductActive();


        
        return view('pages.home', compact('list_brand', 'list_categories', 'list_product'));
    }

    public function category(Request $request, $id) {
        $db = new Product();
        $list_product = $db->getCategoryProduct($id);

        $category = new Category();
        $categoryName = $category->getCategoryName($id);
        $categoryMeta = $category->getCategoryMeta($id);

        return view('pages.category.category', compact('list_product', 'categoryName', 'categoryMeta')); 
        
    }

    public function brand(Request $request, $id) {      
        $brand = new Brand();
        $brandName = $brand->getBrandName($id);
        $db = new Product();
        $list_product = $db->getCategoryProduct($id);
  
       
        return view('pages.brand.brand', compact('list_product', 'brandName')); 


    }
    // detailProduct
    public function detail($id) {
        $db = new Product();
        $product = $db-> getProduct($id);
        $category_id = $product-> category_id;
        $brand_id = $product-> brand_id;
        

        $product_category = $db->getCategoryProductDe($category_id, $id);
        $product_brand = $db->getBrandProductDe($brand_id, $id);

   



        
        return view("pages.product.detail", compact('product', 'product_category', 'product_brand'));
    }


}
