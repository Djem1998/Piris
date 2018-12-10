@extends('layouts.app')

@section('content')
    <div class="container">
        <span class="title">Welcome to the {{ config('app.name', 'Laravel') }}</span>
        <div class="text-center">We are glad to see you on our website</div>
        @csrf
        @if(!empty($users))
            <div class="text-center delete-select">Users</div>
            <select name="delete_user" id="delete_user" class="form-control">
                @foreach($users as $item)
                    <option
                        value="{{ $item['id'] }}">{{ $item['last_name'] }} {{ $item['first_name'] }}  {{ $item['father_name'] }}</option>
                @endforeach
            </select>
            <div class="closing-div"><a href="#" class="menu-button closing">Bank day closing</a></div>
        @else
            <div class="empty text-center">Have`n got users into database.</div>
        @endif
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
