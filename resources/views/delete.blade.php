@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('delete') }}">
            @csrf
            @if(!empty($users))
                <div class="text-center delete-select">Select user to delete</div>
                <select name="delete_user" id="delete_user" class="form-control">
                    @foreach($users as $item)
                        <option
                            value="{{ $item['id'] }}">{{ $item['last_name'] }} {{ $item['first_name'] }}  {{ $item['father_name'] }}</option>
                    @endforeach
                </select>
                <button class="button form-control" type="submit">Delete User</button>
            @else
                <div class="empty text-center">Have`n got users into database.</div>
            @endif
        </form>
    </div>
@endsection
