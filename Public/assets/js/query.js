// Выводит на экран общее кол-во страниц + (admin (true, false) просто в массиве не выводится)
paginationStart()
// Выводит на экран страницу 3 задачи на первой странице
paginations()
// Не помню что хотел сделать
$('#outputAdmin1').on("click",  function () {
    window.location.reload()
})
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
        success: function (dataName1) {
            console.log(dataName1)
            console.log(page)
            var dataMessage = ''
            for (var v of dataName1) {
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
                    '<div class="align-content-end">' + 'jjj' + '</div>' +
                    '<h6>Дата:&nbsp;</h6>' +
                    '<h6><strong>Имя: </strong>' + v.name + '</h6>' +
                    '<h6><strong>Email: </strong>' + v.email + '</h6>' +
                    '<h6><strong>Задача: </strong>' + v.task + '</h6>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
            }
            console.log(dataMessage)
            $('#task').html(dataMessage)
        }
    })
})
// Выводит на экран форму для создания задачи
$("#addTask").on("click", function () {
    $("#formTask").slideDown('fast');
    $('#nameSet').val('')
    $('#emailSet').val('')
    $('#taskSet').val('')
    $('#send').empty().html('<button id="sendTask" class="btn btn-primary" type="button">Создать задачу</button>' +
        '<button id="closeTaskButton" class="btn btn-primary ms-4" type="button">Cкрыть форму</button>')
})
// Выводит на экран форму для входа администротора
$("#inputAdmin").on("click", function () {
    $("#formAdmin").slideToggle('fast')
})
// Отправляет значения формы с заданиями на сервер
$("#sendTask").on("click", function () {
    var nameSet = $("#nameSet").val()
    var emailSet = $("#emailSet").val()
    var taskSet = $("#taskSet").val()
    if (!isNaneValidate(nameSet)) {
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
        data: {'email': emailSet, 'name': nameSet, 'task': taskSet},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            if (data['success']) {
                $('#success').html(data['success']).show('fast')
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
            if (data['success']) {

                $('#success').html(data['success']).show('fast')
            }
        }

    })
})
// Выход из аккаунта admin
$("#outputAdmin").on("click", function () {
    $.ajax({
        url: '/admin/output',
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function (data) {
            console.log(data)
        }

    })
})
// Возвращает html задачи для всех пользователей
function users(data){
    var dataMessage = ''
    for (var v of data) {
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
            '<h6>Дата:&nbsp;</h6>' +
            '<h6><strong>Имя: </strong>' + v.name + '</h6>' +
            '<h6><strong>Email: </strong>' + v.email + '</h6>' +
            '<h6><strong>Задача: </strong>' + v.task + '</h6>' +
            '</div>' +
            '</div>' +
            '</div>'
    }
    console.log(dataMessage)
    return dataMessage
}
// Возвращает html задачи для admin
function admin(data){
    console.log(data)
    dataMessage = ''
    for (var v of data) {
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
            '<button data-id="'+ v.task_id +'" class="btn btn-primary js-edit-task-button" type="button">'+v.task_id+' Button</button>'+
            '<h6>Дата:&nbsp;</h6>' +
            '<h6><strong>Имя: </strong>' + v.name + '</h6>' +
            '<h6><strong>Email: </strong>' + v.email + '</h6>' +
            '<h6><strong>Задача: </strong>' + v.task + '</h6>' +
            '</div>' +
            '</div>' +
            '</div>'
    }
    return dataMessage
}
// Выводит на экран страницу 3 задачи на первой странице
function paginations(){
    $.ajax({
        url: '/pagination/get',
        type: 'POST',
        cache: false,
        data: {'page': 1},
        dataType: 'json',
        success: function (dataMes) {
            console.log(dataMes)
            dataMes = dataMes[0]
            var dataMessage = ''
            if (requestAdmin() === false){
                dataMessage = users(dataMes)
            }else{
                dataMessage = admin(dataMes)
            }
            $('#task').html(dataMessage)
        }

    })
}
// Выводит на экран общее кол-во страниц + (admin (true, false) просто в массиве не выводится)
function paginationStart(){
    $.ajax({
        url: '/paginationCount/get',
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function (dataName) {
            dateName = dataName[0]
            console.log(dataName[0])
            var dataPag = dataName[0];
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
            console.log(paginations)
            $('#pagination').after(paginations)
        }
    })
}
// Возвращает значение admin (true, false)
function requestAdmin(){
    $.ajax({
        url: '/requestAdmin/get',
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function (data) {
            admin = data[0]
        }
    })
return admin.admin
}
// Получаем все поля и заполняем ими форму
$('#task').on('click', ':button', function (){
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
                $('#emailSet').val(data.email)
                $('#taskSet').val(data.task)
                $('#send').empty().html('<button id="changeTask" class="btn btn-primary" type="button">Изменить задачу</button>' +
                    '<button id="closeTaskButton" class="btn btn-primary ms-4" type="button">Cкрыть форму</button>')
        }
    })
})

$('#send').on('click', '#changeTask', function (){
    console.log('привет')
})

$('#send').on('click', '#closeTaskButton', function (){
    $('#formTask').slideUp('fast')
})

//         $('#error').html('Email введен некорректно!').show('fast')
//         $('#success').hide()
//         $('#phones').hide()
//         return
//     }
//     if (!isPhoneValidate(phone)) {
//         $('#error').html('Телефон введен некорректно!').show('fast')
//         $('#success').hide()
//         $('#phones').hide()
//         return
//     }
//     ajax(url, emailSet, phone)
// })
//
// $("#sendGet").on("click", function () {
//     var emailGet = $("#emailGet").val()
//     var url = '/contacts/get'
//     if (!isEmailValidate(emailGet)) {
//         $('#error').html('Email введен некорректно!').show('fast')
//         $('#success').hide()
//         $('#phones').hide()
//         return
//     }
//     ajax(url, emailGet)
// })
//

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


//
// function ajax(url, email, phone) {
//     if (phone === undefined) phone = false
//     $.ajax({
//         url: url,
//         type: 'POST',
//         cache: false,
//         data: {'email': email, 'phone': phone},
//         dataType: 'json',
//         success: function (data) {
//             console.log(data)
//         }
//     })
// }



