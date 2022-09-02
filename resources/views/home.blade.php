@extends('layouts.admin')
@section('content')
    <style>
        .frame {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 500px;
        }

        .notification {
            padding: 20px;
            border: 1px solid rgb(0, 255, 115);
            border-radius: 10px;
            background: rgb(29, 224, 7)
        }

        .alert-order {
            width: 200px;
            height: 30px;
            padding: 20px;
            border-radius: 12px;
            color: #fff;
            background: rgba(18, 186, 18, 0.667)
        }

        .hidden {
            display: none !important;
            opacity: 0;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" style="height:60px">
                        Dashboard
                        <div class="d-flex justify-content-center align-items-center">
                            <div id="alert" class="hidden alert-order d-flex justify-content-between align-items-center">
                                {{-- Message Gose Here --}}
                                <h6 class="p-0 m-0">New Order</h6>
                                <i class="fas fa-bell"></i>
                            </div>
                            {{-- <button onclick="startFCM()" class="btn btn-danger btn-flat">Allow notification
                            </button> --}}
                            <button class=" bell-btn btn btn-outline-primary ml-3 position-relative">
                                <i class="fas fa-bell"></i>
                                <span
                                    class="position-absolute top-0 text-white start-100 translate-middle badge rounded-pill bg-danger">
                                    0
                                </span>
                            </button>
                        </div>
                    </div>



                    <div class="card-body">

                        <script src="{{ asset('js/app.js') }}"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
