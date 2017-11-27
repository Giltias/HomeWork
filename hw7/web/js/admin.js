$(document)
    .on('click', '#migrateBurger', function () {
        if (confirm('Вы действительно хотите произвести миграцию?\nПосле этого удалятся все данные из таблиц user и order')) {
            $.ajax({
                url: '/migrate/users',
                type: 'get'
            }).done(function () {
                alert('Миграция прошла успешно!');
            });
        }
    }).on('click', '#migrateGoods', function () {
    if (confirm('Вы действительно хотите произвести миграцию?\nПосле этого удалятся все данные из таблиц goods и categories')) {
        $.ajax({
            url: '/migrate/goods',
            type: 'get'
        }).done(function () {
            alert('Миграция прошла успешно!');
        });
    }
});