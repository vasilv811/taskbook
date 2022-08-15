// Выводит на экран общее кол-во страниц + (admin (true, false) просто в массиве не выводится)
paginationStart()
// Выводит на экран страницу 3 задачи на первой странице
paginations()
// Не помню что хотел сделать
// $('#outputAdmin1').on("click", function () {
//     window.location.reload()
// })
// Выводит на экран нужную страницу при выборе
$('ul').on("click", "#page", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    $.ajax({
        url: '/pagination/get',
        type: 'POST',
        cache: false,
        data: {'page': page},
        dataType: 'json',
        success: function (dataMes) {
            var dataMesAdmin = ''
            dataMesAdmin = dataMes[0]
            dataMesAdmin = dataMesAdmin.admin
            dataMes = dataMes[0]
            delete dataMes.admin
            dataMes = Object.values(dataMes)
            var dataMessage = ''
            if (dataMesAdmin === false) {
                dataMessage = users(dataMes)
            } else {
                dataMessage = admin(dataMes)
            }
            $('#task').html(dataMessage)
        }
    })
})

// Выводит на экран нужную страницу при выборе (сортировка по Email)
$('ul').on("click", "#pageEmail", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    let emailId = $(this).attr('data-id')
    // console.log(emailId)
    $.ajax({
        url: '/paginationemailpage/get',
        type: 'POST',
        cache: false,
        data: {'page': page, 'email': emailId},
        dataType: 'json',
        success: function (dataMes) {
            console.log(dataMes)
            var dataMesAdmin = ''
            dataMesAdmin = dataMes[0]
            dataMesAdmin = dataMesAdmin.admin
            dataMes = dataMes[0]
            delete dataMes.admin
            dataMes = Object.values(dataMes)
            var dataMessage = ''
            if (dataMesAdmin === false) {
                dataMessage = users(dataMes)
            } else {
                dataMessage = admin(dataMes)
            }
            $('#task').html(dataMessage)
        }
    })
})

// Выводит на экран нужную страницу при выборе (сортировка по пользователя)
$('ul').on("click", "#pageUser", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    let userId = $(this).attr('data-id')
    // console.log(emailId)
    $.ajax({
        url: '/paginationuserpage/get',
        type: 'POST',
        cache: false,
        data: {'page': page, 'userId': userId},
        dataType: 'json',
        success: function (dataMes) {
            console.log(dataMes)
            var dataMesAdmin = ''
            dataMesAdmin = dataMes[0]
            dataMesAdmin = dataMesAdmin.admin
            dataMes = dataMes[0]
            delete dataMes.admin
            dataMes = Object.values(dataMes)
            var dataMessage = ''
            if (dataMesAdmin === false) {
                dataMessage = users(dataMes)
            } else {
                dataMessage = admin(dataMes)
            }
            $('#task').html(dataMessage)
        }
    })
})

// Выводит на экран нужную страницу при выборе (сортировка по выполненным задачам)
$('ul').on("click", "#pageStatusFinished", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    // let status = $(this).attr('data-id')
    // console.log(emailId)
    $.ajax({
        url: '/paginationstatusfinishedpage/get',
        type: 'POST',
        cache: false,
        data: {'page': page},
        dataType: 'json',
        success: function (dataMes) {
            console.log(dataMes)
            var dataMesAdmin = ''
            dataMesAdmin = dataMes[0]
            dataMesAdmin = dataMesAdmin.admin
            dataMes = dataMes[0]
            delete dataMes.count
            delete dataMes.admin
            dataMes = Object.values(dataMes)
            var dataMessage = ''
            if (dataMesAdmin === false) {
                dataMessage = users(dataMes)
            } else {
                dataMessage = admin(dataMes)
            }
            $('#task').html(dataMessage)
        }
    })
})

