const buildMenu = (data) => {
    let tmp = ``;
    data.map((item, key) => {
        tmp = `
            <ul>
                <li data-id="${item.id}">${item.name}</li>   
                <ul id="ul${item.id}">
                </ul>
            </ul>`;
        (key === 0) ? $('#menu').html(tmp) : $('#ul' + item.subcategory_id).append(tmp);
    });
};

const refreshGoods = (category) => {
    $.ajax({
        url: 'category/goods/' + category,
        type: 'get',
        dataType: 'json'
    }).done(function (data) {
        let goods = data.map(item =>
            `<div class="col-2 pt-2 pb-2 d-flex flex-column align-items-center border" style="height: 220px">
                <div class="d-flex flex-column justify-content-center" style="min-height: 125px; max-height: 125px">
                    <img src="/web/uploads/goods/${item.photo}" width="100" style="max-height: 125px" alt="">
                </div>
                <div class="w-100 d-flex flex-column block-overflow">
                    <span><b>${item.name}</b></span>
                    <span>Price: ${item.price}$</span>
                    <span class="text-desc" data-toggle="tooltip" data-placement="bottom" title="${item.description}">Desc: ${item.description}</span>
                </div> 
            </div>`
        );
        $('#content').html(goods);
        $('[data-toggle="tooltip"]').tooltip();
    });
};

$(function () {
    $.ajax({
        url: '/category/list',
        type: 'get',
        dataType: 'json'
    }).done(function (data) {
        buildMenu(data);
        refreshGoods(1);
    });

    $(document).on('click', '#menu li', function () {
        refreshGoods($(this).data('id'));
    });
});