<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_informations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name', 'last_name', 'father_name', 'birthday', 'sex', 'passport_series', 'passport_id', 'issued_by', 'issue_date',
        'identification_number', 'birthplace', 'residence_cities_id', 'address', 'home_phone', 'mobile_phone', 'email', 'job',
        'position', 'registration_cities_id', 'family_positions_id', 'citizenships_id', 'disabilities_id', 'pensioner', 'monthly_income'
    ];

    public function residence_city()
    {
        $this->belongsTo('App\Residence_city');
    }

    public function registration_city()
    {
        $this->belongsTo('App\Registration_city');
    }

    public function family_position()
    {
        $this->belongsTo('App\Family_position');
    }

    public function citizenship()
    {
        $this->belongsTo('App\Citizenship');
    }

    public function disability()
    {
        $this->belongsTo('App\Disability');
    }
}