// Выводит на экран нужную страницу при выборе (сортировка по невыполненным задачам)
$('ul').on("click", "#npageStatusNonFinished", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    // let status = $(this).attr('data-id')
    // console.log(emailId)
    $.ajax({
        url: '/paginationstatusnonfinishedpage/get',
        type: 'POST',
        cache: false,
        data: {'page': page},
        dataType: 'json',
        success: function (dataMes) {
            console.log(dataMes)
            var dataMesAdmin = ''
            dataMesAdmin = dataMes[0]
            dataMesAdmin = dataMesAdmin.admin
            dataMes = dataMes[0]
            delete dataMes.count
            delete dataMes.admin
            dataMes = Object.values(dataMes)
            var dataMessage = ''
            if (dataMesAdmin === false) {
                dataMessage = users(dataMes)
            } else {
                dataMessage = admin(dataMes)
            }
            $('#task').html(dataMessage)
        }
    })
})

//Вывод на экран задачи для пользователя или для админа
$("#addTask").on("click", function () {
    $.ajax({
        url: '/adminstatus/check',
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.admin === true) {
                taskShowAdmin()
            } else {
                taskShowUser()
            }
        }
    })
})

// Выводит на экран форму для создания задачи для админа
function taskShowAdmin() {
    $("#formTask").slideDown('fast');
    $('#nameSet').val('')
    $('#emailSet').val('')
    $('#taskSet').val('')
    $('#send').empty().html('<button id="sendTask" class="btn btn-primary" type="button">Создать задачу</button>' +
        '<button id="closeTaskButton" class="btn btn-primary ms-4" type="button">Cкрыть форму</button>' +
        '<input class="ms-4" type="checkbox" id="checkbox"> Статус задачи')
}

// Выводит на экран форму для создания задачи для пользователя
function taskShowUser() {

    $("#formTask").slideDown('fast');
    $('#nameSet').val('')
    $('#emailSet').val('')
    $('#taskSet').val('')
    $('#send').empty().html('<button id="sendTask" class="btn btn-primary" type="button">Создать задачу</button>' +
        '<button id="closeTaskButton" class="btn btn-primary ms-4" type="button">Cкрыть форму</button>' +
        '<input class="ms-4" type="checkbox" id="checkbox"> Статус задачи'
    )
}

// Выводит на экран форму для сортировки по имени пользователя
$("#inputUserSort").on("click", function () {
    $("#formUserSort").slideToggle('fast')
})

// Выводит на экран форму для сортировки по Email
$("#inputEmailSort").on("click", function () {
    $("#formEmailSort").slideToggle('fast')
})

// Выводит на экран форму для входа администротора
$("#inputAdmin").on("click", function () {
    $("#formAdmin").slideToggle('fast')
})
// Отправляет значения формы с заданиями на сервер
$("#send").on("click", "#sendTask", function () {
    var status = ''
    var userSet = $("#nameSet").val()
    var emailSet = $("#emailSet").val()
    var taskSet = $("#taskSet").val()
    if ($("#checkbox").is(":checked")) {
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
        url: '/message/set',
        type: 'POST',
        cache: false,
        data: {'email': emailSet, 'user': userSet, 'task': taskSet, 'status': status},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            $('.page-item').hide()
            paginationStart()
            paginations()
            if (data['success']) {
                $('#success').html(data['success']).show('fast')
                setTimeout(function() {$('#success').html(data.success).hide('fast');}, 3000)
            }
        }
    })
})

