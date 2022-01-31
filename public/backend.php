<?php
require_once('func.php');

$USERNAME = 'test';
$PASSWORD = 'secret';
$USER_DATA = 'Васильев Иван Иванович';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_data = $_POST;
    $errors = validate($form_data);

    if (count($errors)) {
        $page_content = include_template('login.php', [
            'errors' => $errors
        ]);
    } else {
        $user = $form_data['username'];
        $password = $form_data['password'];
        if ($user == $USERNAME) {
            if ($password != $PASSWORD) {
                $errors['password'] = 'Неверный пароль';
            }
        } else {
            $errors['username'] = 'Такой пользователь не найден';
        }

        if (empty($errors)) {
            $page_content = include_template('login.php', [
                'user' => $USER_DATA,
                'errors' => []
            ]);
        } else {
            $page_content = include_template('login.php', [
                'errors' => $errors
            ]);
        }
    }
} else {
    $page_content = include_template('login.php', [
        'errors' => []
    ]);
}

$layout_content = include_template('layout.php', [
    'title' => 'Первый Бит - Авторизация',
    'content' => $page_content,
]);

print($layout_content);
