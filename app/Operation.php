<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $table = 'operations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'accounts_charts_id', 'filename', 'operation',
    ];
}
