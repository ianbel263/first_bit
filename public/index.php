<?php
require_once('init.php');
require_once('main/header.php');
require_once('main/footer.php');

if ($link) {
    $page_content = include_template('main.php');

    $layout_content = include_template('layout.php', [
        'header' => $header_content,
        'content' => $page_content,
        'footer' => $footer_content
    ]);

    print($layout_content);
}