$(document).ready(function () {
    let date = new Date();
    let now;
    if (date.getMonth() < 10) {
        if (date.getDate() < 10) {
            now = date.getFullYear() + '-0' + date.getMonth() + '-0' + date.getDate()
        } else {
            now = date.getFullYear() + '-0' + date.getMonth() + '-' + date.getDate()
        }
    } else {
        if (date.getDate() < 10) {
            now = date.getFullYear() + '-' + date.getMonth() + '-0' + date.getDate()
        } else {
            now = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate()
        }
    }
    $('#birthday').attr('max', now);
    $('#issue_date').attr('max', now);
    let pathname = window.location.pathname;
    if (pathname === '/addUser') {
        $('#addUser').addClass('active');
        $('#viewAddDeposit').removeClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').removeClass('active');
        let element;
        element = document.getElementById('home_phone');
        new IMask(element, {
            mask: '+{375} (00) 000-00-00'
        });
        element = document.getElementById('mobile_phone');
        new IMask(element, {
            mask: '+{375} (00) 000-00-00'
        });
        element = document.getElementById('passport_series');
        new IMask(element, {
            mask: 'aa'
        });
        element = document.getElementById('passport_id');
        new IMask(element, {
            mask: '0000000'
        });
        element = document.getElementById('identification_number');
        new IMask(element, {
            mask: '0000000a000aa0'
        });
        element = document.getElementById('first_name');
        new IMask(element, {
            mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
        });
        element = document.getElementById('last_name');
        new IMask(element, {
            mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
        });
        element = document.getElementById('father_name');
        new IMask(element, {
            mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
        });
        $(this).on('change', function (e) {
            if ($('#first_name').val() != '' && $('#last_name').val() != '' && $('#father_name').val() != '') {
                let string = $('#first_name').val() + $('#last_name').val() + $('#father_name').val();
                string = string.replace(/\s+/g, '');
                $.ajax({
                    url: '/checkUser',
                    method: 'POST',
                    cache: false,
                    data: {
                        'userName': string
                    },
                    success: function (response) {
                        if (response !== 'true') {
                            if (response === 'false') {
                                $('#first_name').addClass('error');
                                $('#last_name').addClass('error');
                                $('#father_name').addClass('error');
                                swal('Error', 'User with this first,last and father names is registered.', 'error')
                            } else {
                                swal('Error', response, 'error')
                            }
                        } else {
                            $('#first_name').removeClass('error');
                            $('#last_name').removeClass('error');
                            $('#father_name').removeClass('error');
                        }
                    }
                })
            }
            if ($('#passport_series').val() != '' && $('#passport_id').val() != '') {
                let string = $('#passport_series').val() + $('#passport_id').val();
                string = string.replace(/\s+/g, '');
                $.ajax({
                    url: '/checkUserPassport',
                    method: 'POST',
                    cache: false,
                    data: {
                        'userPassport': string
                    },
                    success: function (response) {
                        if (response !== 'true') {
                            if (response === 'false') {
                                $('#passport_series').addClass('error');
                                $('#passport_id').addClass('error');
                                swal('Error', 'User with this passport is registered.', 'error')
                            } else {
                                swal('Error', response, 'error')
                            }
                        } else {
                            $('#passport_series').removeClass('error');
                            $('#passport_id').removeClass('error');
                        }
                    }
                })
            }
        })
        $('#identification_number').on('change', function (e) {
            if ($('#identification_number').val() != '') {
                let string = $('#identification_number').val();
                string = string.replace(/\s+/g, '');
                $.ajax({
                    url: '/checkIdentificationNumber',
                    method: 'POST',
                    cache: false,
                    data: {
                        'identificationNumber': string
                    },
                    success: function (response) {
                        if (response !== 'true') {
                            if (response === 'false') {
                                $('#identification_number').addClass('error');
                                swal('Error', 'User with this identification number is registered.', 'error')
                            } else {
                                swal('Error', response, 'error')
                            }
                        } else {
                            $('#identification_number').removeClass('error');
                        }
                    }
                })
            }
        })
    } else if (pathname === '/deleteUser') {
        $('#addUser').removeClass('active');
        $('#deleteUser').addClass('active');
        $('#editingUser').removeClass('active');
        $('#viewAddDeposit').removeClass('active');
    } else if (pathname === '/editingUser') {
        $('#addUser').removeClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').addClass('active');
        $('#viewAddDeposit').removeClass('active');
        let element;
        element = document.getElementById('home_phone');
        new IMask(element, {
            mask: '+{375} (00) 000-00-00'
        });
        element = document.getElementById('mobile_phone');
        new IMask(element, {
            mask: '+{375} (00) 000-00-00'
        });
        element = document.getElementById('passport_series');
        new IMask(element, {
            mask: 'aa'
        });
        element = document.getElementById('passport_id');
        new IMask(element, {
            mask: '0000000'
        });
        element = document.getElementById('identification_number');
        new IMask(element, {
            mask: '0000000a000aa0'
        });
        element = document.getElementById('first_name');
        new IMask(element, {
            mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
        });
        element = document.getElementById('last_name');
        new IMask(element, {
            mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
        });
        element = document.getElementById('father_name');
        new IMask(element, {
            mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
        });
        let select;
        let idCitezen;
        let idregistration;
        let idresidence;
        let iddisabilities;
        let idfamily_positions;
        $('#select_user').on('change', function () {
            select = $(this).val();
            $('.select').fadeOut();
            $('.selected').fadeIn();
            $.ajax({
                url: "getUserInfoByID/" + select + "",
                method: "GET",
                cache: false,
                success: function (response) {
                    for (key in response) {
                        $('#first_name').val(response[key]['first_name']);
                        $('#last_name').val(response[key]['last_name']);
                        $('#father_name').val(response[key]['father_name']);
                        $('#birthday').val(response[key]['birthday']);
                        $('input[name = "sex"][value = "' + response[key]['sex'] + '"]').prop('checked', true);
                        $('#passport_series').val(response[key]["passport_series"]);
                        $('#passport_id').val(response[key]["passport_id"]);
                        $('#issued_by').val(response[key]["issued_by"]);
                        $('#issue_date').val(response[key]["issue_date"]);
                        $('#identification_number').val(response[key]["identification_number"]);
                        $('#birthplace').val(response[key]["birthplace"]);
                        $('#address').val(response[key]["address"]);
                        $('#home_phone').val(response[key]["home_phone"]);
                        $('#mobile_phone').val(response[key]["mobile_phone"]);
                        $('#email').val(response[key]["email"]);
                        $('#job').val(response[key]["job"]);
                        $('#position').val(response[key]["position"]);
                        $('#monthly_income').val(response[key]["monthly_income"]);
                        $('input[name = "pensioner"][value = "' + response[key]['pensioner'] + '"]').prop('checked', true);
                        idCitezen = response[key]['citizenships_id'];
                        $.ajax({
                            url: "/getCitizenship",
                            method: "GET",
                            cache: false,
                            success: function (response) {
                                for (key in response) {
                                    if (response[key]["id"] == idCitezen) {
                                        $('#citizenship').append('<option value="' + response[key]["id"] + '" selected="selected">' + response[key]["name"] + '</option>')
                                    } else {
                                        $('#citizenship').append('<option value="' + response[key]["id"] + '">' + response[key]["name"] + '</option>')
                                    }
                                }
                            }
                        });
                        idregistration = response[key]['registration_cities_id'];
                        $.ajax({
                            url: "/getRegistrationCity",
                            method: "GET",
                            cache: false,
                            success: function (response) {
                                for (key in response) {
                                    if (response[key]["id"] == idregistration) {
                                        $('#registration_city').append('<option value="' + response[key]["id"] + '" selected="selected">' + response[key]["name"] + '</option>')
                                    } else {
                                        $('#registration_city').append('<option value="' + response[key]["id"] + '">' + response[key]["name"] + '</option>')
                                    }
                                }
                            }
                        });
                        idresidence = response[key]['residence_cities_id'];
                        $.ajax({
                            url: "/getResidenceCity",
                            method: "GET",
                            cache: false,
                            success: function (response) {
                                for (key in response) {
                                    if (response[key]["id"] == idresidence) {
                                        $('#residence_city').append('<option value="' + response[key]["id"] + '" selected="selected">' + response[key]["name"] + '</option>')
                                    } else {
                                        $('#residence_city').append('<option value="' + response[key]["id"] + '">' + response[key]["name"] + '</option>')
                                    }
                                }
                            }
                        });
                        iddisabilities = response[key]['disabilities_id'];
                        $.ajax({
                            url: "/getDisability",
                            method: "GET",
                            cache: false,
                            success: function (response) {
                                for (key in response) {
                                    if (response[key]["id"] == iddisabilities) {
                                        $('#disability').append('<option value="' + response[key]["id"] + '" selected="selected">' + response[key]["name"] + '</option>')
                                    } else {
                                        $('#disability').append('<option value="' + response[key]["id"] + '">' + response[key]["name"] + '</option>')
                                    }
                                }
                            }
                        });
                        idfamily_positions = response[key]['family_positions_id'];
                        $.ajax({
                            url: "/getFamilyPosition",
                            method: "GET",
                            cache: false,
                            success: function (response) {
                                for (key in response) {
                                    if (response[key]["id"] == idfamily_positions) {
                                        $('#family_position').append('<option value="' + response[key]["id"] + '" selected="selected">' + response[key]["name"] + '</option>')
                                    } else {
                                        $('#family_position').append('<option value="' + response[key]["id"] + '">' + response[key]["name"] + '</option>')
                                    }
                                }
                            }
                        });
                    }
                }
            })
        })
    } else if (pathname === '/viewAddDeposit') {
        $('#date_start').attr('min', now);
        $('#addUser').removeClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').removeClass('active');
        $('#viewAddDeposit').addClass('active');
        let select;
        $('#select_user').on('change', function () {
            select = $(this).val();
            $('.select').fadeOut();
            $('.selected').fadeIn();
        });
        $('#deposit_type, #currency').on('change', function () {
            if ($('#deposit_type').val() != '' && $('#currency').val() != '') {
                $('.dynamic').fadeIn();
                $('#duration option').detach();
                $.ajax({
                    url: "/getDuration/" + $('#currency').val() + "/" + $('#deposit_type').val() + "",
                    method: "GET",
                    cache: false,
                    success: function (response) {
                        for (let key in response) {
                            $('#duration').append('<option value="' + response[key] + '">' + response[key] + ' month' + '</option>')
                        }
                        $('#duration').on({
                            'change': function () {
                                $('#percent').val('');
                                $('.percent').fadeIn();
                                $.ajax({
                                    url: "/getPercent/" + $('#currency').val() + "/" + $('#deposit_type').val() + "/" + $('#duration option:selected').val() + "",
                                    method: "GET",
                                    cache: false,
                                    success: function (response) {
                                        for (let key in response) {
                                            $('#percent').val(response[key]);
                                        }
                                    }
                                });
                            },
                            'focusin': function () {
                                $('#percent').val('');
                                $('.percent').fadeIn();
                                $.ajax({
                                    url: "/getPercent/" + $('#currency').val() + "/" + $('#deposit_type').val() + "/" + $('#duration option:selected').val() + "",
                                    method: "GET",
                                    cache: false,
                                    success: function (response) {
                                        for (let key in response) {
                                            $('#percent').val(response[key]);
                                        }
                                    }
                                });
                            }
                        })
                    }
                })
            } else {
                $('.dynamic').fadeOut();
                $('.percent').fadeOut();
                $('#percent').val('')
            }
        })
        let amount;
        $('#amount').on('change', function () {
            amount = parseFloat($('#amount').val());
            if (amount < 20.00) {
                swal('Error', 'Amount must be more than 20', 'error');
                $('#amount').val('')
            }
        });
        $(this).on('change', function () {
            if ($('#amount').val() != '' && $('#percent').val() != '' && $('#deposit_type option:selected').val() != '' && $('#currency option:selected').val() != '' && $('#date_start').val() != '') {
                $('.contract_number').fadeIn();
                let current_accounts;
                let interest_accounts;
                let number;
                let secondNumber;
                $.ajax({
                    url: "getCountAccounts/"+select+"",
                    method: "GET",
                    cache: false,
                    success: function (response) {
                        if (response<10){
                            number = '00'+response;
                            secondNumber = parseInt(response)+1;
                            secondNumber = '00'+secondNumber;
                        } else if (response>99) {
                            number = response;
                            secondNumber = parseInt(response)+1;
                        } else{
                            number = '0'+response;
                            secondNumber = parseInt(response)+1;
                            secondNumber = '0'+secondNumber;
                        }
                        current_accounts = '3014' +'01563'+number+'9';
                        interest_accounts = '3014' +'01563'+secondNumber+'9';
                        $('#current_accounts').val(current_accounts).prop('disabled', true);
                        $('#interest_accounts').val(interest_accounts).prop('disabled', true);
                        $('#interest_account').val($('#interest_accounts').val())
                        $('#current_account').val($('#current_accounts').val())
                    }
                });
                $('.button').prop('disabled', false)
            } else {
                $('.contract_number').fadeOut();
                $('#current_accounts').val('');
                $('#interest_accounts').val('');
                $('.button').prop('disabled', true)
            }
        })
    }
});
