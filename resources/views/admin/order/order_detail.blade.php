@extends('admin_layout')

@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
            Thông tin khách hàng
      </div>
     
      
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên khách hàng</th>
              <th>Số điện thoại</th>
            </tr>
          </thead>
          <tbody>   
            <tr>    
                <td>{{$order->name}}</td>
                <td>{{$order->phone}}</td>
            </tr>
        
          </tbody>
        </table>
      </div>
    </div>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
            Thông tin vận chuyển
      </div>

      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Tên người nhận</th>
              <th>Số điện thoại </th>
              <th>Địa chỉ</th>  
            </tr>
          </thead>
          <tbody>
           

              <tr>
                <td>{{$order->shipping_name}}</td>
                <td>{{$order->shipping_phone}}</td>
                <td>{{$order->address}}</td>
            </tr>
     
    
          </tbody>
        </table>
      </div>
    </div>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
            Chi tiết đơn hàng 
      </div>

      <div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($list_detail as $item )
            <tr>
               <td>{{$item->product_name}}</td>
                <td>{{number_format($item->product_price);}}</td>
                <td>{{$item->sales_quantity}}</td>
                
                <td>
                    {{number_format( $item->sales_quantity*$item->product_price);}}
                </td>
            </tr>
               
            @endforeach
           
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection