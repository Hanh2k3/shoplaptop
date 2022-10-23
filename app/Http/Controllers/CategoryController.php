<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

session_start();

class CategoryController extends Controller
{
    private $db = null ; 

    public function __construct() {
        $this->db = new Category();
    }
    public function AuthLogin(Request $request) {
        $admin_id = $request->session()->get('admin_id');
       
        if(!$admin_id) {
          
            return true;
        }
    }
    public function add_category(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }
        return view('admin.add_category');
    }

    public function all_category(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }
        $list_categories = $this->db->getCategoryList();
        return view('admin.all_category', compact('list_categories'));
    }

    public function save_category(Request $request) {

        
        $request->validate([
            'name' => ['required', 'unique:category,name,'],
            'category_desc' => ['required'],
            'category_status' => ['required'],
            'meta_keyword' => ['required'], 
            'meta_desc' => ['required']

        ]
        ,[
            'name.required' => 'Vui lòng nhập tên loại sản phẩm!',
            'name.unique' => 'Loại sản phẩm đã tồn tại',
            'category_desc.required' => 'Vui lòng nhập mô tả loại sản phẩm!',
            'category_status.required' => 'Vui lòng chọn trạng thái!',
            'meta_keyword.required' => 'Vui lòng nhập keywords cho danh mục', 
            'meta_desce.required' => 'Vui lòng nhập mô tả cho danh mục'
        ]);

        $name = $request->name;
        $desc = $request->category_desc;
        $status = $request->category_status;
        $meta_keyword = $request->meta_keyword;
        $meta_desc = $request->meta_desc ; 
        $data = [
            'name' => $name,
            'description' => $desc,
            'status' => $status,
            'meta_keyword' => $meta_keyword,
            'meta_desc' => $meta_desc,
            
        ];

        $result = $this->db->add_category($data);

        $request->session()->put('add_success', 'Thêm loại sản phẩm thành công');

        return redirect() -> route('category.all');

    }

    public function active_category(Request $request, $id) {
        $rs = $this->db->active($id);
        $request->session()->put('msg','Ẩn');
        return redirect() -> route('category.all');
    }

    public function unactive_category(Request $request, $id) {
        $rs = $this->db->unactive($id);
        $request->session()->put('msg','Hiển thị');
        return redirect() -> route('category.all');

    }

    public function delete_category($id) {
        $rs = $this->db -> deleteCategory($id);
        return redirect() -> route('category.all');

    }
    
    public function edit($id) {
        



        return view('admin.edit_category', compact('id'));
    }

    public function edit_category(Request $request, $id) {

         
        $request->validate([
            'name' => ['required'],
            'category_desc' => ['required'],
            'meta_keyword' => ['required'],
            'meta_desc' => ['required'],
           
        ]
        ,[
            'name.required' => 'Vui lòng nhập tên loại sản phẩm!',
            'name.unique' => 'Loại sản phẩm đã tồn tại',
            'category_desc.required' => 'Vui lòng nhập mô tả loại sản phẩm!',
            'meta_keyword.required' => 'Vui lòng nhập key word ', 
            'meta_desc.required' => 'Vui lòng nhập mô tả key word '          
        ]);
       
        $name = $request->name;
        $desc = $request->category_desc;
        $meta_keyword = $request->meta_keyword;
        $meta_desc = $request->meta_desc;
        $data = [
            'name' => $name,
            'description' => $desc,
            'meta_keyword' => $meta_keyword,
            'meta_desc' => $meta_desc,
            'updated_at' => now()
        ];
        $request->session()->put('msg','Chỉnh sửa thành công');
        $rs = $this->db -> updateCategory($data,$id);
        return redirect() -> route('category.all');
    }
}
