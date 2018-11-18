<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration_city extends Model
{
    protected $table = 'registration_cities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    public function user_information()
    {
        $this->hasOne('App\UserInformation', 'registration_cities_id', 'id');
    }
}
