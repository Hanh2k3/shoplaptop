@extends('main')
@section('meta')
    <meta name="description" content="Brand">
    <meta name="keywords" content="TT,sd, TT">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detail product</title>
@endsection

@section("content")
    <div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{asset("uploads/product/$product->image")}}"alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            
            <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                    <a href=""><img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                    </div>
                    <div class="item">
                    <a href=""><img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                    </div>
                    <div class="item">
                    <a href=""><img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                    </div>
                    
                </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$product->name}}</h2>
            <p>Mã sản phẩm : {{$product->id}}</p>
            <img src="" alt="" />
            <span>
                <form action="{{route('cart.save')}}" method="POST">
                    @csrf
                    <span>{{number_format($product->price)." "."VND"}}</span>
                    <label>Số lượng: </label>
                    <input type="number" value="1" min="1" name="quantity" />
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </form>
            </span>
            <p><b>Tình trạng: </b>còn hàng</p>
            <p><b>Loại sản phẩm: </b> New</p>
            <p><b>Thương hiệu: </b>{{$product->brand_name}}</p>
            <p><b>Danh mục: </b>{{$product->category_name}}</p>
            <a href=""><img src="" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
    </div><!--/product-details-->

    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
                <li><a href="#companyprofile" data-toggle="tab">Hồ sơ công ty</a></li>
  
                <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="details" >
                <p>
                    {{$product->content}}
                </p>
                


            </div>
            
         
            <div class="tab-pane fade" id="tag" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                                
            </div>
            
            <div class="tab-pane fade active in" id="reviews" >
                <div class="col-sm-12">
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p><b>Write Your Review</b></p>
                    
                    <form action="#">
                        <span>
                            <input type="text" placeholder="Your Name"/>
                            <input type="email" placeholder="Email Address"/>
                        </span>
                        <textarea name="" ></textarea>
                        <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                        <button type="button" class="btn btn-default pull-right">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div><!--/category-tab-->


    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản phẩm gợi ý</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($product_category as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{route('product_detai', ['id' => $product->id])}}">
                                         <img src="{{asset("uploads/product/$product->image")}}" alt="" />
                                        <h2>{{number_format($product->price)." "."VND"}}</h2>
                                        <p>{{$product->name}}</p>
                                    </a>
                                   
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach	
                    
                </div>
                <div class="item ">	
                    
                   @foreach ($product_brand as $product )

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{route('product_detai', ['id' => $product->id])}}">
                                        <img src="{{asset("uploads/product/$product->image")}}" alt="" />
                                       <h2>{{number_format($product->price)." "."VND"}}</h2>
                                       <p>{{$product->name}}</p>
                                   </a>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                    
                    
                    
                </div>
               
                    
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>			
        </div>
    </div><!--/recommended_items-->
@endsection