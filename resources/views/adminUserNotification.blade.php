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
    </style>
    @if (auth()->user()->id == 1)
        @forelse($notifications as $notification)
            @if (!$notification->read_at)
                <div class="alert w-100 alert-success d-flex align-items-center justify-content-between" role="alert">
                    <i class="far fa-check-circle" style="font-size:30px;margin-right:30px"></i>
                    <div>
                        {{ $notification->created_at }} User @foreach (json_decode($notification->data, true) as $key => $value)
                            {{ $value }}&nbsp;
                        @endforeach &nbsp;has just registered!
                    </div>
                    <button class="btn btn-outline-success mark-as-read">Mark As Read</button>
                </div>

                @if ($loop->last)
                    <a href="#" id="mark-all" class="btn btn-danger">
                        Mark all as read
                    </a>
                @endif
            @endif
        @empty
            There are no new notifications
        @endforelse
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (auth()->user()->is_admin)
        <script>
            function sendMarkRequest(id = null) {
                return $.ajax("{{ route('markNotification') }}", {
                    method: 'POST',
                    data: {
                        _token,
                        id
                    }
                });
            }
            $(function() {
                $('.mark-as-read').click(function() {
                    let request = sendMarkRequest($(this).data('id'));

                    request.done(() => {
                        $(this).parents('div.alert').remove();
                    });
                });

                $('#mark-all').click(function() {
                    let request = sendMarkRequest();

                    request.done(() => {
                        $('div.alert').remove();
                    })
                });
            });
        </script>
    @endif
@endsection
