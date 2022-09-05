@extends('layouts.common.cartnwish')

@section('content')
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
@endsection