// Отправляет значения формы администратора на сервер
$("#sendAdmin").on("click", function () {
    var loginCheck = $("#loginCheck").val()
    var passwordCheck = $("#passwordCheck").val()
    if (!isNaneValidate(loginCheck)) {
        $('#loginCheck').removeClass('form-control').addClass('form-control is-invalid')
        $('#errorLogin').html('Login введен некорректно!')
        return
    } else {
        $('#loginCheck').removeClass('form-control is-invalid').addClass('form-control')
    }
    if (!isPasswordValidate(passwordCheck)) {
        $('#passwordCheck').removeClass('form-control').addClass('form-control is-invalid')
        $('#errorPassword').html('Password введен некорректно!')
        return
    } else {
        $('#passwordCheck').removeClass('form-control is-invalid').addClass('form-control')
    }
    $.ajax({
        url: '/admin/check',
        type: 'POST',
        cache: false,
        data: {'login': loginCheck, 'password': passwordCheck},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            $('.page-item').hide()
            paginationStart()
            paginations()
            if (data.success) {
                $('#successAdmin').html(data.success).show('fast')
                setTimeout(function() {$('#successAdmin').html(data.success).hide('fast');}, 3000)
            }
        }
    })
})

// Сортировка по имени пользователя
$("#sendUserSort").on("click", function () {
    var user = $("#formUserSortCheck").val()
    if (!isNaneValidate(user)) {
        $('#formUserSortCheck').removeClass('form-control').addClass('form-control is-invalid')
        $('#formUserSortErrorLogin').html('Login введен некорректно!')
        return
    } else {
        $('#formUserSortErrorLogin').removeClass('form-control is-invalid').addClass('form-control')
    }
    paginationsUsers(user)
})

// Сортировка про Email
$("#sendEmailSorts").on("click", function () {
    var email = $("#formEmailSortCheck").val()
    if (!isEmailValidate(email)) {
        $('#formEmailSortCheck').removeClass('form-control').addClass('form-control is-invalid')
        $('#formUserSortEmailLogin').html('Email введен некорректно!')
        return
    } else {
        $('#formEmailSortErrorLogin').removeClass('form-control is-invalid').addClass('form-control')
    }
    paginationsEmail(email)
})

// Выводитт на экран выполненные задичи
$("#inputCompletedTasks").on("click", function () {
    paginationsComleteTask()
})

// Выводитт на экран не выполненные задичи
$("#inputTasksNotCompleted").on("click", function () {
    paginationsNotComleteTask()
})

// Выход из аккаунта admin
$("#outputAdmin").on("click", function () {
    $.ajax({
        url: '/admin/output',
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function (data) {
            $('.page-item').hide()
            paginationStart()
            paginations()
            if (data.success) {
                $('#successAdminOutput').html(data.success).show('fast')
                setTimeout(function() {$('#successAdminOutput').html(data.success).hide('fast');}, 3000)
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

// Выводит на экран 3 задачи на первой странице
function paginations() {
    $.ajax({
        url: '/pagination/get',
        type: 'POST',
        cache: false,
        data: {'page': 1},
        dataType: 'json',
        success: function (dataMes) {
            var dataMesAdmin = ''
            dataMesAdmin = dataMes[0]
            dataMesAdmin = dataMesAdmin.admin
            dataMes = dataMes[0]
            delete dataMes.admin
            dataMes = Object.values(dataMes)
            var dataMessage = ''
            if (dataMesAdmin === false) {
                dataMessage = users(dataMes)
            } else {
                dataMessage = admin(dataMes)
            }
            $('#task').html(dataMessage)
        }

    })
}

// Выводит на экран 3 задачи на первой странице при сортировке пользователей
function paginationsUsers($user) {
    $.ajax({
        url: '/paginationusers/get',
        type: 'POST',
        cache: false,
        data: {'page': 1, 'user': $user},
        dataType: 'json',
        success: function (data) {
            var countPage = ''
            countPage = data[0]
            countPage = countPage.count
            var dataUser = ''
            dataUser = data[0]
            dataUser = dataUser.admin
            var userId = ''
            userId = data[0]
            userId = userId[0]
            userId = userId.users_id
            data = data[0]
            delete data.count
            delete data.admin
            data = Object.values(data)
            var countP = Math.ceil(countPage / 3)
            var paginations = ''
            let i = 1;
            while (i <= countP) {
                paginations +=
                    '<li class="page-item">' +
                    '<a id="pageUser" data-id="'+userId+'" class="page-link" href=' + i + '>' +
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

// Выводит на экран 3 задачи на первой странице при сортировке выполнения (выполнено)
function paginationsComleteTask() {
    $.ajax({
        url: '/paginationucomplete/get',
        type: 'POST',
        cache: false,
        data: {'page': 1},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            var countPage = ''
            countPage = data[0]
            countPage = countPage.count
            console.log(countPage)
            var dataUser = ''
            dataUser = data[0]
            dataUser = dataUser.admin
            data = data[0]
            delete data.count
            delete data.admin
            data = Object.values(data)
            var countP = Math.ceil(countPage / 3)
            console.log(countP)
            var paginations = ''
            let i = 1;
            while (i <= countP) {
                paginations +=
                    '<li class="page-item">' +
                    '<a id="pageStatusFinished" class="page-link" href=' + i + '>' +
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

// Выводит на экран 3 задачи на первой странице при сортировке выполнения (не выполнено)
function paginationsNotComleteTask() {
    $.ajax({
        url: '/paginationnotcomplete/get',
        type: 'POST',
        cache: false,
        data: {'page': 1},
        dataType: 'json',
        success: function (data) {
            var countPage = ''
            countPage = data[0]
            countPage = countPage.count
            var dataUser = ''
            dataUser = data[0]
            dataUser = dataUser.admin
            data = data[0]
            delete data.count
            delete data.admin
            data = Object.values(data)
            var countP = Math.ceil(countPage / 3)
            var paginations = ''
            let i = 1;
            while (i <= countP) {
                paginations +=
                    '<li class="page-item">' +
                    '<a id="npageStatusNonFinished" class="page-link" href=' + i + '>' +
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

// Выводит на экран 3 задачи на первой странице при сортировке Email
function paginationsEmail($email) {
    $.ajax({
        url: '/paginationemail/get',
        type: 'POST',
        cache: false,
        data: {'page': 1, 'email': $email},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            var countPage = ''
            countPage = data[0]
            countPage = countPage.count
            var dataEmail = ''
            dataEmail = data[0]
            dataEmail = dataEmail.email
            var emailId = ''
            emailId = data[0]
            emailId = emailId[0]
            emailId = emailId.email_id
            console.log(emailId)
            data = data[0]
            delete data.count
            delete data.admin
            data = Object.values(data)
            var countP = Math.ceil(countPage / 3)
            var paginations = ''
            let i = 1;
            while (i <= countP) {
                paginations +=
                    '<li class="page-item">' +
                    '<a id="pageEmail" data-id="'+emailId+'" class="page-link" href=' + i + '>' +
                    i +
                    '</a>' +
                    '</li>'
                i++
            }
            $('.page-item').hide()
            $('#pagination').after(paginations)

            var dataMessage = ''
            if (dataEmail === false) {
                dataMessage = users(data)
            } else {
                dataMessage = admin(data)
            }
            $('#task').html(dataMessage)
        }

    })
}

// Выводит на экран общее кол-во страниц
function paginationStart() {
    $.ajax({
        url: '/paginationcount/get',
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function (data) {
            dateName = data[0]
            var dataPag = data[0];
            var countPage = Math.ceil(dataPag[0] / 3)
            var paginations = ''
            let i = 1;
            while (i <= countPage) {
                paginations +=
                    '<li class="page-item">' +
                    '<a id="page" class="page-link" href=' + i + '>' +
                    i +
                    '</a>' +
                    '</li>'
                i++
            }
            $('#pagination').after(paginations)
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
            console.log(data)
            if (data['success']) {
                $('#success').html(data['success']).show('fast')
            }
        }

    })
})


$('#send').on('click', '#changeTask', function (e) {
    e.preventDefault()
})

$('#send').on('click', '#closeTaskButton', function () {
    $('#formTask').slideUp('fast')
})


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