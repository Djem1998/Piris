@extends('layouts.app')

@section('content')
    <div class="container terminal-block">
        <h1 class="title-bank text-center">Piris Bank</h1>
        <div class="terminal">
            @csrf
            <div class="true">
                <div class="form-group col-md-6">
                    <label for="card_number"
                           class="col-md-12 col-form-label text-md-center">{{ __('Card Number') }}</label>
                    <input name="card_number" id="card_number" class="form-control" type="text">
                </div>
                <div class="form-group col-md-6">
                    <label for="pin_code"
                           class="col-md-12 col-form-label text-md-center">{{ __('Pin-code') }}</label>
                    <input name="pin_code" id="pin_code" class="form-control" type="password">
                </div>
                <div class="form-group col-md-6">
                    <button class="form-control btn-success" id="enter_card" disabled>Enter card</button>
                </div>
            </div>
            <div class="operations">
                <div class="form-group col-md-6">
                    <label for="operation_type"
                           class="col-md-12 col-form-label text-md-center">{{ __('Select operation type:') }}</label>
                    <select id="operation_type" name="operation_type" class="form-control">
                        <option value="getMoneyFromCredit" class="credit-option">Get money from credit</option>
                        <option value="interestPayment" class="credit-option">Interest payment</option>
                        <option value="endCredit" class="credit-option">End credit</option>
                        <option value="getPercentFromInterestAccount" class="deposit-option">Get percent from account
                        </option>
                        <option value="endDeposit" class="deposit-option">End deposit</option>
                        <option value="getAccountBalance">Account balance</option>
                        <option value="cancel">Cancel</option>
                    </select>
                </div>
                <div class="form-group col-md-6 sum">
                    <label for="sum"
                           class="col-md-12 col-form-label text-md-center">{{ __('Enter sum') }}</label>
                    <input id="sum" name="sum" class="form-control" type="text">
                </div>
                <div class="form-group col-md-6">
                    <button class="form-control btn-success" id="enter">Enter</button>
                </div>
            </div>
        </div>
    </div>
@endsection
