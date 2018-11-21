<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Citizenship;
use App\Disability;
use App\Family_position;
use App\Registration_city;
use App\Residence_city;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citiz = array();
        $disabili = array();
        $family_pos = array();
        $register_sity = array();
        $resid_city = array();
        $citizenships = Citizenship::all();
        $disabilities = Disability::all();
        $family_positions = Family_position::all();
        $registration_cities = Registration_city::all();
        $residence_cities = Residence_city::all();
        $i = 0;
        foreach ($citizenships as $citizenship) {
            $citiz[$i] = array('id' => $citizenship->id, 'name' => $citizenship->name);
            $i++;
        }
        $i = 0;
        foreach ($disabilities as $disability) {
            $disabili[$i] = array('id' => $disability->id, 'name' => $disability->name);
            $i++;
        }
        $i = 0;
        foreach ($family_positions as $family_position) {
            $family_pos[$i] = array('id' => $family_position->id, 'name' => $family_position->name);
            $i++;
        }
        $i = 0;
        foreach ($registration_cities as $registration_city) {
            $register_sity[$i] = array('id' => $registration_city->id, 'name' => $registration_city->name);
            $i++;
        }
        $i = 0;
        foreach ($residence_cities as $residence_city) {
            $resid_city[$i] = array('id' => $residence_city->id, 'name' => $residence_city->name);
            $i++;
        }
        return view('home')->with([
            'citizenships' => $citiz,
            'disabilities' => $disabili,
            'family_positions' =>$family_pos,
            'registration_cities' => $register_sity,
            'residence_cities' => $resid_city,
        ]);
    }
}
