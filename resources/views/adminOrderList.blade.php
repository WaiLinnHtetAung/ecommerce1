@extends('layouts.common.cartnwish')

@section('content')
    <div class="row">
        <div class="col-lg-9 m-auto">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    {{-- <th scope="col">Email</th> --}}
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th></th>
                    {{-- <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Total Tax</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->first_name}}&nbsp;{{$order->last_name}}</td>
                    {{-- <td>{{$order->email}}</td> --}}
                    <td>{{$order->street}},&nbsp;{{$order->town}},&nbsp;{{$order->city}}</td>
                    <td>{{$order->phone}}</td>
                    {{-- <td>
                        @foreach (json_decode($order->record,true) as $key => $value)
                            {{$value['name']}}&nbsp;({{$value['qty']}}),&nbsp;
                        @endforeach
                    </td>
                    <td>{{$order->total_qty}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>{{$order->total_tax}}</td> --}}

                    <td><a href="{{route('order#detail', $order->id)}}" class="btn btn-sm btn-primary">Order Detail</a></td>

                  </tr>
                  @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
