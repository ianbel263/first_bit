<?php
require_once('init.php');

if ($link) {
    if (!isset($_SESSION['user'])) {
        header('Location: /auth.php');
        die();
    }

    $page_content = include_template('private.php', [
        'user_fullname' =>  $_SESSION['user']['last_name'] . ' ' .
                            $_SESSION['user']['first_name'] . ' ' .
                            $_SESSION['user']['middle_name'],
    ]);

    $layout_content = include_template('layout.php', [
        'title' => 'Первый Бит - Профиль пользователя',
        'content' => $page_content,
    ]);

    print($layout_content);
}

