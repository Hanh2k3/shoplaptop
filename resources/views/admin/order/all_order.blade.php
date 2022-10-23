@extends('admin_layout')

@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
            Quản lý đặt hàng
      </div>

      <div>
        @php
          $msg = request()->session()->get('msg');
          
        @endphp

        @if ($msg)
            <p style="color: red;">{{$msg}}</p>
            @php
            request()->session()->put('msg', null);
            @endphp
        @endif


      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Tên người đặt</th>
              <th>Tổng tiền </th>
              <th>Tình trạng đơn hàng</th>
              <th>Hình thức thanh toán</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_order as $item)

              <tr>
              
                <td>{{$item->customer_name}}</td>
                <td>
                    <span class="text-ellipsis">     
                     {{$item->total}}
                    </span>
                </td>
                <td>
                  <span class="text-ellipsis">
                        @if ($item->status == 1)
                            <a href=""><span class="">Đang chờ xác nhận</span></a>
                        @else 
                            <a href=""><span>Qua bược tiếp theo</span></a>
                        @endif
                    </span>
                </td>
                <td>
                  <span class="text-ellipsis">
                      @if ($item->method == 1)
                          <span class="">Thanh toán khi nhận hàng</span>
                      @elseIf ($item->method == 2) 
                          <span>Thanh toán qua thẻ ngân hàng</span>
                      @else 
                          <span>Thanh toán VNPAY</span>
                      @endif
                  </span>
                    
                </td>
               
                <td>
                  <a href="{{route('manager_order.order_detail', ['id' => $item->id])}}" class="active" ui-toggle-class="" >
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                  </a>
                  <a href="{{route('manager_order.delete_order', ['id' => $item->id])}}"  class="active" ui-toggle-class="">
                     <i class="fa fa-times text-danger text"></i>
                  </a>
                </td>
            </tr>
            @endforeach
            
           
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection