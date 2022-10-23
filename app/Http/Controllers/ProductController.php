<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private $db = null ; 

    public function __construct() {
        $this->db = new Product();
    }
    public function AuthLogin(Request $request) {
        $admin_id = $request->session()->get('admin_id');
       
        if(!$admin_id) {
          
            return true;
        }
    }
    public function add_product(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }

        return view('admin.product.add_product');
    }

    public function all_product(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }


        $list_products = $this->db->getListProducts();
      
 
        return view('admin.product.all_product', compact('list_products'));
    }

    public function save_product(Request $request) {
       
   
        $request->validate([
            'name' => ['required', 'unique:product,name,'],
            'price' => ['required'],
            'image' => ['required'],
            'product_content' => ['required'],
            'product_desc' => ['required'],
            'product_brand' => ['required'],
            'product_category' => ['required'],
            'product_status' => ['required']

        ]
        ,[
            'name.required' => 'Vui lòng nhập tên sản phẩm!',
            'name.unique' => 'Sản phẩm đã tồn tại!',
            'price.required' => 'Vui lòng nhập giá sản phẩm!',
            'image.required' => 'Vui lòng chọn hình ảnh',
            'product_content.required' => 'Vui lòng nhập nội dung sản phẩm',
            'product_brand.required' => 'Vui lòng chọn thương hiệu !',
            'product_category.required' => 'Vui lòng chọn danh mục',
            'product_desc.required' => 'Vui lòng nhập mô tả sản phẩm!',
            'product_status.required' => 'Vui lòng chọn trạng thái!',
        ]);

        $name = $request->name;
        $price = $request->price;

        $image = $request -> file('image');
    
        $imgName = current(explode('.', $image->getClientOriginalName()));
        $extension = $image-> getClientOriginalExtension();
        $img = $imgName.rand(1,100).'.'.$extension;
        $image -> move('uploads/product', $img);


        $category_id = $request->product_category;
        $brand_id = $request->product_brand;
        $content = $request->product_content;
        
        $desc = $request->product_desc;
        $status = $request->product_status;
        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $category_id,
            'brand_id' => $brand_id,
            'image' => $img,
            'content' => $content,
            'description' => $desc,
            'status' => $status,
            
        ];

        
        $result = $this->db->add_product($data);

        $request->session()->put('add_success', 'Thêm thương hiệu thành công');
        return redirect() -> route('product.all');

    }

    public function active_product(Request $request, $id) {
        $rs = $this->db->active($id);
        $request->session()->put('msg','Ẩn');
        return redirect() -> route('product.all');
    }

    public function unactive_product(Request $request, $id) {
        $rs = $this->db->unactive($id);
        $request->session()->put('msg','Hiển thị');
        return redirect() -> route('product.all');

    }

    public function delete_product($id) {
        $rs = $this->db -> deleteProduct($id);
        return redirect() -> route('product.all');

    }
    
    public function edit($id) {

        
        return view('admin.product.edit_product', compact('id'));
    }
    public function edit_product(Request $request, $id) {

         
        $request->validate([
            'name' => ['required', ],
            'price' => ['required'],
            'image' => ['required'],
            'product_content' => ['required'],
            'product_desc' => ['required'],
            'product_brand' => ['required'],
            'product_category' => ['required'],
            'product_status' => ['required']

        ]
        ,[
            'name.required' => 'Vui lòng nhập tên sản phẩm!',
            'name.unique' => 'Sản phẩm đã tồn tại!',
            'price.required' => 'Vui lòng nhập giá sản phẩm!',
            'image.required' => 'Vui lòng chọn hình ảnh',
            'product_content.required' => 'Vui lòng nhập nội dung sản phẩm',
            'product_brand.required' => 'Vui lòng chọn thương hiệu !',
            'product_category.required' => 'Vui lòng chọn danh mục',
            'product_desc.required' => 'Vui lòng nhập mô tả sản phẩm!',
            'product_status.required' => 'Vui lòng chọn trạng thái!',
        ]);

        $name = $request->name;
        $price = $request->price;
        $image = $request -> file('image');
    
        $imgName = current(explode('.', $image->getClientOriginalName()));
        $extension = $image-> getClientOriginalExtension();
        $img = $imgName.rand(1,100).'.'.$extension;
        $image -> move('uploads/product', $img);


        $category_id = $request->product_category;
        $brand_id = $request->product_brand;
        $content = $request->product_content;
        
        $desc = $request->product_desc;
        $status = $request->product_status;
        $data = [
            'name' => $name,
            'price' => $price,
            'category_id' => $category_id,
            'brand_id' => $brand_id,
            'image' => $img,
            'content' => $content,
            'description' => $desc,
            'status' => $status,
            'updated_at' => now()
            
        ];
        $request->session()->put('msg','Chỉnh sửa thành công');
        $rs = $this->db -> updateProduct($data,$id);
        return redirect() -> route('product.all');

    }
    // detail prodcut 

    

    
}
