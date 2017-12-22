/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('sidemenu', require('./components/Sidemenu.vue'));
Vue.component('categories', require('./components/Categories.vue'));

const app = new Vue({
    el: '#app'
});

$('[data-toggle="tooltip"]').tooltip();

$('.goods-item').click(function (e) {
    if (!$(e.target).hasClass('btn')) {
        window.location = '/goods/' + $(this).data('id');
    } else {
        axios.get('/goods/json/' + $(this).data('id'))
            .then(response => {
                let item = response.data;
                console.log(item);
                $('#order-email').removeClass('is-invalid').removeClass('is-valid');
                $('#order-person').removeClass('is-invalid').removeClass('is-valid');
                $('#order-goods-id').val(item.id);
                $('#order-goods-name').html(item.name);
                $('#order').modal();
            });
    }
});

$('.goods-order').click(function (e) {
    axios.get('/goods/json/' + $(this).data('id'))
        .then(response => {
            let item = response.data;
            console.log(item);
            $('#order-email').removeClass('is-invalid').removeClass('is-valid');
            $('#order-person').removeClass('is-invalid').removeClass('is-valid');
            $('#order-goods-id').val(item.id);
            $('#order-goods-name').html(item.name);
            $('#order').modal();
        });
});

$('#order-confirm').click(function () {
    if ($('#order-email').val().length === 0) {
        $('#order-email').removeClass('is-valid').addClass('is-invalid');
        alert('Поле для e-mail не заполнено');
        return false;
    } else {
        $('#order-email').removeClass('is-invalid').addClass('is-valid');
    }
    if ($('#order-person').val().length === 0) {
        $('#order-person').removeClass('is-valid').addClass('is-invalid');
        alert('Поле имени не заполнено');
        return false;
    } else {
        $('#order-person').removeClass('is-invalid').addClass('is-valid');
    }

    axios.post('/order/confirm', {
        'order-goods-id': $('#order-goods-id').val(),
        'order-email'   : $('#order-email').val(),
        'order-person'  : $('#order-person').val()
    })
        .then(response => {
            $('#order').modal('hide');
            alert('Спасибо за Ваш заказ, ' + response.data.person +
                '! Наш сотрудник свяжется с Вами по указаному E-mail: ' + response.data.email + '.');
        });
    return true;
});

$('.item-delete').click(function (e) {
    if (!confirm('Вы действительно хотите удалить данную позицию?')) {
        e.preventDefault();
    }
});


