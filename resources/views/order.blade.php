@extends('master')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 table-responsive">
                        {{-- @if (!$orders->isEmpty()) --}}
                      
                        <table class="table table-bordered align-middle overflow-auto">
                            <thead>
                                <tr>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Total Qty</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Total Tax</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col" style="width:100px;"></th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                    @if ($order->deleted != 'true')
                                        <tr>
                                            <th scope="row">{{ $order->id }}</th>
                                            <td>{{ $order->user_name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                @foreach (json_decode($order->records, true) as $key => $value)
                                                    {{ $value['name'] }},
                                                @endforeach
                                            </td>
                                            <td>{{ $order->qty }}</td>
                                            <td>{{ $order->price }} $</td>
                                            <td>{{ $order->tax }} $</td>
                                            <td>{{ date('d-m-y', strtotime($order->created_at)) }}</td>
                                            <td style="width:150px">
                                                @if ($order->status == 'pending')
                                                    <button class="btn btn-sm btn-warning">{{ $order->status }}</button>
                                                @else
                                                    <button class="btn btn-sm btn-success">{{ $order->status }}</button>
                                                @endif

                                                @if ($order->status == 'pending')
                                                    <button
                                                        onclick="location='{{ route('order.softDelete', ['id' => $order->id]) }}'"
                                                        class="btn btn-sm btn-danger">Cancel</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        {{-- @else
                        <div class="d-flex flex-column border rounded p-3 mt-3 justify-content-center align-items-center w-100">
                          <h3>There is no order in list!</h3>
                          <button onclick="location='{{ route('cart') }}'" class="btn btn-info text-white">Continue
                              Shopping</button>
                      </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
