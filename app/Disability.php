<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    protected $table = 'disabilities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    public function user_information()
    {
        $this->hasOne('App\UserInformation', 'disabilities_id', 'id');
    }
}
