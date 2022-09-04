@extends('layouts.common.cartnwish')
@section('content')
    <style>

    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8 col-12">
                @if (Cart::instance('shoppingcart')->count() > 0)
                    <div class="d-flex mt-3 justify-content-between align-items-center" style="margin-right:12px">
                        <h3 class="pb-1">My CartList ( {{ Cart::instance('shoppingcart')->count() }} )</h3>
                        <button onclick="location='{{route('products#list')}}'" class="btn btn-info text-white">Continue
                            Shopping</button>
                    </div>
                @endif

                {{-- ------------clear cart message--------- --}}
                @if (session('clearCart'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('clearCart')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                @if (Cart::instance('shoppingcart')->count() > 0)
                    @foreach (Cart::instance('shoppingcart')->content() as $item)
                        <div class="row border p-4 w-100 mt-3 ">
                            <div class="col-4">
                                {{-- {{dd($item->toArray())}} --}}
                                <img src="{{asset('storage/'.$item->options['id'].'/'.$item->options['img'])}}" style="width:auto;height:100px" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="col-4 d-flex flex-column justify-content-center">
                                <h5>{{ $item->name }}</h5>
                                <h5>{{ $item->price }} $</h5>
                                <div class="btn-group pt-1" role="group" aria-label="Basic example">
                                    <button type="button" onclick="location='{{route('item#decrease', $item->rowId)}}'" class="btn btn-outline-primary remove"><i class="fa-solid fa-minus"></i></button>

                                    <button type="button" class="btn btn-outline-primary num">{{ $item->qty }}</button>
                                    <button type="button" onclick="location='{{route('item#increase', $item->rowId)}}'" class="btn btn-outline-primary add"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-4 d-flex position-relative">
                                <div class="position-absolute end-0 top-0">
                                    <button class="btn btn-danger removebtn" onclick="location='{{route('remove#item', $item->rowId)}}'">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end p-2">
                        <a href="{{ route('cart#clear') }}" type="submit" class="btn btn-danger btn-sm mt-3"
                            id="rmall">Remove All</a>
                    </div>
                @else
                    <div class="d-flex flex-column border rounded p-3 mt-3 justify-content-center align-items-center w-100">
                        <h3>There is no products in cart!</h3>
                        <button onclick="location='{{ route('products#list') }}'" class="btn btn-info text-white">Continue
                            Shopping</button>
                    </div>
                @endif
            </div>
            <div class="col-md-12 col-lg-4 col-12 pb-2">
                <div class="border rounded mt-3 p-4">
                    <h4>Price Details</h4>
                    {{-- <div class="d-flex justify-content-between py-2">
                        <h5>Item Total</h5>
                        @if (Cart::instance('shoppingcart')->count() > 0)
                            <h5>{{ Cart::instance('shoppingcart')->count() }} items</h5>
                        @else
                            <h5>0 items</h5>
                        @endif
                    </div> --}}
                    <div class="d-flex justify-content-between py-2">
                        <h5>Sub Total</h5>
                        <h5> {{ Cart::instance('shoppingcart')->total() }} $</h5>
                    </div>

                    <div class="d-flex justify-content-between py-2">
                        <h5>Total</h5>
                        <h5> {{ Cart::instance('shoppingcart')->total() }} $</h5>
                    </div>

                    <div class="d-flex justify-content-between py-2">
                        <h5>Delivery Charges</h5>
                        <h5>Free</h5>
                    </div>
                </div>
                <div class="border rounded mt-2 p-4">
                    {{-- <form class="needs-validation" method="post" action="{{ route('orderadd') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="user_name" id="name"
                                aria-describedby="nameHelp" placeholder="Enter Your Name" required />

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Your Email" required />

                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adddress</label>
                            <textarea name="address" class="form-control" placeholder="Enter Your Address" id="address"
                                aria-describedby="addressHelp" required></textarea>

                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input name="phone" type="text" class="form-control" id="phone"
                                aria-describedby="phoneHelp" placeholder="Enter Your Phone Number" required />

                        </div>
                        <div class="mb-3">
                            <label for="payment" class="form-label">Choose Payment</label>
                            <select class="form-select" name="payment" id="payment" aria-label="Default select example"
                                required>
                                <option selected value="cod">Cash on delivery</option>
                                <option value="paypal">Paypal</option>
                                <option value="kbz">Kbz</option>
                            </select>
                        </div>

                        <div class="row" style="padding:12px">
                            <button type="submit" class="btn btn-success">Order Now</button>
                        </div>
                    </form> --}}
                    <button onclick="location='{{route('checkoutform')}}'" class="w-100 btn btn-primary" >CHECK OUT</button>
                </div>
            </div>
        </div>
    </div>

@endsection
