getPhotoList = () => {
    $.ajax({
        url: '../app/app.php',
        type: 'post',
        data: {action: 'getPhotoList'},
        dataType: 'json'
    }).done(function (data) {
        if (data.length) {
            let template = '';
            data.forEach(function (el) {
                template += `
                    <tr>
                        <td>${el.photo}</td>
                        <td><img src="uploads/${el.photo}"/></td>
                        <td><button class="btn btn-danger delete-photo" data-id="${el.id}">Delete</button></td>
                    </tr>
                `;
            });

            $('#table_photo').html(template);
        }
    });
};

deletePhoto = (userId) => {
    $.ajax({
        url: '../app/app.php',
        type: 'post',
        data: {action: 'deletePhoto', user: userId}
    }).done(function () {
        getPhotoList();
    });
};

logout = () => {
    $.ajax({
        url: '../app/app.php',
        type: 'post',
        data: {action: 'logout'}
    }).done(function () {
        localStorage.removeItem('user');
        location = 'index.html';
    });
};

$(document).on('click', '.delete-photo', function () {
    deletePhoto($(this).data('id'));
}).on('click', '#logout', function (e) {
    e.preventDefault();
    e.stopPropagation();
    logout();
});

$(function () {
    getPhotoList();
});
