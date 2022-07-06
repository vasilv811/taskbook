$.ajax({
    url: '/name/get',
    type: 'POST',
    cache: false,
    dataType: 'json',
    success: function (dataName) {
        console.log(dataName)
    }
    })

$.ajax({
    url: '/message/get',
    type: 'POST',
    cache: false,
    dataType: 'json',
    success: function (dataMes) {
        console.log(dataMes)
        var dataMessage = ''
        for (var v of dataMes) {
            dataMessage += '<div className="col">' +
                '<div className="p-4">' +
                '<span className="badge rounded-pill bg-primary mb-2">' +
                '<span style="font-weight: normal !important;">' +
                'Задача №  ' +
                v.task_id +
                '</span>' +
                '</span>' +
                '<h6>Дата:&nbsp;</h6>' +
                '<h6><strong>Имя: </strong></h6>' +
                v.name+
                '<h6>email:</h6>' +
                '<p>' +
                v.task +
                '</p>' +
                '</div>' +
                '</div>'
        }
        console.log(dataMessage)

        $('#task').html(dataMessage)
    }

})


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


function isEmailValidate(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isNaneValidate(name) {
    var regex = /[A-Za-zА-Яа-яЁё]{2,}/;
    return regex.test(name);
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



