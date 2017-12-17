$(function () {
    $('#link-vk').addClass('active');
});

const getImage = (data) => {
    if (typeof data[1].attachment !== 'undefined' && data[1].attachment.type === 'photo') {
        return `<div class="col-2"><img src="${data[1].attachment.photo.src}"></div>`;
    }
    return '';
};

const formLastRecord = (data) => {
    console.log(data);
    return `
        <div class="card">
            <div class="card-header"><h4>Последняя запись со стены</h4></div>
            <div class="card-body">
                <div class="row">
                    ${getImage(data)}
                    <div class="col d-flex flex-column"> 
                        <span>Текст записи:</span>
                        <span>${data[1].text}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
};

$(document).on('click', '#wall-post', function () {
    let data = new FormData($('form')[0]);
    if (data.get('postPhoto').name.length > 0 || data.get('postText').length > 0) {
        VK.Auth.login(function (response) {
            if (response.session) {
                if (data.get('postPhoto').name.length > 0) {
                    VK.api('photos.getWallUploadServer', {},
                        function (response) {
                            if (response) {
                                let url = response.response.upload_url;
                                data.append('url', url);
                                $.ajax({
                                    url: '/upload',
                                    type: 'post',
                                    dataType: 'json',
                                    data: data,
                                    processData: false,  // tell jQuery not to process the data
                                    contentType: false
                                })
                                    .done(function (response) {
                                        if (response) {
                                            VK.Api.call('photos.saveWallPhoto', {
                                                photo: response.photo,
                                                server: response.server,
                                                hash: response.hash
                                            }, function (r) {

                                                VK.Api.call('wall.post', {
                                                    message: data.get('postText'),
                                                    attachments: r.response[0].id
                                                }, function (r) {
                                                    if (r.response) {
                                                        alert('Успех');
                                                    }
                                                });
                                            });
                                        }
                                    }).fail(function () {
                                    alert('assad');
                                });
                            }
                        });
                } else {
                    VK.Api.call('wall.post', {
                        message: data.get('postText')
                    }, function (r) {
                        if (r.response) {
                            alert('Успех');
                        }
                    });
                }
            }
        }, 8196);
    } else {
        alert('Введите текст или загрузите изображение');
    }
})
    .on('click', '#wall-get', function (event) {
        VK.Auth.login(function (response) {
            if (response.session) {
                VK.api('wall.get',
                    {count: 1},
                    function (r) {
                        if (r) {
                            $('#last-record').html(formLastRecord(r.response));
                        }
                    }
                )
            }
        }, 8196);
    })
    .on('click', '#last-record-php', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $.ajax({
            url: '/admin/vk/wall',
            type: 'get',
            dataType: 'json'
        }).done(function (r) {
            console.log(r);
            $('#last-record').html(formLastRecord(r.response));
        })
    });