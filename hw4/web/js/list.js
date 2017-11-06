getUserList = () => {
    $.ajax({
        url: '../app/app.php',
        type: 'post',
        data: {action: 'getUserList'},
        dataType: 'json'
    }).done(function (data) {
        if (data.length) {
            let template = '';
            data.forEach(function (el) {
                let img = '';
                if (el.photo !== null) {
                    img = '<img src="uploads/' + el.photo + '"/>';
                }
                template += `
                    <tr>
                        <td>${el.login}</td>
                        <td>${el.name}</td>
                        <td>${el.age}</td>
                        <td>${el.description}</td>
                        <td>${img}</td>
                        <td>
                            <button class="btn btn-primary edit-user" data-id="${el.id}">Edit</button>
                            <button class="btn btn-danger delete-user">Delete</button>
                        </td>
                    </tr>
                `;
            });

            $('#table_data').html(template);
        }
    });
};

deleteUser = (userLogin) => {
    $.ajax({
        url: '../app/app.php',
        type: 'post',
        data: {action: 'deleteUser', user: userLogin}
    }).done(function (data) {
       getUserList();
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

$(document).on('click', '.delete-user', function () {
    deleteUser($(this).closest('tr').find('td').eq(0).html());
}).on('click', '#logout', function (e) {
    e.preventDefault();
    e.stopPropagation();
    logout();
}).on('click', '.edit-user', function () {
    localStorage.setItem('editUser', $(this).data('id'));
    window.location.href = 'user.html';
});

$(function () {
    getUserList();
});
