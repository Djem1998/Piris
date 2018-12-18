<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInformation;
use Illuminate\Support\Facades\Validator;

class UserInfoController extends Controller
{
    public function add(Request $request)
    {
        $message = 'User is add into database.';
        if ($request->home_phone != null && $request->mobile_phone != null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
                'home_phone' => 'phone|size:19',
                'mobile_phone' => 'phone|size:19',
            ])->validate();
        } elseif ($request->home_phone == null && $request->mobile_phone == null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
            ])->validate();
        } elseif ($request->home_phone != null && $request->mobile_phone == null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
                'home_phone' => 'phone|size:19',
            ])->validate();
        } elseif ($request->home_phone == null && $request->mobile_phone != null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
                'mobile_phone' => 'phone|size:19',
            ])->validate();
        }
        try {
            $userInfo = new UserInformation();
            $userInfo->first_name = $request->first_name;
            $userInfo->last_name = $request->last_name;
            $userInfo->father_name = $request->father_name;
            $userInfo->birthday = $request->birthday;
            $userInfo->sex = $request->sex;
            $userInfo->passport_series = $request->passport_series;
            $userInfo->passport_id = $request->passport_id;
            $userInfo->issued_by = $request->issued_by;
            $userInfo->issue_date = $request->issue_date;
            $userInfo->identification_number = $request->identification_number;
            $userInfo->birthplace = $request->birthplace;
            $userInfo->residence_cities_id = $request->residence_city;
            $userInfo->address = $request->address;
            $userInfo->home_phone = $request->home_phone;
            $userInfo->mobile_phone = $request->mobile_phone;
            $userInfo->email = $request->email;
            $userInfo->job = $request->job;
            $userInfo->position = $request->position;
            $userInfo->registration_cities_id = $request->registration_city;
            $userInfo->family_positions_id = $request->family_position;
            $userInfo->citizenships_id = $request->citizenship;
            $userInfo->disabilities_id = $request->disability;
            $userInfo->pensioner = $request->pensioner;
            $userInfo->monthly_income = $request->monthly_income;
            $userInfo->save();
        } catch (\Exception $exception) {
            $message = 'Something went wrong.';
        }
        return redirect()->route('welcome');
    }

    public function checkUserName(Request $request)
    {
        try {
            $result = array();
            $i = 0;
            $bool = false;
            $users = UserInformation::all();
            foreach ($users as $user) {
                $result[$i] = $user->first_name . $user->last_name . $user->father_name;
                if ($result[$i] == $request->input('userName')) {
                    $bool = true;
                }
                $i++;
            }
            if ($bool) {
                $message = 'false';
            } else {
                $message = 'true';
            }
        } catch (\Exception $exception) {
            $message = 'Something went wrong.Error with code: ' . $exception->getCode();
        }
        return $message;
    }

    public function checkUserPassport(Request $request)
    {
        try {
            $result = array();
            $i = 0;
            $bool = false;
            $users = UserInformation::all();
            foreach ($users as $user) {
                $result[$i] = $user->passport_series . $user->passport_id;
                if ($result[$i] == $request->input('userPassport')) {
                    $bool = true;
                }
                $i++;
            }
            if ($bool) {
                $message = 'false';
            } else {
                $message = 'true';
            }
        } catch (\Exception $exception) {
            $message = 'Something went wrong.Error with code: ' . $exception->getCode();
        }
        return $message;
    }

    public function checkIdentificationNumber(Request $request)
    {
        try {
            $result = array();
            $i = 0;
            $bool = false;
            $users = UserInformation::all();
            foreach ($users as $user) {
                $result[$i] = $user->identification_number;
                if ($result[$i] == $request->input('identificationNumber')) {
                    $bool = true;
                }
                $i++;
            }
            if ($bool) {
                $message = 'false';
            } else {
                $message = 'true';
            }
        } catch (\Exception $exception) {
            $message = 'Something went wrong.Error with code: ' . $exception->getCode();
        } finally {
            return $message;
        }
    }

    public function delete(Request $request)
    {
        try {
            $message = 'Delete successful';
            UserInformation::destroy($request->input('delete_user'));
        } catch (\Exception $exception) {
            $message = 'Something went wrong. Error with code: '.$exception->getCode();
        }
        return $message;
    }

    public function getUserInfoByID($id)
    {
        $result = array();
        $i = 0;
        $users = UserInformation::where('id', $id)->get();
        foreach ($users as $user) {
            $result[$i] = array(
                'first_name' => $user->first_name, 'last_name' => $user->last_name, 'father_name' => $user->father_name,
                'birthday' => $user->birthday, 'sex' => $user->sex, 'passport_series' => $user->passport_series,
                'passport_id' => $user->passport_id, 'issued_by' => $user->issued_by, 'issue_date' => $user->issue_date,
                'identification_number' => $user->identification_number, 'birthplace' => $user->birthplace, 'residence_cities_id' => $user->residence_cities_id,
                'address' => $user->address, 'home_phone' => $user->home_phone, 'mobile_phone' => $user->mobile_phone,
                'email' => $user->email, 'job' => $user->job, 'position' => $user->position,
                'registration_cities_id' => $user->registration_cities_id, 'family_positions_id' => $user->family_positions_id, 'citizenships_id' => $user->citizenships_id,
                'disabilities_id' => $user->disabilities_id, 'pensioner' => $user->pensioner, 'monthly_income' => $user->monthly_income);
            $i++;
        }
        return $result;
    }

    public function update(Request $request)
    {
        $message = 'User is add into database.';
        if ($request->home_phone != null && $request->mobile_phone != null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
                'home_phone' => 'phone|size:19',
                'mobile_phone' => 'phone|size:19',
            ])->validate();
        } elseif ($request->home_phone == null && $request->mobile_phone == null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
            ])->validate();
        } elseif ($request->home_phone != null && $request->mobile_phone == null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
                'home_phone' => 'phone|size:19',
            ])->validate();
        } elseif ($request->home_phone == null && $request->mobile_phone != null) {
            Validator::make($request->all(), [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'father_name' => 'required|alpha',
                'birthday' => 'required|before:tomorrow|date',
                'sex' => 'required',
                'passport_series' => 'required|alpha',
                'passport_id' => 'required|size:7',
                'issued_by' => 'required',
                'issue_date' => 'required|before:tomorrow|date',
                'identification_number' => 'required|regex:/^[0-9]{7}+[A-Z]{1}+[0-9]{3}+[A-Z]{2}+[0-9]{1}$/',
                'birthplace' => 'required',
                'address' => 'required',
                'pensioner' => 'required',
                'citizenship' => 'required',
                'residence_city' => 'required',
                'registration_city' => 'required',
                'family_position' => 'required',
                'disability' => 'required',
                'mobile_phone' => 'phone|size:19',
            ])->validate();
        }
        try {
            $userInfo = UserInformation::find($request->select_user);
            $userInfo->first_name = $request->first_name;
            $userInfo->last_name = $request->last_name;
            $userInfo->father_name = $request->father_name;
            $userInfo->birthday = $request->birthday;
            $userInfo->sex = $request->sex;
            $userInfo->passport_series = $request->passport_series;
            $userInfo->passport_id = $request->passport_id;
            $userInfo->issued_by = $request->issued_by;
            $userInfo->issue_date = $request->issue_date;
            $userInfo->identification_number = $request->identification_number;
            $userInfo->birthplace = $request->birthplace;
            $userInfo->residence_cities_id = $request->residence_city;
            $userInfo->address = $request->address;
            $userInfo->home_phone = $request->home_phone;
            $userInfo->mobile_phone = $request->mobile_phone;
            $userInfo->email = $request->email;
            $userInfo->job = $request->job;
            $userInfo->position = $request->position;
            $userInfo->registration_cities_id = $request->registration_city;
            $userInfo->family_positions_id = $request->family_position;
            $userInfo->citizenships_id = $request->citizenship;
            $userInfo->disabilities_id = $request->disability;
            $userInfo->pensioner = $request->pensioner;
            $userInfo->monthly_income = $request->monthly_income;
            $userInfo->save();
        } catch (\Exception $exception) {
            $message = 'Something went wrong.';
        }
        return redirect()->route('welcome');

    }
}
