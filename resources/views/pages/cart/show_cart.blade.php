@extends('main')

@section('meta')
    <meta name="description" content="Trang cart thoa suc cart">
    <meta name="keywords" content="TT, TT">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('content')
<section id="cart_items">
    @php
        $content = Cart::content();
    @endphp
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('home.')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
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
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        {{--  <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>  --}}
        <div class="row">
            {{--  <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>  --}}
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền <span>{{Cart::total(0,',','.')." ". "vnd"}}</span></li>
                        <li>Thếu  <span>{{Cart::tax(0,',','.')." ". "vnd"}}</span></li>
                        <li>Phí vận chuyển <span>0 </span></li>
                        <li>Thành tiền  
                            <span>
                                {{Cart::total(0,',','.')." ". "vnd"}}
                            </span>
                    </li>
                    </ul>
                       
                        <a class="btn btn-default check_out" href="{{route('checkout.login_checkout')}}">Thanh toán </a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection