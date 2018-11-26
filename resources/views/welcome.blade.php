@extends('layouts.app')

@section('content')
    <div class="container">
        <span class="title">Welcome to {{ config('app.name', 'Laravel') }}</span>
        <div class="text-center">We are glad to see you on our website</div>
{{--        @if(isset($message))
            <div>{{ $message }}</div>
            @if($message != 'Something went wrong.')
                <script>
                    swal('Success', 'Everything went well.', 'success')
                </script>
            @else
                <script>
                    swal('Error', 'Something went wrong.', 'error')
                </script>
            @endif
        @endif--}}
    </div>
@endsection
