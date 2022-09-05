@extends('layouts.common.index')

@section('content')
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($categories as $category)
                    <div class="col-lg-9">
                        <div class="categories__item set-bg w-100" data-setbg="#">
                            <img src="{{$category->photo->url}}" class="w-100 h-100" style="object-fit: cover;" alt="">
                            <h5 class="mt-2"><a href="#">{{$category->name}}</a></h5>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="shop">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                {{-- <div class="featured__controls">
                    <ul id='categoryFilter'>
                        <li onclick="location='{{route('products#list')}}'" class="active" data-filter="*">All</li>
                        @foreach ($categories as $category)
                            <li id="{{$category->id}}"  data-filter=".{{$category->name}}" onclick="location='{{route('category#filter', $category->id)}}'" >{{$category->name}}</li>
                        @endforeach

                    </ul>
                </div> --}}

                {{-- ========add cart success========== --}}
                @if(session('addCartSuccess'))
                    <div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('addCartSuccess')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- ============add wishlist success=========== --}}
                @if(session('wishAdd'))
                    <div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('wishAdd')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- =================order success=============  --}}
                @if(session('orderSuccess'))
                    <div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('orderSuccess')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row featured__filter">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" style="object-fit: cover !important;" data-setbg="{{ $product->photo->url }}">
                            <img class="featured__item__pic set-bg" style="object-fit: cover !important;" src="{{ $product->photo->url }}" alt="">
                            <ul class="featured__item__pic__hover">
                                <li><a href="{{route('product#wishList', [$product->id, $product->name, $product->price, $product->photo['id'], $product->photo['file_name']])}}" ><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="{{route('product#store', [$product->id, $product->name, $product->price,$product->photo['id'], $product->photo['file_name']])}}"  id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{$product->name}}</a></h6>
                            <h5>{{$product->price}} mmk</h5>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('asonemart/images/featured/feature-2.jpg')}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('asonemart/images/featured/feature-3.jpg')}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood oranges">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('asonemart/images/featured/feature-4.jpg')}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('asonemart/images/featured/feature-5.jpg')}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('asonemart/images/featured/feature-6.jpg')}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('asonemart/images/featured/feature-7.jpg')}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood vegetables">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('asonemart/images/featured/feature-8.jpg')}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>{{-- .featured --}}
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{asset('asonemart/images/banner/banner-1.jpg')}}" alt="Banner">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{asset('asonemart/images/banner/banner-2.jpg')}}" alt="Banner">
                </div>
            </div>
        </div>
    </div>
</div>
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            {{-- @foreach ($latestProducts as $latestProduct) --}}
                            @for ($i=0; $i < 3; $i++)
                            <a href="#" class="latest-product__item">
                                <div class="latest-product__item__pic" style="width: 120px; object-fit:cover;">
                                    <img  src="{{$latestProducts[$i]->photo->url}}" alt="Latest Product">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$latestProducts[$i]->name}}</h6>
                                    <span>{{$latestProducts[$i]->price}} mmk</span>
                                </div>
                            </a>
                            @endfor
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @for ($i=3; $i<6; $i++)
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic" style="width: 120px;object-fit:cover;">
                                        <img src="{{$latestProducts[$i]->photo->url}}" alt="Latest Product">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$latestProducts[$i]->name}}</h6>
                                        <span>{{$latestProducts[$i]->price}} mmk</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @for ($i = 0; $i < 3; $i++)
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic" style="width: 120px;object-fit:cover;">
                                        <img src="{{$topPrice[$i]->photo->url}}" alt="Latest Product">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topPrice[$i]->name}}</h6>
                                        <span>{{$topPrice[$i]->price}} mmk</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @for ($i = 3; $i < 6; $i++)
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic" style="width: 120px;object-fit:cover;">
                                        <img src="{{$topPrice[$i]->photo->url}}" alt="Latest Product">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topPrice[$i]->name}}</h6>
                                        <span>{{$topPrice[$i]->price}} mmk</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @for ($i = 0; $i < 3; $i++)
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic" style="width: 120px;object-fit:cover;">
                                        <img src="{{$random[$i]->photo->url}}" alt="Latest Product">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$random[$i]->name}}</h6>
                                        <span>{{$random[$i]->price}} mmk</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @for ($i = 3; $i < 6; $i++)
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic" style="width: 120px;object-fit:cover;">
                                        <img src="{{$random[$i]->photo->url}}" alt="Latest Product">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$random[$i]->name}}</h6>
                                        <span>{{$random[$i]->price}} mmk</span>
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>{{-- .latest-product --}}
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{asset('asonemart/images/blog/blog-1.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{asset('asonemart/images/blog/blog-2.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{asset('asonemart/images/blog/blog-3.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Visit the clean farm in the US</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
{{-- ===========cart ajax codes=========== --}}

@section('category')

    {{-- <script>
        $(document).ready(function() {
            // $('#categoryFilter li ').click(function() {

            //     $categoryId = this.id;


            // })
            console.log('hello');
            $.ajax({
                    method : 'GET',
                    url : 'http://localhost:8000/ajax/filter',
                    dataType : 'JSON',
                    success : function(res) {
                        console.log(res);
                    }
                });




        });
    </script> --}}
@endsection

