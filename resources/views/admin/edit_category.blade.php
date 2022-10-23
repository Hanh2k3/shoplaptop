@extends('admin_layout')

@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục  loại sản phẩm 
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('category.updatePost', ['id' => $id])}}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục: </label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{old('name')}}"placeholder="Tên danh mục ....">
                            @error('name')
                                <p style="color:red; ">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea class="form-control"  name="category_desc" id="ck1" >
                                {{old('category_desc')}}
                            </textarea>

                            @error('category_desc')
                                <p style="color:red; ">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập keyworod</label>
                            <textarea class="form-control"  name="meta_keyword" id="ck2" >
                                {{old('meta_keyword')}}
                            </textarea>

                            @error('meta_keyword')
                                <p style="color:red; ">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả  keyworod</label>
                            <textarea class="form-control"  name="meta_desc" id="ck3" >
                                {{old('meta_desc')}}
                            </textarea>

                            @error('meta_desc')
                                <p style="color:red; ">{{$message}}</p>
                            @enderror
                                 
                        </div>
                            <button type="submit" class="btn btn-info" name="update_category">Cập nhật danh mục </button>
                            
                        </div>
                       
                        </div>

                       
                      
                       
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection