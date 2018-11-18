<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    protected $table = 'citizenships';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    public function user_information()
    {
        $this->hasOne('App\UserInformation', 'citizenships_id', 'id');
    }
}
