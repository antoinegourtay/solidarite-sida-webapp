$('#display_email').on('click', function () {
    if ($(this).hasClass('active')) {
        $(this).children('img').attr('src', '/images/mail.png');
    } else {
        $(this).children('img').attr('src', '/images/mail_active.png');
    }

    $(this).toggleClass('active');
    $('.person_email').toggle();
});

$('#display_phone').on('click', function () {
    if ($(this).hasClass('active')) {
        $(this).children('img').attr('src', '/images/tel.png');
    } else {
        $(this).children('img').attr('src', '/images/phone_active.png');
    }

    $(this).toggleClass('active');
    $('.person_phone').toggle();
});

$('#display_address').on('click', function () {
    if ($(this).hasClass('active')) {
        $(this).children('img').attr('src', '/images/adresse.png');
    } else {
        $(this).children('img').attr('src', '/images/address_active.png');
    }

    $(this).toggleClass('active');
    $('.person_address').toggle();
});

$('#display_permis').on('click', function () {
    if ($(this).hasClass('active')) {
        $(this).children('img').attr('src', '/images/permis.png');
    } else {
        $(this).children('img').attr('src', '/images/permis_active.png');
    }

    $(this).toggleClass('active');
    $('.person_permis').toggle();
});