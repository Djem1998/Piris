<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family_position extends Model
{
    protected $table = 'family_positions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    public function user_information()
    {
        $this->hasOne('App\UserInformation', 'family_positions_id', 'id');
    }
}
