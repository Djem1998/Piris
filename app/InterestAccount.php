<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterestAccount extends Model
{
    protected $table = 'interest_accounts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_number', 'credit', 'debit', 'balance',
    ];
}
