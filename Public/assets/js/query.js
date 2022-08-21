// Выводит на экран общее кол-во страниц
getPage('page', '/paginations/get', 1);
// Выводит на экран нужную страницу при выборе
$('ul').on("click", "#page", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    getPage('page', '/paginations/get', page)
})

// Выводит на экран нужную страницу при выборе (сортировка по Email)
$('ul').on("click", "#pageEmail", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    let email = $(this).attr('data-id')
    getPage('pageUser', '/paginations/get', page, '', '', email)
})

// Выводит на экран нужную страницу при выборе (сортировка по пользователя)
$('ul').on("click", "#pageUser", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    let user = $(this).attr('data-id')
    getPage('pageUser', '/paginations/get', page, '', user)
})

// Выводит на экран нужную страницу при выборе (сортировка по выполненным задачам)
$('ul').on("click", "#pageStatusFinished", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    getPage('pageStatusFinished','/paginations/get', page, 'completedTask')
})

// Выводит на экран нужную страницу при выборе (сортировка по невыполненным задачам)
$('ul').on("click", "#npageStatusNonFinished", function (e) {
    e.preventDefault()
    let page = $(this).attr('href')
    getPage('npageStatusNonFinished','/paginations/get', page, 'nonCompleteTask')
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
        '<button id="closeTaskButton" class="btn btn-primary ms-4" type="button">Cкрыть форму</button>'
        // '<input class="ms-4" type="checkbox" id="checkbox"> Статус задачи'
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
            $('.page-item').hide()
            getPage('page', '/paginations/get', 1);
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
            $('.page-item').hide()
            getPage('page', '/paginations/get', 1);
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
    getPage('pageUser', '/paginations/get', 1, '',user)

    // paginationsUsers(user)
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
    getPage('pageEmail', '/paginations/get', 1, '','',email)
    // paginationsEmail(email)
})

// Выводитт на экран выполненные задичи
$("#inputCompletedTasks").on("click", function () {
    getPage('pageStatusFinished','/paginations/get',1, 'completedTask')
    // paginationsComleteTask()
})

// Выводитт на экран не выполненные задичи
$("#inputTasksNotCompleted").on("click", function () {
    getPage('npageStatusNonFinished','/paginations/get',1, 'nonCompletedTask')
    // paginationsNotComleteTask()
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
            getPage('page', '/paginations/get', 1);
            if (data.success) {
                $('#successAdminOutput').html(data.success).show('fast')
                setTimeout(function() {$('#successAdminOutput').html(data.success).hide('fast');}, 3000)
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
