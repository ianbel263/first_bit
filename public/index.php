<?php
require_once('func.php');

$page_content = include_template('login.php', [
    'user' => null,
    'errors' => []
]);

$layout_content = include_template('layout.php', [
    'title' => 'Первый Бит - Авторизация',
    'content' => $page_content,
]);

print($layout_content);
