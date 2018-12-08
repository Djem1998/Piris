<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentAccount extends Model
{
    protected $table = 'current_accounts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_number', 'credit', 'debit', 'balance',
    ];
}
