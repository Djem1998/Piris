@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="">
            @csrf
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="first_name"
                           class="col-md-12 col-form-label text-md-center">{{ __('First Name') }}</label>
                    <input name="first_name" id="first_name" class="form-control" type="text" required autofocus
                           max="20">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name" class="col-md-12 col-form-label text-md-center">{{ __('Last Name') }}</label>
                    <input name="last_name" id="last_name" class="form-control" type="text" required max="20">
                </div>
            </div>

            <div class="string">
                <div class="form-group col-md-6">
                    <label for="father_name"
                           class="col-md-12 col-form-label text-md-center">{{ __('Father Name') }}</label>
                    <input name="father_name" id="father_name" class="form-control" type="text" required max="20">
                </div>
                <div class="form-group col-md-6">
                    <label for="birthday" class="col-md-12 col-form-label text-md-center">{{ __('Birthday') }}</label>
                    <input name="birthday" id="birthday" class="form-control" type="date" required min="1950-01-01"
                           max="">
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6 ">
                    <label for="sex" class="col-md-12 col-form-label text-md-center">{{ __('Sex') }}</label>
                    <div class="pick-sex">
                        <div class="radio">
                            <input name="sex" id="sex" type="radio" value="male" checked>
                            <label class="radio-label">Male</label>
                        </div>
                        <div class="radio">
                            <input name="sex" id="sex" type="radio" value="female">
                            <label class="radio-label">Female</label>
                        </div>
                    </div>

                </div>
                <div class="form-group col-md-6">
                    <label for="passport_series"
                           class="col-md-12 col-form-label text-md-center">{{ __('Passport Series') }}</label>
                    <input type="text" name="passport_series" id="passport_series" class="form-control" required
                           max="3" min="2" placeholder="XX">
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="passport_id"
                           class="col-md-12 col-form-label text-md-center">{{ __('Passport Id') }}</label>
                    <input type="text" name="passport_id" id="passport_id" class="form-control" required max="10"
                           min="7" placeholder="0000000">
                </div>
                <div class="form-group col-md-6">
                    <label for="issued_by"
                           class="col-md-12 col-form-label text-md-center">{{ __('Issued By') }}</label>
                    <input type="text" name="issued_by" id="issued_by" class="form-control" required max="40">
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="issue_date"
                           class="col-md-12 col-form-label text-md-center">{{ __('Issue Date') }}</label>
                    <input name="issue_date" id="issue_date" class="form-control" type="date" required min="2000-01-01"
                           max="">
                </div>
                <div class="form-group col-md-6">
                    <label for="identification_number"
                           class="col-md-12 col-form-label text-md-center">{{ __('Identification Number') }}</label>
                    <input name="identification_number" id="identification_number" class="form-control" type="text"
                           required max="30" placeholder="0000000X000XX0">
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="birthplace"
                           class="col-md-12 col-form-label text-md-center">{{ __('Birthplace') }}</label>
                    <input name="birthplace" id="birthplace" class="form-control" type="text" required max="30">
                </div>
                <div class="form-group col-md-6">
                    <label for="address"
                           class="col-md-12 col-form-label text-md-center">{{ __('Address') }}</label>
                    <input name="address" id="address" class="form-control" type="text" required max="40">
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="home_phone"
                           class="col-md-12 col-form-label text-md-center">{{ __('Home Phone') }}</label>
                    <input name="home_phone" id="home_phone" class="form-control" type="tel" max="20"
                           placeholder="+375(___)___-__-__">
                </div>
                <div class="form-group col-md-6">
                    <label for="mobile_phone"
                           class="col-md-12 col-form-label text-md-center">{{ __('Mobile Phone') }}</label>
                    <input name="mobile_phone" id="mobile_phone" class="form-control" type="text" max="20"
                           placeholder="+375(___)___-__-__">
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="email"
                           class="col-md-12 col-form-label text-md-center">{{ __('Email') }}</label>
                    <input name="email" id="email" class="form-control" type="email" max="50">
                </div>
                <div class="form-group col-md-6">
                    <label for="job"
                           class="col-md-12 col-form-label text-md-center">{{ __('Job') }}</label>
                    <input name="job" id="job" class="form-control" type="text" max="20">
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="position"
                           class="col-md-12 col-form-label text-md-center">{{ __('Position') }}</label>
                    <input name="position" id="position" class="form-control" type="text" max="50">
                </div>
                <div class="form-group col-md-6">
                    <label for="pensioner" class="col-md-12 col-form-label text-md-center">{{ __('Pensioner') }}</label>
                    <div class="pick-pensioner">
                        <div class="radio">
                            <input name="pensioner" id="pensioner" type="radio" value="yes" checked>
                            <label class="radio-label">Yes</label>
                        </div>
                        <div class="radio">
                            <input name="pensioner" id="pensioner" type="radio" value="no">
                            <label class="radio-label">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="string">
                <div class="form-group col-md-6">
                    <label for="monthly_income"
                           class="col-md-12 col-form-label text-md-center">{{ __('Monthly Income') }}</label>
                    <input name="monthly_income" id="monthly_income" class="form-control" type="text"
                           pattern="\d+,\d{2}">
                </div>
            </div>
            <button class="button form-control btn-success" type="submit">Submit</button>
        </form>
    </div>
@endsection
