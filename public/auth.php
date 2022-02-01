<?php
require_once('init.php');

if ($link) {
    $page_content = include_template('auth.php', [
        'user' => null,
        'errors' => []
    ]);

    $layout_content = include_template('layout.php', [
        'title' => 'Первый Бит - Авторизация',
        'content' => $page_content,
    ]);

    print($layout_content);
}