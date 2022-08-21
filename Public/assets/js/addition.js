//
function getPage(pageId, url, page, filter, name, emailAddress){
    if (page === undefined){page = 1}
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data: {'page': page, 'filter': filter, 'name': name, 'emailAddress': emailAddress},
        dataType: 'json',
        success: function (data) {
            var countPage = ''
            countPage = data[0]
            countPage = countPage.count
            var dataUser = ''
            dataUser = data[0]
            dataUser = dataUser.admin
            var filterUserEmail = ''
            filterUserEmail = data[0]
            filterUserEmail = filterUserEmail.filterUserEmail
            if (filterUserEmail === undefined){filterUserEmail = ''}
            data = data[0]
            delete data.count
            delete data.admin
            delete data.filterUserEmail
            data = Object.values(data)
            var dataId = ''
            if (filterUserEmail === 'user'){
                dataId = data[0]
                dataId = dataId.name
            }
            if (filterUserEmail === 'email'){
                dataId = data[0]
                dataId = dataId.address
            }
            var countP = Math.ceil(countPage / 3)
            var paginations = ''
            let i = 1;
            while (i <= countP) {
                paginations +=
                    '<li class="page-item">' +
                    '<a id="'+pageId+ '" data-id="'+dataId+'" class="page-link" href=' + i + '>' +
                    i +
                    '</a>' +
                    '</li>'
                i++
            }
            $('.page-item').hide()
            $('#pagination').after(paginations)

            var dataMessage = ''
            if (dataUser === false) {
                dataMessage = users(data)
            } else {
                dataMessage = admin(data)
            }
            $('#task').html(dataMessage)
        }
    })
}

// Получаем все поля и заполняем ими форму
$('#task').on('click', ':button', function () {
    var taskId = $(this).attr('data-id')
    $.ajax({
        url: '/mesagebytaskid/get',
        type: 'POST',
        cache: false,
        data: {'task_id': taskId},
        dataType: 'json',
        success: function (data) {
            $("#formTask").slideDown('fast');
            $('#nameSet').val(data.name)
            $('#emailSet').val(data.address)
            $('#taskSet').val(data.text)
            $('#send').empty().html('<button id="changeTask" class="btn btn-primary" type="button" data-id="' + data.task_id + '&' + data.users_id + '&' + data.email_id + '">Изменить задачу</button>' +
                '<button id="closeTaskButton" class="btn btn-primary ms-4" type="button">Cкрыть форму</button>' +
                '<input class="ms-4" type="checkbox" id="checkbox"> Статус задачи')
            if (data.status === 'nonFinished') {
                $("#checkbox").prop('checked', false)
            } else {
                $("#checkbox").prop('checked', true)
            }
        }
    })
})

// Отправляет значения формы с заданиями на сервер для администратора
$("#send").on("click", "#changeTask", function () {
    var status = ''
    var userSet = $("#nameSet").val()
    var emailSet = $("#emailSet").val()
    var taskSet = $("#taskSet").val()
    var id = $(this).attr('data-id')
    if ($('#checkbox').is(':checked')) {
        status = 'finished'
    } else {
        status = 'nonFinished'
    }
    if (!isNaneValidate(userSet)) {
        $('#nameSet').removeClass('form-control').addClass('form-control is-invalid')
        $('#errorName').html('Имя введено некорректно!')
        return
    } else {
        $('#nameSet').removeClass('form-control is-invalid').addClass('form-control')
    }
    if (!isEmailValidate(emailSet)) {
        $('#emailSet').removeClass('form-control').addClass('form-control is-invalid')
        $('#errorEmail').html('Email введен некорректно!')
        return
    } else {
        $('#emailSet').removeClass('form-control is-invalid').addClass('form-control')
    }
    if (!taskSet) {
        $('#taskSet').removeClass('form-control').addClass('form-control is-invalid')
        $('#errorTextarea').html('Напишите текст задачи')
    } else {
        $('#taskSet').removeClass('form-control is-invalid').addClass('form-control')
    }
    $.ajax({
        url: '/chengemessage/set',
        type: 'POST',
        cache: false,
        data: {'email': emailSet, 'user': userSet, 'text': taskSet, 'status': status, 'id': id},
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                $('#success').html(data['success']).show('fast')
            }
        }

    })
})

// Возвращает html задачи для всех пользователей
function users(data) {
    var dataMessage = ''
    for (var v of data) {
        var status = ''
        if (v.status === "nonFinished") {
            status +=
                '<span class="badge rounded-pill bg-primary mb-2 ms-4">' +
                '<span style="font-weight: normal !important;">' +
                'Задача не выполнена  ' +
                '</span>' +
                '</span>'
        } else {
            status +=
                '<span class="badge rounded-pill bg-primary mb-2 ms-4">' +
                '<span style="font-weight: normal !important;">' +
                'Задача выполнена ' +
                '</span>' +
                '</span>'
        }
        dataMessage +=
            '<div class="mt-3 border rounded-2">' +
            '<div class="col">' +
            '<div class="p-4">' +
            '<span class="badge rounded-pill bg-primary mb-2">' +
            '<span style="font-weight: normal !important;">' +
            'Задача №  ' +
            v.task_id +
            '</span>' +
            '</span>' +
            status +
            '<h6><strong>Имя: </strong>' + v.name + '</h6>' +
            '<h6><strong>Email: </strong>' + v.address + '</h6>' +
            '<h6><strong>Задача: </strong>' + v.text + '</h6>' +
            '</div>' +
            '</div>' +
            '</div>'
    }
    return dataMessage
}

// Возвращает html задачи для admin
function admin(data) {
    dataMessage = ''
    for (var v of data) {
        var status = ''
        if (v.status === "nonFinished") {
            status +=
                '<span class="badge rounded-pill bg-primary mb-2 ms-4">' +
                '<span style="font-weight: normal !important;">' +
                'Задача не выполнена  ' +
                '</span>' +
                '</span>'
        } else {
            status +=
                '<span class="badge rounded-pill bg-primary mb-2 ms-4">' +
                '<span style="font-weight: normal !important;">' +
                'Задача выполнена ' +
                '</span>' +
                '</span>'
        }
        dataMessage +=
            '<div class="mt-3 border rounded-2">' +
            '<div class="col">' +
            '<div class="p-4">' +
            '<span class="badge rounded-pill bg-primary mb-2">' +
            '<span style="font-weight: normal !important;">' +
            'Задача №  ' +
            v.task_id +
            '</span>' +
            '</span>' +
            '<button data-id="' + v.task_id + '" class="badge rounded-pill bg-primary mb-2 js-edit-task-button ms-4" type="button"> Изменить задачу</button>' +
            status +
            '<h6><strong>Имя: </strong>' + v.name + '</h6>' +
            '<h6><strong>Email: </strong>' + v.address + '</h6>' +
            '<h6><strong>Задача: </strong>' + v.text + '</h6>' +
            '</div>' +
            '</div>' +
            '</div>'
    }
    return dataMessage
}

// Валидация Email
function isEmailValidate(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

// Валидация имени
function isNaneValidate(name) {
    var regex = /[A-Za-zА-Яа-яЁё]{2,}/;
    return regex.test(name);
}

// Валидация пароля
function isPasswordValidate(pass) {
    var regex = /[a-zA-Z0-9_.+-]{3,}/;
    return regex.test(pass);
}