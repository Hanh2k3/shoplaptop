@extends('main')

@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        @if (session('er'))
                            <div class="alert alert-danger">
                                {{ session('er') }}
                            </div>
                        @endif
                     

                        
                        <input type="email" name="email_login" placeholder="Nhập địa chỉ email" />
                        @error('email_login')
                            <p style="color: red; ">{{$message}}</p>
                        @enderror
                        <input type="password" name="password_login" placeholder="Nhập mật khẩu" name="password" />
                        @error('password_login')
                            <p style="color: red; ">{{$message}}</p>
                        @enderror
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Nhớ mật khẩu
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký !</h2>
                    <form action="{{route('signup')}}" method="POST">
                        @csrf
                       
                       
                        <input type="text" name="name" placeholder="Tên tài khoản "/>
                        @error('name')
                            <p style="color: red;">{{$message}}</p>
                            
                        @enderror
                        
                        <input type="text" name="email" placeholder="Địa chỉ Email"/>
                        @error('email')
                            <p style="color: red;">{{$message}}</p>
                        @enderror

                        <input type="text" name="phone" placeholder="Số điện thoại "/>
                        @error('phone')
                            <p style="color: red;">{{$message}}</p>
                        @enderror

                        <input type="password" name="password" placeholder="Mật khẩu"/>
                        @error('password')
                            <p style="color: red;">{{$message}}</p>
                        @enderror
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection