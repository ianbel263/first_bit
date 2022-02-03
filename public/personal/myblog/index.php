<?php
require_once('../../main/init.php');
require_once('../../main/header.php');
require_once('../../main/footer.php');
require_once('../../main/classes/Post.php');
require_once('../../main/classes/User.php');

if ($link) {
    if (!User::is_auth()) {
        http_response_code(403);
        die();
    }
    $posts = Post::get_by_user_id($link, User::get_id());
    $page_content = include_template('posts.php', [
        'posts' => $posts,
        'is_auth' => User::is_auth()
    ]);

    $layout_content = include_template('layout.php', [
        'header' => $header_content,
        'content' => $page_content,
        'footer' => $footer_content
    ]);

    print($layout_content);
}
