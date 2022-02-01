<?php
require_once('init.php');

if ($link) {
    if (!isset($_SESSION['user'])) {
        header('Location: /auth.php');
        die();
    }

    $page_content = include_template('personal.php', [
        'user_data' => $_SESSION['user'],
    ]);

    $layout_content = include_template('layout.php', [
        'title' => 'Первый Бит - Информация о пользователе',
        'content' => $page_content,
    ]);

    print($layout_content);
}

