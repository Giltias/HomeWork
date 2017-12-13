let dataArray = [];

const createTable = (data) => {
    let tableTemplate = `
      <table class="table table-bordered table-hover">
        <thead class="bg-primary text-white text-center">
          <tr>
            <td>Id</td>
            <td>Category</td>
            <td>Name</td>
            <td>Description</td>
            <td>Price</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
            ${data.map(item =>
            `<tr>
                <td>${item.id}</td>
                <td>${item.category.name}</td>
                <td>${item.name}</td>
                <td>${item.description}</td>
                <td>${item.price}</td>
                <td> 
                    <button class="btn btn-danger btn-sm item-delete" data-id="${item.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
             </tr>`
            ).join('')}
        </tbody>
      </table>`;
    return tableTemplate;
}

const drawTable = () => {
    $('#content').html(createTable(dataArray));
}

const refreshContent = () => {
    $.ajax({
        url: '/goods',
        type: 'get',
        dataType: 'json'
    }).done(function (data) {
        if (data.length > 0) {
            dataArray = data;
            drawTable();
        } else {
            $('#content').html('Нет данных или не удалось их получить!');
        }
    });
}

const deleteItem = (item) => {
    $.ajax({
        url: '/goods/' + item,
        type: 'delete',
        dataType: 'json'
    }).done(function (data) {
        if (data.length > 0) {
            dataArray = data;
            drawTable();
        } else {
            $('#content').html('Нет данных или не удалось их получить!');
        }
    });
}

$(function () {
    refreshContent();
});

$(document).on('click', '.item-delete', function () {
    if (confirm('Вы действительно хотите удалить товар из списка?')) {
        $(this).data('id')
    }
})

