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
<nav>
    <div class="container">
        <ul>
            <li id="login">
                <a id="login-trigger" href="#">
                    Admin <span>&#x25BC;</span>
                </a>
                <div id="login-content">
                    <form>
                        <fieldset id="inputs">
                            <input id="username" type="email" name="Email" placeholder="Ваш email адрес" required>
                            <input id="password" type="password" name="Password" placeholder="Пароль" required>
                        </fieldset>
                        <fieldset id="actions">
                            <input type="submit" id="submit" value="Войти">
                            <label><input type="checkbox" checked="checked"> Запомнить меня</label>
                        </fieldset>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
<!--        <div class="col-md-6">-->
<!--            <section class="position-relative py-4 py-xl-5">-->
<!--                <div class="container">-->
<!--                    <div class="row mb-5">-->
<!--                        <div class="col-md-8 col-xl-6 text-center mx-auto">-->
<!--                            <h2>Log in</h2>-->
<!--                            <p class="w-lg-50">Curae hendrerit donec commodo hendrerit egestas tempus, turpis facilisis-->
<!--                                nostra nunc. Vestibulum dui eget ultrices.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row d-flex justify-content-center">-->
<!--                        <div class="col-md-6 col-xl-12">-->
<!--                            <div class="card mb-5">-->
<!--                                <div class="card-body d-flex flex-column align-items-center">-->
<!--                                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4">-->
<!--                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"-->
<!--                                             fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">-->
<!--                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>-->
<!--                                        </svg>-->
<!--                                    </div>-->
<!--                                    <form class="text-center" method="post">-->
<!--                                        <div class="mb-3"><input class="form-control" type="email" name="email"-->
<!--                                                                 placeholder="Email"></div>-->
<!--                                        <div class="mb-3"><input class="form-control" type="password" name="password"-->
<!--                                                                 placeholder="Password"></div>-->
<!--                                        <div class="mb-3">-->
<!--                                            <button class="btn btn-primary d-block w-100" type="submit">Login</button>-->
<!--                                        </div>-->
<!--                                        <p class="text-muted">Forgot your password?</p>-->
<!--                                    </form>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </section>-->
<!--        </div>-->
        <div class="col">
            <section class="position-relative py-4 py-xl-5">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-12 col-xxl-4">
                            <div class="card mb-5">
                                <div class="card-body p-sm-5">
                                    <h2 class="text-center mb-4">Создать новую задачу</h2>
                                    <form method="post">
                                        <div class="mb-3"><input class="form-control" type="text" id="name-3"
                                                                 name="name" placeholder="Name"></div>
                                        <div class="mb-3"><input class="form-control" type="email" id="email-3"
                                                                 name="email" placeholder="Email"></div>
                                        <div class="mb-3"><textarea class="form-control" id="message-3" name="message"
                                                                    rows="6" placeholder="Message"></textarea></div>
                                        <div>
                                            <button class="btn btn-primary d-block w-100" type="submit">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="container py-4 py-xl-5">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>Приложение задачник</h2>
            <p class="w-lg-50">Добавить задачу</p>
        </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <div class="col">
            <div class="p-4"><span class="badge rounded-pill bg-primary mb-2"><span
                            style="font-weight: normal !important;">Задача № 1</span></span>
                <h6>Дата:&nbsp;</h6>
                <h6><strong>Имя:&nbsp;</strong></h6>
                <h6>email:</h6>
                <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in,
                    egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
            </div>
        </div>
        <div class="col">
            <div class="p-4"><span class="badge rounded-pill bg-primary mb-2">Article</span>
                <h4>Lorem libero donec</h4>
                <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in,
                    egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50"
                                         src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png">
                    <div>
                        <p class="fw-bold mb-0">John Smith</p>
                        <p class="text-muted mb-0">Erat netus</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="p-4"><span class="badge rounded-pill bg-primary mb-2">Article</span>
                <h4>Lorem libero donec</h4>
                <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in,
                    egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50"
                                         src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png">
                    <div>
                        <p class="fw-bold mb-0">John Smith</p>
                        <p class="text-muted mb-0">Erat netus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery-3.6.0.min.js"></script>
<script src="/assets/js/jscrypt.js"></script>
</body>

</html>