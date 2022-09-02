@extends('master')
@section('content')
    <style>
        .image {
            max-width: 75% !important;
            max-height: 100% !important;
            padding: 5px 0;
        }

        .image-container {
            height: 200px;
            width: 200px;
        }
    </style>
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Home</button>
        </li>
        @foreach ($categories as $category)
            <li class="nav-item" role="presentation">
                <button onclick="location='{{route('productByCategory',$category->id)}}'" class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">{{$category->name}}</button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">

                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 d-flex justify-content-center">

                        <div class="card mt-4" style="width: 100%;">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="image-container">

                                    <img id="{{ $product->id }}img" src="{{ $product->photo['url'] }}"
                                        class="card-img-top image" alt="...">
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title {{ $product->id . 'name' }}">{{ $product->name }}</h5>
                                    <h6 class="title {{ $product->id . 'price' }}">{{ $product->price }} $ </h6>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button class="btn btn-primary  addtocartbtn mt-2" id="{{ $product->id }}">Add To
                                    Cart</button>

                            @if(auth()->user())
                            <button class="btn btn-primary  addwishlist mt-2" id="{{ $product->id }}">Save for
                                later</button>
                             @else
                             <button class="btn btn-primary  mt-2" onclick="location='{{url('/login')}}'">Save for
                                later</button>

                            @endif


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('.addtocartbtn').click(function(e) {
                e.preventDefault();
                let id = this.id;
                let name = $(`.${id}name`).text();
                let price = $(`.${id}price`).text();
                let url = '{{ route('cart.add') }}';
                let photo = document.getElementById(`${id}img`).src;
                const data = {
                    id,
                    name,
                    qty: 3,
                    url: photo,
                    price: price.slice(0, -2),
                }
                $.ajax({
                    type: "POST",
                    data: data,
                    url: url,
                    success: function(res) {

                    }
                }).done(function() {
                    location.reload()
                    Swal.fire(
                        'Success!',
                        'Successfully added',
                        'success'
                    )
                })
            })

            $('.addwishlist').click(function(e) {
                e.preventDefault();
                let id = this.id;
                let name = $(`.${id}name`).text();
                let price = $(`.${id}price`).text();
                let photo = document.getElementById(`${id}img`).src;
                let url = '{{ route('wishlist.add') }}';
                const data = {
                    id,
                    name,
                    price: price.slice(0, -2),
                    url: photo
                }
                $.ajax({
                    type: "POST",
                    data: data,
                    url: url,
                    success: function(res) {}
                }).done(function(resp) {
                    if (resp.message) {
                        Swal.fire(
                            'Warning!',
                            `${resp.message}`,
                            'warning'
                        )
                    } else {
                        Swal.fire(
                            'Success!',
                            'Successfully Added',
                            'success')
                    }
                    location.reload()
                })
            })

        })
    </script>
@endsection
