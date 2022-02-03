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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_data = $_POST;
        $errors = validate($post_data);
        $file_data = validate_file(count($errors));
        $errors = array_merge($errors, $file_data['errors']);
        $file_url = $file_data['url'];

        if (count($errors)) {
            $page_content = include_template('add_post.php', [
                'errors' => $errors
            ]);
        } else {
            array_push($post_data, $file_url);
            $post = new Post();
            $res = $post->add($link, User::get_id(), $post_data);
            if ($res) {
                header('Location: /personal/myblog/index.php');
                die();
            }
        }
    } else {
        $page_content = include_template('add_post.php', [
            'errors' => []
        ]);
    }

    $layout_content = include_template('layout.php', [
        'header' => $header_content,
        'content' => $page_content,
        'footer' => $footer_content
    ]);

    print($layout_content);
}
