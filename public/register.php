<?php
require_once('main/init.php');
require_once('main/header.php');
require_once('main/footer.php');
require_once('main/classes/User.php');

if ($link) {
    if (User::is_auth()) {
        http_response_code(403);
        die();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $form_data = $_POST;
        $errors = validate($form_data);

        if (count($errors)) {
            $page_content = include_template('register.php', [
                'errors' => $errors
            ]);
        } else {
            $res = User::register($link, $form_data);

            if ($res['success'] && empty($errors)) {
                header('Location: /auth.php');
                die();
            }

            $errors = $res['errors'];
            $page_content = include_template('register.php', [
                'errors' => $errors
            ]);
        }
    } else {
        $page_content = include_template('register.php', [
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
