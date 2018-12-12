<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $primaryKey = 'id';
    protected $fillable = [
      'card_num', 'interest_num', 'pin',
    ];
}
