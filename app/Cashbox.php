<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    protected $table = 'cashboxes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_number', 'credit', 'debit', 'balance',
    ];
}
