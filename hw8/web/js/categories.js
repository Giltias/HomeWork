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
            <th>Name</th>
            <th>Parent</th>
            <th>Discount</th>
            <th>Active</th>
            <th width="200px">Actions</th>
          </tr>
        </thead>
        <tbody>
            ${data.map(item =>
            `<tr>
                <td class="text-center">${item.id}</td>
                <td class="text-center">${item.name}</td>
                <td>${item.parent}</td>
                <td>${item.discount}</td>
                <td class="text-center">${item.active}</td>
                <td class="text-center"> 
                    <button class="btn btn-primary btn-sm item-edit" data-id="${item.id}">
                        Edit</i>
                    </button>
                    <button class="btn btn-danger btn-sm item-delete" data-id="${item.id}">
                        Change Active</i>
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
    $.ajax({
        url: '/category',
        type: 'get',
        dataType: 'json'
    }).done(function (data) {
        let options = data.map(item => `<option value="${item.id}">${item.name}</option>`).join('');
        $('#add-parent-category').html(options);
        $('#parent-category').html(options);
    });
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
        console.log(data);
        drawContent(data);
        $('#container').show();
    });
};

/**
 * Обновление блока content
 */
const refreshContent = () => {
    reqAjax('/category', 'get');
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
    $('#link-categories').addClass('active');
    refreshContent();
});

$(document)
    .on('click', '.item-delete', function () {
        $.ajax({
            url: '/category/active/change',
            type: 'post',
            dataType: 'json',
            data: {id: $(this).data('id')}
        }).done(function (data) {
            console.log(data);
            drawContent(data);
        })
    })
    .on('click', '.item-edit', function () {
        let item = $(this).data('id');
        $.ajax({
            url: '/category/' + item,
            type: 'get',
            dataType: 'json'
        }).done(function (data) {
            console.log(data);
            $('#category').val(data.id);
            $('#parent-category').val(data.subcategory_id);
            $('#category-discount').val(data.discount);
            $('#editCategory').modal();
        });

    })
    .on('click', '#categoryEditSave', function () {
        let editForm = new FormData(document.forms.editCategory);
        console.log(editForm.get('parent'))
        $.ajax({
            url: '/category',
            type: 'post',
            data: editForm,
            dataType: 'json',
            contentType: false,
            processData: false
        }).done(function (data) {
            console.log(data);
            drawContent(data);
            $('#editCategory').modal('hide');
        });
    })
    .on('click', '.add-category', function () {
        $('#addCategory').modal();
    })
    .on('click', '#categoryAddSave', function () {
        let valid = true;
        let newForm = new FormData(document.forms.addCategory);
        valid = valid && ($('#add-parent-category').val().length > 0);
        valid = valid && ($('#add-category-name').val().length > 0);
        valid = valid && ($('#add-category-discount').val().length > 0);
        console.log(valid);
        if (valid) {
            $.ajax({
                url: '/category',
                type: 'post',
                data: newForm,
                dataType: 'json',
                contentType: false,
                processData: false
            }).done(function (data) {
                drawContent(data);
                $('#addCategory').modal('hide');
            })
        }
    });

