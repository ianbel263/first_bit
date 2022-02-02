<?php
require_once('main/init.php');
require_once('main/header.php');
require_once('main/footer.php');
require_once('main/classes/User.php');

if ($link) {
    if (isset($_SESSION['user'])) {
        http_response_code(403);
        die();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $form = $_POST;
        $errors = validate($form);
        $user = new User($link, $form);

        if (count($errors)) {
            $page_content = include_template('register.php', [
                'errors' => $errors
            ]);
        } else {
            if ($user->register() && empty($errors)) {
                header('Location: /auth.php');
                die();
            } else {
                $errors = $user->get_errors();
                $page_content = include_template('register.php', [
                    'errors' => $errors
                ]);
            }
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
