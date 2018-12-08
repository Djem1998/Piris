<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankFund extends Model
{
    protected $table = 'bank_funds';
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_number', 'credit', 'debit', 'balance',
    ];
}
