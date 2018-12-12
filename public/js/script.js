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
    $('.closing').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: "/bankDayClosing",
            method: "GET",
            cache: false,
            success: function (response) {
                if (response == 'Operation successful.') {
                    $.ajax({
                        url: "/bankDayClosingCredit",
                        method: "GET",
                        cache: false,
                        success:function (response) {
                            if (response == 'Operation successful.') {
                                swal('Success', 'Deposit and Credit operations successful.', 'success')
                            }else {
                                swal('Error', 'Deposit operation successful, Credit operation failed.', 'error')
                            }
                        }
                    })
                } else {
                    swal('Error', response, 'error')
                }
            }
        })
    });
    let pathname = window.location.pathname;
    if (pathname === '/addUser') {
        $('#viewAddCredit').removeClass('active');
        $('#addUser').addClass('active');
        $('#viewAddDeposit').removeClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').removeClass('active');
        $('#viewTerminal').removeClass('active');
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
        $('#viewAddCredit').removeClass('active');
        $('#addUser').removeClass('active');
        $('#deleteUser').addClass('active');
        $('#editingUser').removeClass('active');
        $('#viewAddDeposit').removeClass('active');
        $('#viewTerminal').removeClass('active');
    } else if (pathname === '/editingUser') {
        $('#viewAddCredit').removeClass('active');
        $('#addUser').removeClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').addClass('active');
        $('#viewAddDeposit').removeClass('active');
        $('#viewTerminal').removeClass('active');
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
        $('#viewAddCredit').removeClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').removeClass('active');
        $('#viewAddDeposit').addClass('active');
        $('#viewTerminal').removeClass('active');
        let select;
        let uniqueItems = [];
        $('#select_user').on('change', function () {
            select = $(this).val();
            $('.select').fadeOut();
            $('.selected').fadeIn();
            $.ajax({
                url: "/getCurrency",
                method: "GET",
                cache: false,
                success: function (response) {
                    uniqueItems = Array.from(new Set(response));
                    for (let i = 0; i < uniqueItems.length; i++) {
                        $('#currency').append('<option value="' + uniqueItems[i] + '">' + uniqueItems[i] + '</option>')
                    }
                }
            });
            $.ajax({
                url: "/getName",
                method: "GET",
                cache: false,
                success: function (response) {
                    uniqueItems = Array.from(new Set(response));
                    for (let i = 0; i < uniqueItems.length; i++) {
                        $('#deposit_type').append('<option value="' + uniqueItems[i] + '">' + uniqueItems[i] + '</option>')
                    }
                }
            });
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
        });
        let amount;
        let count;
        let token;
        $('#amount').on('change', function () {
            amount = parseFloat($('#amount').val());
            $.ajax({
                url: "/getSum/" + $('#currency').val() + "/" + $('#deposit_type').val() + "/" + $('#duration option:selected').val() + "",
                method: "GET",
                cache: false,
                success: function (response) {
                    count = response.substr(1, response.length);
                    token = response.substring(0, 1);
                    if (token == '+') {
                        if (amount < parseFloat(count)) {
                            swal('Error', 'Amount must be more than '+count, 'error');
                            $('#amount').val('')
                        }
                    }else {
                        if (amount > parseFloat(count)) {
                            swal('Error', 'Amount must be less than '+count, 'error');
                            $('#amount').val('')
                        }
                    }
                }
            });
        });
        $(this).on('change', function () {
            if ($('#amount').val() != '' && $('#percent').val() != '' && $('#deposit_type option:selected').val() != '' && $('#currency option:selected').val() != '' && $('#date_start').val() != '') {
                $('.contract_number').fadeIn();
                let current_accounts;
                let interest_accounts;
                let number;
                let secondNumber;
                $.ajax({
                    url: "getCountAccounts/" + select + "",
                    method: "GET",
                    cache: false,
                    success: function (response) {
                        if (response < 10) {
                            number = '00' + response;
                            secondNumber = parseInt(response) + 1;
                            secondNumber = '00' + secondNumber;
                        } else if (response > 99) {
                            number = response;
                            secondNumber = parseInt(response) + 1;
                        } else {
                            number = '0' + response;
                            secondNumber = parseInt(response) + 1;
                            secondNumber = '0' + secondNumber;
                        }
                        current_accounts = '3014' + '01563' + number + '9';
                        interest_accounts = '3014' + '01563' + secondNumber + '9';
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
        });
        $('.button').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/addDeposit',
                method: "POST",
                cache: false,
                data:{
                    select_user: $('#select_user option:selected').val(),
                    current_account: $('#current_account').val(),
                    interest_account: $('#interest_account').val(),
                    deposit_type: $('#deposit_type option:selected').val(),
                    currency: $('#currency option:selected').val(),
                    duration: $('#duration option:selected').val(),
                    percent: $('#percent').val(),
                    amount: $('#amount').val(),
                    date_start: $('#date_start').val(),
                },
                success:function (response) {
                    if (response == 'Something went wrong.') {
                        swal('Error', response, 'error')
                    } else{
                        swal('Success', response, 'success')
                    }
                }
            })
        });
    } else if (pathname === '/viewAddCredit') {
        $('#date_start').attr('min', now);
        $('#addUser').removeClass('active');
        $('#viewAddCredit').addClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').removeClass('active');
        $('#viewAddDeposit').removeClass('active');
        $('#viewTerminal').removeClass('active');
        let select;
        let uniqueItems = [];
        $('#select_user').on('change', function () {
            select = $(this).val();
            $('.select').fadeOut();
            $('.selected').fadeIn();
            $.ajax({
                url: "/getCurrencyCredit",
                method: "GET",
                cache: false,
                success: function (response) {
                    uniqueItems = Array.from(new Set(response));
                    for (let i = 0; i < uniqueItems.length; i++) {
                        $('#currency').append('<option value="' + uniqueItems[i] + '">' + uniqueItems[i] + '</option>')
                    }
                }
            });
            $.ajax({
                url: "/getNameCredit",
                method: "GET",
                cache: false,
                success: function (response) {
                    uniqueItems = Array.from(new Set(response));
                    for (let i = 0; i < uniqueItems.length; i++) {
                        $('#deposit_type').append('<option value="' + uniqueItems[i] + '">' + uniqueItems[i] + '</option>')
                    }
                }
            });
        });
        $('#deposit_type, #currency').on('change', function () {
            if ($('#deposit_type').val() != '' && $('#currency').val() != '') {
                $('.dynamic').fadeIn();
                $('#duration option').detach();
                $.ajax({
                    url: "/getDurationCredit/" + $('#currency').val() + "/" + $('#deposit_type').val() + "",
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
                                    url: "/getPercentCredit/" + $('#currency').val() + "/" + $('#deposit_type').val() + "/" + $('#duration option:selected').val() + "",
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
                                    url: "/getPercentCredit/" + $('#currency').val() + "/" + $('#deposit_type').val() + "/" + $('#duration option:selected').val() + "",
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
        });
        let amount;
        let count;
        let token;
        $('#amount').on('change', function () {
            amount = parseFloat($('#amount').val());
            $.ajax({
                url: "/getSumCredit/" + $('#currency').val() + "/" + $('#deposit_type').val() + "/" + $('#duration option:selected').val() + "",
                method: "GET",
                cache: false,
                success: function (response) {
                    count = response.substr(1, response.length);
                    token = response.substring(0, 1);
                    if (token == '+') {
                        if (amount < parseFloat(count)) {
                            swal('Error', 'Amount must be more than '+count, 'error');
                            $('#amount').val('')
                        }
                    }else {
                        if (amount > parseFloat(count)) {
                            swal('Error', 'Amount must be less than '+count, 'error');
                            $('#amount').val('')
                        }
                    }
                }
            });
        });
        $(this).on('change', function () {
            if ($('#amount').val() != '' && $('#percent').val() != '' && $('#deposit_type option:selected').val() != '' && $('#currency option:selected').val() != '' && $('#date_start').val() != '') {
                $('.contract_number').fadeIn();
                let current_accounts;
                let interest_accounts;
                let number;
                let secondNumber;
                $.ajax({
                    url: "getCountAccountsCredit/" + select + "",
                    method: "GET",
                    cache: false,
                    success: function (response) {
                        if (response < 10) {
                            number = '00' + response;
                            secondNumber = parseInt(response) + 1;
                            secondNumber = '00' + secondNumber;
                        } else if (response > 99) {
                            number = response;
                            secondNumber = parseInt(response) + 1;
                        } else {
                            number = '0' + response;
                            secondNumber = parseInt(response) + 1;
                            secondNumber = '0' + secondNumber;
                        }
                        current_accounts = '2412' + '01563' + number + '8';
                        interest_accounts = '2412' + '01563' + secondNumber + '8';
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
        });
        $('.button').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/addCredit',
                method: "POST",
                cache: false,
                data:{
                    select_user: $('#select_user option:selected').val(),
                    current_account: $('#current_account').val(),
                    interest_account: $('#interest_account').val(),
                    deposit_type: $('#deposit_type option:selected').val(),
                    currency: $('#currency option:selected').val(),
                    duration: $('#duration option:selected').val(),
                    percent: $('#percent').val(),
                    amount: $('#amount').val(),
                    date_start: $('#date_start').val(),
                },
                success:function (response) {
                    if (response == 'Something went wrong.') {
                        swal('Error', response, 'error')
                    } else{
                        swal('Success', response, 'success')
                    }
                }
            })
        });
    } else if(pathname === '/viewTerminal'){
        $('.operations').fadeOut();
        $('.true').fadeIn();
        let card_number;
        let pin_code;
        $('#addUser').removeClass('active');
        $('#viewAddCredit').removeClass('active');
        $('#deleteUser').removeClass('active');
        $('#editingUser').removeClass('active');
        $('#viewAddDeposit').removeClass('active');
        $('#viewTerminal').addClass('active');
        $(this).on('change', function (e) {
            if ($('#card_number').val() != '' && $('#pin_code').val() != '') {
                $('#enter_card').attr('disabled', false)
            }
            if ($('#operation_type option:selected').val() == 'getMoneyFromCredit') {
                $('#sum').fadeIn()
            }else {
                $('#sum').fadeOut()
            }
        });
        let count = 0;
        let num;
        $('#enter_card').on('click', function (e) {
            if (count >= 2 && num == $('#card_number').val()){
                $('#enter_card').attr('disabled', true)
                $('#card_number').val('').attr('disabled', true);
                $('#pin_code').val('').attr('disabled', true);
                swal('Error', 'You enter incorrect pin code 3 times', 'error')
            }
            e.preventDefault();
            card_number = $('#card_number').val();
            pin_code = $('#pin_code').val();
            $.ajax({
                url: "/checkAutorization",
                method: "POST",
                data:{
                    card_number: card_number,
                    pin_code: pin_code,
                },
                cache: false,
                success: function (response) {
                    if (response == 0){
                        swal('Error', 'Check number and pin code card', 'error');
                        ++count;
                        num = card_number;
                        $('#card_number').val('');
                        $('#pin_code').val('');
                    } else {
                        $('.operations').fadeIn();
                        $('.true').fadeOut();
                        $('#card_number').val('');
                        $('#pin_code').val('');
                        $('#enter').on('click', function (e) {
                            e.preventDefault();
                            if ($('#operation_type option:selected').val() != 'cancel') {
                                $.ajax({
                                    url: "/"+$('#operation_type option:selected').val()+"",
                                    method: "POST",
                                    cache: false,
                                    data:{
                                        card_num: card_number,
                                        sum: $('#sum').val(),
                                    },
                                    success: function (response) {
                                        if (response == 'Something went wrong.') {
                                            swal('Error', response, 'error');
                                        } else {
                                            swal('Success', response, 'success');
                                            $('.operations').fadeOut();
                                            $('.true').fadeIn();
                                        }
                                    }
                                })
                            } else {
                                $('.operations').fadeOut();
                                $('.true').fadeIn();
                                $('#sum').fadeOut()
                            }
                        })
                    }
                }
            })
        })
    }
});
