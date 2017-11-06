/**
 * Created by arku on 07.03.2017.
 */
console.log('Hello, World')
var selector = "div.starter-template>h1";

var zagolovok = $(selector);
var zagovol_data = zagolovok.html()
zagolovok.html('ahaha')

console.log(zagovol_data);

$('#returnback').on('click', function(){
    // zagolovok.html(zagovol_data)

    $.ajax({
        url: '/data.php',
        method: 'post',
        data: {
            superdata: zagovol_data //$_POST['superdata']
        }
    }).done(function (data) {
        var json = JSON.parse(data);  //JSON.stringify()
        var str = json.name + ' - ' + json.occupation + json.superdata;
        zagolovok.html(str)
    });
});

$(document).on('click', '.login', function (e) {
    e.preventDefault();
    e.stopPropagation();
    let el = document.getElementById('inputEmail3');
    let el2 = document.getElementById('inputPassword3');
    if (!el.checkValidity()) {
        alert('Введите логин пользователя!');
        return false;
    }
    if (!el2.checkValidity()) {
        alert('Введите пароль!');
        return false;
    }
    $.ajax({
        url: '../app/app.php',
        type: 'post',
        data: {action: 'loginUser', login: el.value, password: el2.value}
    }).done(function (data) {
        localStorage.setItem('user', data);
        checkUser();
    });
});

$(document).on('click', '.registration', function (e) {
    e.preventDefault();
    e.stopPropagation();
    let el = document.getElementById('regEmail3');
    let el2 = document.getElementById('regPassword3');
    if (!el.checkValidity()) {
        alert('Введите логин!');
        return false;
    }
    if (!el2.checkValidity()) {
        alert('Введите пароль!');
        return false;
    }
    $.ajax({
        url: '../app/app.php',
        type: 'post',
        data: {action: 'registrationUser', login: el.value, password: el2.value}
    }).done(function (data) {
        localStorage.setItem('user', data);
        checkUser();
    });
});

getUserData = (user) => {
    let curFile = location.pathname.substring(location.pathname.lastIndexOf("/") + 1).trim();
    if (curFile === 'user.html') {
        $.ajax({
            url: '../app/app.php',
            type: 'post',
            data: {action: 'getUserData', user: user},
            dataType: 'json'
        }).done(function (data) {
            localStorage.removeItem('editUser');
            $('#user').val(data.id);
            $('input[name=name]').val(data.name);
            $('input[name=date]').val(data.birthday);
            $('textarea[name=description]').val(data.description);
        });
    }
};

getUserData(localStorage.getItem('editUser') !== null
    ? localStorage.getItem('editUser')
    : localStorage.getItem('user'));

setActiveLink = () => {
    let curFile = location.pathname.substring(location.pathname.lastIndexOf("/") + 1).trim();
    $('a[href="' + curFile + '"]').closest('li').addClass('active');
}

setActiveLink();






