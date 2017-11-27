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
    let host = window.location.hostname;
    // let response = grecaptcha.getResponse();
    let response = '1123123';
    if (response.length) {
        $.ajax({
            url: '/order',
            type: 'post',
            data: new FormData($('form')[0]),
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false
        }).done(function (data) {
            alert(data);
        });
    } else {
        alert('Капча не пройдена! Ваше сообщение не сформировано, не отправлено и бургер Вы не получите! Попробуйте еще раз ;)');
    }
});
