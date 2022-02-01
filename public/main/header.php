<?php
require_once('functions.php');

$user = get_user();

$header_content = include_template('header.php', [
    'title' => 'Первый Бит - Стажеры',
    'user' => $user
]);
