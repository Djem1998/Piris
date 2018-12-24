@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="title-bank text-center">Piris Bank</h1>
        <form method="post" action="{{ route('addCredit') }}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="select">
                <select name="select_user" id="select_user" class="form-control">
                    <option>Select user</option>
                    @foreach($users as $item)
                        <option value="{{ $item['id'] }}">
                            {{ $item['last_name'] }} {{ $item['first_name'] }}  {{ $item['father_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="selected">
                <div class="string">
                    <div class="form-group col-md-6">
                        <label for="deposit_type"
                               class="col-md-12 col-form-label text-md-center">{{ __('Credit type') }}</label>
                        <select name="deposit_type" id="deposit_type" class="form-control">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="currency"
                               class="col-md-12 col-form-label text-md-center">{{ __('Currency') }}</label>
                        <select name="currency" id="currency" class="form-control">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="dynamic">
                    <div class="form-group col-md-6">
                        <label for="duration"
                               class="col-md-12 col-form-label text-md-center">{{ __('Duration') }}</label>
                        <select name="duration" id="duration" class="form-control">
                        </select>
                    </div>
                    <div class="form-group col-md-6 percent">
                        <label for="percent"
                               class="col-md-12 col-form-label text-md-center">{{ __('Percent') }}</label>
                        <input name="percent" id="percent" class="form-control" type="text" disabled>
                    </div>
                </div>
                <div class="string">
                    <div class="form-group col-md-6">
                        <label for="amount"
                               class="col-md-12 col-form-label text-md-center">{{ __('Amount') }}</label>
                        <input name="amount" id="amount" class="form-control" type="text" pattern="\d+.\d{2}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_start"
                               class="col-md-12 col-form-label text-md-center">{{ __('Date Start') }}</label>
                        <input name="date_start" id="date_start" class="form-control" type="date">
                    </div>
                </div>
                <div class="contract_number">
                    <div class="form-group col-md-6">
                        <label for="current_accounts"
                               class="col-md-12 col-form-label text-md-center">{{ __('Current Accounts') }}</label>
                        <input name="current_accounts" id="current_accounts" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_start"
                               class="col-md-12 col-form-label text-md-center">{{ __('Interest Accounts') }}</label>
                        <input name="interest_accounts" id="interest_accounts" class="form-control" type="text">
                    </div>
                    <input type="hidden" id="interest_account" name="interest_account">
                    <input type="hidden" id="current_account" name="current_account">
                </div>
                <button class="button form-control btn-success" type="submit" disabled>Add credit</button>
            </div>
        </form>
    </div>
@endsection
