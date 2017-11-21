// action="../app/source/newOrder.php" method="post"

const checkFillInputs = () => {
    let elements = [$('input[name=name]'), $('input[name=phone]'), $('input[name=email]')],
        notEmpty = true;
    elements.forEach(function (el) {
        notEmpty = notEmpty && (el.val().length > 0);
    });
    return notEmpty;
};

const recaptchaShowControl = () => {
    let el = $('.g-recaptcha');
    (checkFillInputs()) ? el.show() : el.hide();
};

$(document).on('keyup', 'input[name=name]', function () {
    recaptchaShowControl();
}).on('keyup', 'input[name=phone]', function () {
    recaptchaShowControl();
}).on('keyup', 'input[name=email]', function () {
    recaptchaShowControl();
}).on('click', 'input[type=submit]', function (event) {
    event.preventDefault();
    event.stopPropagation();
    let response = grecaptcha.getResponse();
    if (response.length) {
        $.ajax({
            url: '../app/source/newOrder.php',
            type: 'post',
            data: {
                name:     $('input[name=name]').val(),
                phone:    $('input[name=phone]').val(),
                email:    $('input[name=email]').val(),
                street:   $('input[name=street]').val(),
                home:     $('input[name=home]').val(),
                part:     $('input[name=part]').val(),
                appt:     $('input[name=appt]').val(),
                floor:    $('input[name=floor]').val(),
                comment:  $('textarea[name=comment]').val(),
                payment:  $('input[name=payment]').val(),
                callback: $('input[name=callback]').val()
            }
        }).done(function (data) {
            console.log(data);
            alert('Сообщение послано');
        });
    } else {
        alert('Капча не пройдена! Ваше сообщение не сформировано, не отправлено и бургер Вы не получите! Попробуйте еще раз ;)');
    }
});
