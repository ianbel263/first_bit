<?php
require_once('main/init.php');
require_once('main/header.php');
require_once('main/footer.php');
require_once('main/classes/User.php');

if ($link) {
    if (User::is_auth()) {
        header('Location: /private.php');
        die();
    }
    $page_content = include_template('auth.php', [
        'user' => null,
        'errors' => []
    ]);

    $layout_content = include_template('layout.php', [
        'header' => $header_content,
        'content' => $page_content,
        'footer' => $footer_content
    ]);

    print($layout_content);
}