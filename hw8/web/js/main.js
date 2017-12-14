let dataArray = [];

/**
 * Формирование таблицы
 *
 * @param {Object[]} data
 * @param {string} data[].id
 * @param {string} data[].name
 * @param {string} data[].description
 * @param {string} data[].price
 * @param {Object[]} data[].category
 * @param {string} data[].category.name
 * @returns {string}
 */
const createTable = (data) => {
    return `
      <table class="table table-bordered">
        <thead class="bg-primary text-white text-center">
          <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            ${data.map(item =>
            `<tr>
                <td class="text-center">${item.id}</td>
                <td class="text-center">${item.category.name}</td>
                <td>${item.name}</td>
                <td>${item.description}</td>
                <td class="text-center">${item.price}$</td>
                <td class="text-center"> 
                    <button class="btn btn-primary btn-sm item-edit" data-id="${item.id}">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button class="btn btn-danger btn-sm item-delete" data-id="${item.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
             </tr>`
    ).join('')}
        </tbody>
      </table>`;
};

/**
 * Отрисовка таблицы или сообщения об ошибке
 *
 * @param data
 */
const drawContent = (data) => {
    let content = $('#content');
    if (data.length > 0) {
        dataArray = data;
        content.html(createTable(dataArray));
    } else {
        content.html('Нет данных или не удалось их получить!');
    }
};

const reqAjax = (pattern, type, item = null) => {
    let url = pattern + ((item !== null) ? '/' + item : '');
    $.ajax({
        url: url,
        type: type,
        dataType: 'json'
    }).done(function (data) {
        drawContent(data);
    });
};

/**
 * Обновление блока content
 */
const refreshContent = () => {
    reqAjax('/goods', 'get');
};

/**
 * Удаление товара из списка товаров
 * @param item
 */
const deleteItem = (item) => {
    reqAjax('/goods', 'delete', item);
};

/**
 * Загрузка таблицы в первый раз
 */
$(function () {
    refreshContent();
    $.ajax({
        url: '/category/lists',
        type: 'get',
        dataType: 'json'
    }).done(function (data) {
        let catOptions = data.map(item => `<option value="${item.id}">${item.name}</option>`);
        $('#add-goods-category').html(catOptions);
        $('#container').show();
    });
});

$(document)
    .on('click', '.item-delete', function () {
        if (confirm('Вы действительно хотите удалить товар из списка?')) {
            deleteItem($(this).data('id'));
        }
    })
    .on('click', '.item-edit', function () {
        let item = $(this).data('id');
        $.ajax({
            url: '/goods/' + item,
            type: 'get',
            dataType: 'json'
        }).done(function (data) {
            console.log(data);
            $('#goods-id').val(data.id);
            $('#editGoodsLabelGoods').html(data.name);
            $('#goods-price').val(data.price);
            $('#goods-description').val(data.description);
            $('#goods-discount').val(data.discount);
            $('#goods-photo').val(data.photo);
            $('#editGoods').modal();
        });

    })
    .on('click', '#goodsEditSave', function () {
        let editForm = new FormData(document.forms.editGoods),
            item = $(this).data('id');
        console.log(editForm.get('goods-price'));
        $.ajax({
            url: '/goods',
            type: 'post',
            data: editForm,
            dataType: 'json',
            contentType: false,
            processData: false
        }).done(function (data) {
            console.log(data);
            drawContent(data);
            $('#editGoods').modal('hide');
        });
    })
    .on('click', '.add-goods', function () {
        $('#newGoods').modal();
    })
    .on('click', '#goodsAddSave', function () {
        let valid = true;
        let newForm = new FormData(document.forms.newGoods);
        valid = valid && ($('#add-goods-name').val().length > 0);
        valid = valid && ($('#add-goods-price').val().length > 0);
        valid = valid && ($('#add-goods-discount').val().length > 0);
        if (valid) {
            $.ajax({
                url: '/goods',
                type: 'post',
                data: newForm,
                dataType: 'json',
                contentType: false,
                processData: false
            }).done(function (data) {
                drawContent(data);
                $('#newGoods').modal('hide');
            })
        }
    });

