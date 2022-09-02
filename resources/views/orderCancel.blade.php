@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-4">
        <h4 class="py-1">Cancel Orders</h4>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <form class="d-flex w-25" method="POST" action="{{ route('admin.order.search') }}">
                            @csrf
                            <input name="searchName" class="form-control me-2" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="ml-2 btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <div class="container-fluid">
                        </div>
                        <table class="table table-bordered align-middle overflow-auto mt-2">
                            <thead>
                                <tr style="width:100px;height:100px">
                                    <th scope="col">ID</th>
                                    <th style="width:200px;height:100px" scope="col">User Name</th>
                                    <th style="width:200px;height:100px" scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Payment</th>
                                    <th style="width:200px;height:100px" scope="col">Products</th>
                                    <th scope="col">Total Qty</th>
                                    <th style="width:200px;height:100px" scope="col">Total Tax</th>
                                    <th style="width:200px;height:100px" scope="col">Total Price</th>
                                    <th style="width:200px;height:100px" scope="col">Order Date</th>
                                    <th style="width:100px;height:100px"></th>
                                </tr>
                                <tr>
                                    <td>
                                        <form method="post" action="{{ route('admin.by.id') }}">
                                            @csrf

                                            @if (Session::get('id') == 'asc')
                                                <select onchange="this.form.submit()" id="id" name="name"
                                                    class="form-select" aria-label="Default select example">
                                                    <option value="desc">Desc</option>
                                                    <option selected value="asc">Asc</option>
                                                </select>
                                            @else
                                                <select onchange="this.form.submit()" id="id" name="name"
                                                    class="form-select" aria-label="Default select example">
                                                    <option selected value="desc">Desc</option>
                                                    <option value="asc">Asc</option>
                                                </select>
                                            @endif

                                        </form>
                                    </td>
                                    <td colspan="11">
                                        @if ($orders->isEmpty())
                                            <h5>There is no data in order list!</h5>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <form>
                                            <select name="name" class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td></td> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @if ($order->deleted == 'true')
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
                                            <td>{{ $order->tax }} $</td>
                                            <td>{{ $order->price }} $</td>
                                            <td>{{ date('d-m-y', strtotime($order->created_at)) }}</td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <button onclick="location='{{ route('admin.order.delete', ['id' => $order->id]) }}'" class="btn btn-danger" >Delete</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let id = document.getElementById('id');
        if (window.location.pathname == '/products/order/by/id') {
            console.log(id.getAttribute('selected'));
        }
    </script>
@endsection
