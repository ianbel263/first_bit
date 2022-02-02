<?php
require_once('../init.php');
require_once('../main/header.php');
require_once('../main/footer.php');


if ($link) {
    $user = get_user();
    if (!$user) {
        header('Location: /auth.php');
        die();
    }

    $page_content = include_template('personal.php', [
        'user_data' => $user,
    ]);

    $layout_content = include_template('layout.php', [
        'header' => $header_content,
        'content' => $page_content,
        'footer' => $footer_content
    ]);

    print($layout_content);
}

