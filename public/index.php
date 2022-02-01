<?php
require_once('init.php');

if ($link) {
    $page_content = include_template('main.php');

    $layout_content = include_template('layout.php', [
        'title' => 'Первый Бит - Главная',
        'content' => $page_content,
    ]);

    print($layout_content);
}