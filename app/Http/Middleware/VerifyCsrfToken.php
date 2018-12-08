<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "http://127.0.0.1:8000/checkUser",
        "http://127.0.0.1:8000/checkUserPassport",
        "http://127.0.0.1:8000/checkIdentificationNumber",
        "http://127.0.0.1:8000/getUserInfoByID/{id}",
        "http://127.0.0.1:8000/getCitizenship",
        "http://127.0.0.1:8000/getDisability",
        "http://127.0.0.1:8000/getFamilyPosition",
        "http://127.0.0.1:8000/getResidenceCity",
        "http://127.0.0.1:8000/getRegistrationCity",
        "http://127.0.0.1:8000/getDuration/{currency}/{depositName}",
        "http://127.0.0.1:8000/getPercent/{currency}/{depositName}/{duration}",
        "http://127.0.0.1:8000/getCountAccounts/{id}",
    ];
}
