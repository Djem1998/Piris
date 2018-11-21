<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence_city extends Model
{
    protected $table = 'residence_cities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function user_information()
    {
        $this->hasOne('App\UserInformation', 'residence_cities_id', 'id');
    }
}
