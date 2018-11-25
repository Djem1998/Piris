@extends('layouts.app')

@section('content')
    <div class="container">
        <span class="title">Welcome to {{ config('app.name', 'Laravel') }}</span>
        <div class="text-center">We are glad to see you on our website</div>
    </div>
@endsection
