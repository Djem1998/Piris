<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositType extends Model
{
    protected $table = 'deposit_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'duration', 'currency', 'percent',
    ];
}
