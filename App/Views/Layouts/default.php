<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>taskBook</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/Articles-Badges.css">
    <link rel="stylesheet" href="/assets/css/Login-Form-Basic.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>



    <div class="container">



        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md- col-xl- px-sm-2 px-0 bg-darkus">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Menu</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline" id="addTask">Добавить задачу</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline" id="inputAdmin">Войти как администратор</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline" id="outputAdmin">Выйти из администратора</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline" id="inputUserSort">Сортировка по имени пользователя</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline" id="inputEmailSort">Сортировка по Email</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline" id="inputCompletedTasks">Выполненные задания</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline" id="inputTasksNotCompleted">Не выполненные задания</span>
                                </a>
                            </li>



                        </ul>


                    </div>
                </div>
                <div class="col py-3">
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

                    <form id="formUserSort" class="row justify-content-md-center" style="display: none">
                        <div class="col-12">
                            <label for="validationServer01" class="form-label">Введите имя</label>
                            <input type="text" class="form-control" id="formUserSortCheck" name="formUserSortCheck" required>
                            <div class="invalid-feedback" id="formUserSortErrorLogin">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button id="sendEmailSort" class="btn btn-primary" type="button">Send</button>
                        </div>
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="success" class="alert alert-success" style="display: none">
                                    </div>
                                </div>
                            </div>git
                        </div>
                    </form>

                    <form id="formEmailSort" class="row justify-content-md-center" style="display: none">
                        <div class="col-12">
                            <label for="validationServer01" class="form-label">Введите Email</label>
                            <input type="text" class="form-control" id="formEmailSortCheck" name="formUserEmailCheck" required>
                            <div class="invalid-feedback" id="formUserSortEmailLogin">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button id="sendEmailSorts" class="btn btn-primary" type="button">Send</button>
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
                                <!--                <a class="page-link" href="#" aria-label="Previous">-->
                                <!--                    <span aria-hidden="true">&laquo;</span-->
                                <!--                </a>-->
                            </li>
                            <li class="page-item">
                                <!--                <a class="page-link" href="#" aria-label="Next">-->
                                <!--                    <span aria-hidden="true">&raquo;</span>-->
                                <!--                </a-->
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>




<!--        <nav class="navbar navbar-light bg-light">-->
<!--            <form class="container-fluid justify-content-start">-->
<!--                <button id="addTask" class="btn btn-primary me-2" type="button">Добавить задачу</button>-->
<!--                <button id="inputAdmin" class="btn btn-primary me-2" type="button">Войти как администратор</button>-->
<!--                <button id="outputAdmin" class="btn btn-primary me-2" type="button">Выйти из администратора</button>-->
<!--                <button id="inputUserSort" class="btn btn-primary me-2" type="button">Сортировка по имени пользователя</button>-->
<!--                <button id="inputEmailSort" class="btn btn-primary me-2 my-2" type="button">Сортировка по Email</button>-->
<!--                <button id="inputCompletedTasks" class="btn btn-primary me-2" type="button">Выполненные задания</button>-->
<!--                <button id="inputTasksNotCompleted" class="btn btn-primary me-2" type="button">Не выполненные задания</button>-->
<!--            </form>-->
<!--        </nav>-->

<!--        <form id="formTask" class="row justify-content-md-center" style="display: none">-->
<!--            <div class="col-6">-->
<!--                <label for="validationServer01" class="form-label">Введите имя</label>-->
<!--                <input type="text" class="form-control" id="nameSet" name="nameSet" required>-->
<!--                <div class="invalid-feedback" id="errorName">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-6">-->
<!--                <label for="validationServer02" class="form-label">Введите Email</label>-->
<!--                <input type="email" class="form-control" id="emailSet" name="emailSet" required>-->
<!--                <div class="invalid-feedback" id="errorEmail">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="mb-3">-->
<!--                <label for="validationTextarea" class="form-label">Задача</label>-->
<!--                <textarea class="form-control" id="taskSet" required></textarea>-->
<!--                <div class="invalid-feedback" id="errorTextarea">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12" id="send">-->
<!--            </div>-->
<!--            <div class="mt-2">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div id="success" class="alert alert-success" style="display: none">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--        <form id="formAdmin" class="row justify-content-md-center" style="display: none">-->
<!--            <div class="col-6">-->
<!--                <label for="validationServer01" class="form-label">Login</label>-->
<!--                <input type="text" class="form-control" id="loginCheck" name="loginCheck" required>-->
<!--                <div class="invalid-feedback" id="errorLogin">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-6">-->
<!--                <label for="validationServer02" class="form-label">Password</label>-->
<!--                <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" required>-->
<!--                <div class="invalid-feedback" id="errorPassword">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 mt-3">-->
<!--                <button id="sendAdmin" class="btn btn-primary" type="button">Send</button>-->
<!--            </div>-->
<!--            <div class="mt-2">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div id="success" class="alert alert-success" style="display: none">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--        <form id="formUserSort" class="row justify-content-md-center" style="display: none">-->
<!--            <div class="col-12">-->
<!--                <label for="validationServer01" class="form-label">Введите имя</label>-->
<!--                <input type="text" class="form-control" id="formUserSortCheck" name="formUserSortCheck" required>-->
<!--                <div class="invalid-feedback" id="formUserSortErrorLogin">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 mt-3">-->
<!--                <button id="sendEmailSort" class="btn btn-primary" type="button">Send</button>-->
<!--            </div>-->
<!--            <div class="mt-2">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div id="success" class="alert alert-success" style="display: none">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--        <form id="formEmailSort" class="row justify-content-md-center" style="display: none">-->
<!--            <div class="col-12">-->
<!--                <label for="validationServer01" class="form-label">Введите Email</label>-->
<!--                <input type="text" class="form-control" id="formEmailSortCheck" name="formUserEmailCheck" required>-->
<!--                <div class="invalid-feedback" id="formUserSortEmailLogin">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 mt-3">-->
<!--                <button id="sendEmailSorts" class="btn btn-primary" type="button">Send</button>-->
<!--            </div>-->
<!--            <div class="mt-2">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div id="success" class="alert alert-success" style="display: none">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--<div class="container">-->
<!--    <div class="row">-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-md-8 col-xl-6 text-center mx-auto">-->
<!--            <h2>Приложение задачник</h2>-->
<!--           <p class="w-lg-50">Добавить задачу</p>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div id="task">-->
<!---->
<!--        </div>-->
<!--        </div>-->
<!---->
<!--        <ul id="pag" class="mt-5 pagination justify-content-center">-->
<!--            <li id="pagination" class="page-item">-->
<!--                <a class="page-link" href="#" aria-label="Previous">-->
<!--                   <span aria-hidden="true">&laquo;</span-->
<!--               </a>-->
<!--            </li>-->
<!--            <li class="page-item">-->
<!--               <a class="page-link" href="#" aria-label="Next">-->
<!--                   <span aria-hidden="true">&raquo;</span>-->
<!--                </a-->
<!--            </li>-->
<!--        </ul>-->
<!---->
<!---->
<!--    </div>-->

<script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/public/assets/js/jquery-3.6.0.min.js"></script>
<script src="/public/assets/js/jscrypt.js"></script>
<script src="/public/assets/js/query.js"></script>
</body>

</html>