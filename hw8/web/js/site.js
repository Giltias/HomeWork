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

$.ajax({
    url: '/category/list',
    type: 'get',
    dataType: 'json'
}).done(function (data) {
    buildMenu(data);
    $.ajax({
        url: 'category/1'
    })
});