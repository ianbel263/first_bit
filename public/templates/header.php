<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="container__content">
        <header class="page_header">
            <div class="page_header__top">
                <nav class="page_header__navbar navbar navbar-expand-lg navbar-light">
                    <a href="/" class="page_header__logo logo navbar-brand">
                        <img src="../img/logo.svg" alt="Первый Бит">
                    </a>
                    <ul class="nav navbar-nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="private.php">Приватная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="personal.php">Персональная</a>
                        </li>
                        <?php if (!$user) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="auth.php">Войти</a>
                            </li>
                        <? else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Выйти</a>
                            </li>
                        <? endif; ?>
                    </ul>
                </nav>
            </div>
            <div class="page_header__bottom">
                <h1 class="page_header__heading heading">Первый Бит Стажёры</h1>
            </div>
        </header>
        <main>
