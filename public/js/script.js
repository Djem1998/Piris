$(document).ready(function () {
    let date = new Date();
    now = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate();
    $('#birthday').attr('max', now);
    $('#issue_date').attr('max', now);

    let mask;
    let element;
    element = document.getElementById('home_phone');
    mask = new IMask(element, {
        mask: '+{375} (00) 000-00-00'
    });
    element = document.getElementById('mobile_phone');
    mask = new IMask(element, {
        mask: '+{375} (00) 000-00-00'
    });
    element = document.getElementById('passport_series');
    mask = new IMask(element, {
        mask: 'aa'
    });
    element = document.getElementById('passport_id');
    mask = new IMask(element, {
        mask: '0000000'
    });
    element = document.getElementById('identification_number');
    mask = new IMask(element, {
        mask: '0000000a000aa0'
    });
    element = document.getElementById('first_name');
    mask = new IMask(element, {
        mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
    });
    element = document.getElementById('last_name');
    mask = new IMask(element, {
        mask: /^[а-яА-ЯёЁa-zA-Z]{1,20}$/
    });
    element = document.getElementById('father_name');
    mask = new IMask(element, {
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
            let string = $('#identification_number').val() ;
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
});
