<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>taskBook</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/Articles-Badges.css">
    <link rel="stylesheet" href="/public/assets/css/Login-Form-Basic.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <form class="container-fluid justify-content-start">
                <button id="addTask" class="btn btn-primary me-2" type="button">Добавить задачу</button>
                <button id="inputAdmin" class="btn btn-primary me-2" type="button">Войти как администратор</button>
                <button id="outputAdmin" class="btn btn-primary" type="button">Выйти</button>
                <button id="outputAdmin1" class="btn btn-primary" type="button">Войти</button>
            </form>
        </nav>

        <form id="formTask" class="row justify-content-md-center" style="display: none">
            <div class="col-6">
                <label for="validationServer01" class="form-label">Введите имя</label>
                <input type="text" class="form-control" id="nameSet" name="nameSet" required>
                <div class="invalid-feedback" id="errorName">
                </div>
            </div>
            <div class="col-6">
                <label for="validationServer02" class="form-label">Введите Email</label>
                <input type="email" class="form-control" id="emailSet" name="emailSet" required>
                <div class="invalid-feedback" id="errorEmail">
                </div>
            </div>
            <div class="mb-3">
                <label for="validationTextarea" class="form-label">Задача</label>
                <textarea class="form-control" id="taskSet" required></textarea>
                <div class="invalid-feedback" id="errorTextarea">
                </div>
            </div>
            <div class="col-12" id="send">
            </div>
            <div class="mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <div id="success" class="alert alert-success" style="display: none">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form id="formAdmin" class="row justify-content-md-center" style="display: none">
            <div class="col-6">
                <label for="validationServer01" class="form-label">Login</label>
                <input type="text" class="form-control" id="loginCheck" name="loginCheck" required>
                <div class="invalid-feedback" id="errorLogin">
                </div>
            </div>
            <div class="col-6">
                <label for="validationServer02" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" required>
                <div class="invalid-feedback" id="errorPassword">
                </div>
            </div>
            <div class="col-12 mt-3">
                <button id="sendAdmin" class="btn btn-primary" type="button">Send</button>
            </div>
            <div class="mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <div id="success" class="alert alert-success" style="display: none">
                        </div>
                    </div>
                </div>
            </div>
        </form>

<div class="container">
    <div class="row">

    <div class="row">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>Приложение задачник</h2>
<!--            <p class="w-lg-50">Добавить задачу</p>-->
        </div>
    </div>
    <div id="task">

        </div>
        </div>

        <ul id="pag" class="mt-5 pagination justify-content-center">
            <li id="pagination" class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>


    </div>

<script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/public/assets/js/jquery-3.6.0.min.js"></script>
<script src="/public/assets/js/jscrypt.js"></script>
<script src="/public/assets/js/query.js"></script>
</body>

</html>