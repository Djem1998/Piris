$(document).ready(function () {
    let date = new Date();
    now = date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate();
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
});
