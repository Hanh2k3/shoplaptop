@extends('main')

@section('content')
@php
$content = Cart::content();
@endphp
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Trang chủ</a></li>
              <li class="active">PAYMENT</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $product)            
                    <tr>
                        @php
                            $img = $product-> options['image'];
                  
                        @endphp
                        <td class="cart_product " style="width: 100px; ">
                            <a href="{{route('product_detai', ['id' => $product->id])}}" style="display:block ; width:100%; height:100px;" ><img src="{{asset("uploads/product/$img")}}" style="width:100%; height:100px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$product->name}}</a></h4>
                            <p>Mã sản phẩm: {{$product->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($product->price)." "."VND"}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{route('cart.update')}}" method="POST">
                                    @csrf
                                    <input class="cart_quantity_input" type="number" name="quantity" value="{{$product->qty}}" autocomplete="off" size="2">
                                    <input type="hidden" name="rowId" value="{{$product->rowId}}"/>

                                    <input type="submit" value="Cập nhật">
                                </form>
                               
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                @php
                                    $subtotal = $product->qty*$product->price;
                                    echo number_format($subtotal). " "."vnd";
                                @endphp
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{route('cart.remove',['id' => $product->rowId])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
 
                </tbody>
            </table>
        </div>

     
        <div class="payment-options">
                <form action="{{route('checkout.order_place')}}" method="POST">
                    @csrf
                    <span>
                         <label><input type="radio" name="payment_option" value="1"> Thanh toán khi nhận hàng</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_option" value="2">Than toán tài khoản ngân hàng</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_option" value="3">Thanh toán bằng thể VNPAY</label>
                    </span>
                    <input type="submit" value="Đặt hàng" name="order" class="btn btn-default check_out">
                </form>

               
            </div>
    </div>
</section> <!--/#cart_items-->
@endsection