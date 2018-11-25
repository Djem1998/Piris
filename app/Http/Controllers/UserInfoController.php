<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInformation;

class UserInfoController extends Controller
{
    public function add(Request $request)
    {
        var_dump($request->all());
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
            $message = 'Something went wrong.Error with code: '.$exception->getCode();
        } finally {
            return $message;
        }
    }

    public function checkUserPassport(Request $request){
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
            $message = 'Something went wrong.Error with code: '.$exception->getCode();
        } finally {
            return $message;
        }
    }

    public function checkIdentificationNumber(Request $request){
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
            $message = 'Something went wrong.Error with code: '.$exception->getCode();
        } finally {
            return $message;
        }
    }
}
