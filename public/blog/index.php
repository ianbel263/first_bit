<?php
require_once('../main/init.php');
require_once('../main/header.php');
require_once('../main/footer.php');
require_once('../main/classes/Post.php');

if ($link) {
    $posts = Post::get_all($link);

    $page_content = include_template('posts.php', [
        'posts' => $posts
    ]);

    $layout_content = include_template('layout.php', [
        'header' => $header_content,
        'content' => $page_content,
        'footer' => $footer_content
    ]);

    print($layout_content);
}
