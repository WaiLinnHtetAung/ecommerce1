@extends('layouts.common.cartnwish')

@section('wishList')
    <div class="container">
        <div class="row pt-3">
            <div class="col-lg-8 offset-lg-2 col-md-12">
            @if(Cart::instance('wishlist')->count() >0)
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="pb-1">My Wishlist ( {{Cart::instance('wishlist')->count()}} )</h3>
                    <button onclick="location='{{ route('products#list') }}'" class="btn btn-info text-white">Continue
                        Shopping</button>
                </div>
            @foreach(Cart::instance('wishlist')->content() as $wish)
                <div class="p-3 border rounded mb-2">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{asset('storage/'.$wish->options['id'].'/'.$wish->options['img'])}}" style="width:auto;height:100px" class="img-fluid" alt="...">
                        </div>
                        <div class="col-4 d-flex flex-column justify-content-center align-items-start">
                            <div>
                            <h5>{{$wish->name}}</h5>
                            <h6>{{$wish->price}} $</h6>
                            </div>
                        </div>
                        <div class="col-4 d-flex position-relative">
                            <div class="position-absolute end-0 top-0">
                                <button class="btn btn-danger removebtn" onclick="location='{{route('wishlist.remove',['id'=>$wish->rowId,'pid'=>$wish->id])}}'">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        <div class="mt-2 d-flex justify-content-end align-items-center">
            <button class="btn btn-danger" onclick="location='{{route('clear#wish')}}'">Remove All</button>
        </div>
        @else
        <div class="p-3 border rounded mb-2 d-flex flex-column justify-content-center align-items-center">
            <h3>There is no products in wishlist!</h3>
            <button onclick="location='{{route('products#list')}}'" class="btn btn-info text-white" >Continue Shopping</button>
        </div>
            @endif
            </div>
        </div>
    </div>
@endsection
