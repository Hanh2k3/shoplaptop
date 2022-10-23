<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    
    private $db = null ; 

    public function __construct() {
        $this->db = new Brand();
    }
    public function AuthLogin(Request $request) {
        $admin_id = $request->session()->get('admin_id');
       
        if(!$admin_id) {
          
            return true;
        }
    }
    public function add_brand(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }

        return view('admin.add_brand');
    }

    public function all_brand(Request $request) {
        $auth = $this->AuthLogin($request);

        if($auth) {
            return redirect()->route('admin.login');
        }
        

        $list_brands = $this->db->getBrandList();
        return view('admin.all_brand', compact('list_brands'));
    }

    public function save_brand(Request $request) {
       

        
        $request->validate([
            'name' => ['required', 'unique:brand,name,'],
            'brand_desc' => ['required'],
            'brand_status' => ['required']

        ]
        ,[
            'name.required' => 'Vui lòng nhập tên thương hiệu!',
            'name.unique' => 'Thương hiệu đã tồn tại',
            'brand_desc.required' => 'Vui lòng nhập mô tả thương hiệu!',
            'brand_status.required' => 'Vui lòng chọn trạng thái!',
        ]);

        $name = $request->name;
        $desc = $request->brand_desc;
        $status = $request->brand_status;
        $data = [
            'name' => $name,
            'description' => $desc,
            'status' => $status,
            
        ];

        

        $result = $this->db->add_brand($data);

        $request->session()->put('add_success', 'Thêm thương hiệu thành công');

        return redirect() -> route('brand.all');

    }

    public function active_brand(Request $request, $id) {
        $rs = $this->db->active($id);
        $request->session()->put('msg','Ẩn');
        return redirect() -> route('brand.all');
    }

    public function unactive_brand(Request $request, $id) {
        $rs = $this->db->unactive($id);
        $request->session()->put('msg','Hiển thị');
        return redirect() -> route('brand.all');

    }

    public function delete_brand($id) {
        $rs = $this->db -> deleteBrand($id);
        return redirect() -> route('brand.all');

    }
    
    public function edit($id) {
        



        return view('admin.edit_brand', compact('id'));
    }

    public function edit_brand(Request $request, $id) {

         
        $request->validate([
            'name' => ['required'],
            'brand_desc' => ['required'],
           
        ]
        ,[
            'name.required' => 'Vui lòng nhập tên thương hiệu !',
            'name.unique' => 'Loại thương hiệu  đã tồn tại',
            'brand_desc.required' => 'Vui lòng nhập mô tả thương hiệu !',          
        ]);
       
        $name = $request->name;
        $desc = $request->brand_desc;
        $data = [
            'name' => $name,
            'description' => $desc,
            'updated_at' => now()
        ];
        $request->session()->put('msg','Chỉnh sửa thành công');
        $rs = $this->db -> updatebrand($data,$id);
        return redirect() -> route('brand.all');

    }

}
