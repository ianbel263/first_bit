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
        $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
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
            $post_data['image_url'] = $file_url;
            $res = Post::update($link, $post_id, $post_data);
            if ($res) {
                header('Location: /personal/myblog/index.php');
                die();
            }
        }
    } else {
        $post_id = filter_input(INPUT_GET, 'post_id', FILTER_SANITIZE_NUMBER_INT);
        if ($post_id) {
            $post = Post::get($link, $post_id);
            $page_content = include_template('add_post.php', [
                'post' => $post,
                'errors' => []
            ]);
        } else {
            http_response_code(404);
            die();
        }
    }

    $layout_content = include_template('layout.php', [
        'header' => $header_content,
        'content' => $page_content,
        'footer' => $footer_content
    ]);

    print($layout_content);
}
