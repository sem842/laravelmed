@extends('layouts.patients')

@section('content')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error-message'))
        <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
    @endif

    <div class="container">
        <ul class="list-group">
            @foreach($openedSmenas as $smena)
                <li><a href="/patients/{{ $smena->id }}">{{ $smena->medService->name }}</a></li>
            @endforeach
        </ul>
    </div>

@endsection

@section('watchdog')
    <script>
        setInterval(function() {
            $.ajax({
                url: '/patients/hash',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    hash: '{{ $watchDogHash }}'
                },
                success: function (data) {
                    if (data == 'doRedirect') {
                        window.location.href = "/patients";
                    }
                },
                error: function () {
                    window.location.href = "/patients";
                }
            })
        }, 5000);
    </script>
@endsection
