@extends('main')
@section('meta')
    <meta name="description" content="Trang chu">
    <meta name="keywords" content="TT,sd, TT">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
@endsection
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

       

        <div class="register-req">
            <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng hoặc xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            
                <div class="row">
                    
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Điền thông tin gửi hàng</p>
                            <div class="form-one">
                                <form action="{{route('checkout.save_checkout')}}" method="POST">
                                    @csrf

                                    
                                    <input name="email" type="text" placeholder="Email*">
                                    @error('email')
                                        <p style="color:red; ">{{$message}}</p>
                                    @enderror
                                    <input name="name" type="text" placeholder="Họ và tên">
                                    @error('name')
                                        <p style="color:red; ">{{$message}}</p>
                                    @enderror
                                
                                    <input name="address" type="text" placeholder="Địa chỉ">
                                    @error('address')
                                        <p style="color:red; ">{{$message}}</p>
                                    @enderror
                                    <input name="phone" type="text" placeholder="Số điện thoại">
                                    @error('phone')
                                        <p style="color:red; ">{{$message}}</p>
                                    @enderror
                                    <textarea name="notes"  placeholder="Ghi chú đơn hàng của bạn..." rows="16"></textarea>
                                    <button type="submit" class="btn btn-fefault cart " >
                                        Gửi
                                    </button>
                                </form>

                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Ghi chú gửi hàng</p>
                           
                            
                        </div>	
                    </div>					
                </div>
           
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

     
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->
@endsection