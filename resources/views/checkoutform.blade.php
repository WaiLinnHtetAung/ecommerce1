@extends('master')
@section('content')
    <form class="needs-validation mt-5" method="post" action="{{ route('orderadd') }}">
        <div class="row">
            <div class="col-md-7">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input style="height:50px;" type="text" class="form-control" name="firstName" id="name"
                                aria-describedby="nameHelp" placeholder="Enter Your Name" required />

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="name" class="form-label">Last Name</label>
                            <input style="height:50px;" type="text" class="form-control" name="lastName" id="name"
                                aria-describedby="nameHelp" placeholder="Enter Your Name" required />

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Member
                        Card</label>
                    <input style="height:50px;" type="text" name="memberCard" class="form-control" id="memberHelp"
                        aria-describedby="memberHelp" placeholder="Enter your member card"  />

                </div>
                <div class="mb-3">
                    <label for="address" class="form-label mb-2">Birthday</label>
                    <input style="height:50px;" type="date" name="birthday" class="form-control" placeholder="Enter Your Birthday"
                        id="birthday" aria-describedby="birthday" >
                </div>
                <div class="mb-3">
                    <label for="">Choose Your Gender</label>
                    <select name="gender" id="" class="form-select" style="height:45px;">
                        <option value="">Your Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input style="height:50px;" name="company" type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                        placeholder="Enter Your Company"  />

                </div>
                <div class="row">
                    <label for="address" class="form-label">Street Address</label>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input style="height:50px;" type="text" class="form-control" name="street" id="street"
                                aria-describedby="streetHelp" placeholder="Enter Your Street Name" required />

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input style="height:50px;" type="text" class="form-control" name="city" id="name"
                                aria-describedby="nameHelp" placeholder="Enter Your City Name" required />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Town City</label>
                    <input style="height:50px;" name="town" type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                        placeholder="Enter Your Town City" required />

                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Email Address</label>
                    <input style="height:50px;" name="email" type="email" class="form-control" id="email"
                        aria-describedby="emailHelp" placeholder="Enter Your Email" required />

                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input style="height:50px;" name="phone" type="text" class="form-control" id="phone"
                        aria-describedby="phoneHelp" placeholder="Enter Your Phone Number" required />

                </div>
                {{-- <div class="mb-3">
                <label for="payment" class="form-label">Choose Payment</label>
                <select class="form-select" name="payment" id="payment"
                    aria-label="Default select example" required>
                    <option selected value="cod">Cash on delivery</option>
                    <option value="paypal">Paypal</option>
                    <option value="kbz">Kbz</option>
                </select>
            </div> --}}

                {{-- <div class="row" style="padding:12px">
                    <button type="submit" class="btn btn-success">Order Now</button>
                </div> --}}
            </div>
            <div class="col-md-5">
                <div class=" card  w-100  p-4 table-responsive">

                    <h5>Your Orders</h5>
                    <hr />
                    {{-- <div class="d-flex justify-content-between py-2">
                        <h5>Item Total</h5>
                        @if (Cart::instance('shoppingcart')->count() > 0)
                            <h5>{{ Cart::instance('shoppingcart')->count() }} items</h5>
                        @else
                            <h5>0 items</h5>
                        @endif
                    </div> --}}
                    <table class="table table-stripe">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th style="text-align:end">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::instance('shoppingcart')->content() as $item)
                                <tr>
                                    <td>{{ $item->name }} x {{ $item->qty }}</td>
                                    <td style="text-align:end">{{ $item->price }} $
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tax</th>
                                <td style="text-align:end">
                                    {{ Cart::instance('shoppingcart')->tax() }} $
                                </td>
                            </tr>
                            <tr>
                                <th>Sub Total</th>
                                <td style="text-align:end">
                                    {{ Cart::instance('shoppingcart')->total() }} $
                                </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td style="text-align:end">
                                    {{ Cart::instance('shoppingcart')->total() }} $
                                </td>
                            </tr>

                        </tfoot>
                    </table>
                    {{-- <div class="d-flex justify-content-between">
                    <h6>Sub Total</h6>
                    <h6> {{ Cart::instance('shoppingcart')->total() }} $</h5>
                </div>
                <hr />
                <div class="d-flex justify-content-between ">
                    <h6>Total</h6>
                    <h6> {{ Cart::instance('shoppingcart')->total() }} $</h6>
                </div>
                <hr /> --}}
                    {{-- <div class="d-flex justify-content-between ">
                    <h6>Delivery Charges</h6>
                    <h6>Free</h6>
                </div> --}}

                </div>
                <div class="card w-100 p-4 mt-2">

                        {{-- <div class="mb-3">
                            <label for="phone" class="form-label">Card No</label>
                            <input name="card_no" type="text" class="form-control" id="phone"
                                aria-describedby="phoneHelp" placeholder="Enter Your Card No" required />

                        </div> --}}
                        <div class="mb-3">
                            <label for="payment" class="form-label">Choose Payment</label>
                            <select class="form-select" name="payment" id="payment"
                                aria-label="Default select example" required>
                                <option selected value="cod">Cash on delivery</option>
                                <option value="paypal">Paypal</option>
                                <option value="kbz">Kbz</option>
                            </select>
                        </div>
                        <div class="mb-3">
                             <button class="w-100 btn btn-outline-primary">PLACE ORDER</button>
                        </div>

                </div>
            </div>
        </div>
    </form>
@endsection
