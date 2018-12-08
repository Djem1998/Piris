<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Citizenship;
use App\Disability;
use App\Family_position;
use App\Registration_city;
use App\Residence_city;
use App\UserInformation;

class EditingController extends Controller
{
    public function index()
    {
        $users = UserInformation::all();
        $result = array();
        $i = 0;
        foreach ($users as $user) {
            $result[$i] = array('id' => $user->id, 'first_name' => $user->first_name, 'last_name' => $user->last_name, 'father_name' => $user->father_name);
            $i++;
        }
        return view('editing')->with([
            'users' => $result,
        ]);
    }

    public function getCitizenshipTable()
    {
        $result = array();
        $i = 0;
        $citizenships = Citizenship::all();
        foreach ($citizenships as $citizenship) {
            $result[$i] = array('id' => $citizenship->id, 'name' => $citizenship->name);
            $i++;
        }
        return $result;
    }

    public function getDisabilityTable()
    {
        $result = array();
        $i = 0;
        $disabilities = Disability::all();
        foreach ($disabilities as $disability) {
            $result[$i] = array('id' => $disability->id, 'name' => $disability->name);
            $i++;
        }
        return $result;
    }

    public function getFamilyPositionTable()
    {
        $result = array();
        $i = 0;
        $family_positions = Family_position::all();
        foreach ($family_positions as $family_position) {
            $result[$i] = array('id' => $family_position->id, 'name' => $family_position->name);
            $i++;
        }
        return $result;
    }

    public function getResidenceCityTable()
    {
        $result = array();
        $i = 0;
        $residence_cities = Residence_city::all();
        foreach ($residence_cities as $residence_city) {
            $result[$i] = array('id' => $residence_city->id, 'name' => $residence_city->name);
            $i++;
        }
        return $result;
    }

    public function getRegistrationCityTable()
    {
        $result = array();
        $i = 0;
        $registration_cities = Registration_city::all();
        foreach ($registration_cities as $registration_city) {
            $result[$i] = array('id' => $registration_city->id, 'name' => $registration_city->name);
            $i++;
        }
        return $result;
    }
}
