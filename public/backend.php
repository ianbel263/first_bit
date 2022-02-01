<?php
require_once('func.php');

$USERNAME = 'test';
$PASSWORD = 'secret';
$USER_DATA = 'Васильев Иван Иванович';

$data = [
    'result' => '',
    'data' => [],
    'errors' => [],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $post_data = json_decode($json, true);
    $errors = validate($post_data);

    if (count($errors)) {
        $data['result'] = 'failure';
        $data['data'] = [];
        $data['errors'] = $errors;
    } else {
        $user = $post_data['username'];
        $password = $post_data['password'];
        if ($user == $USERNAME) {
            if ($password != $PASSWORD) {
                $errors['password'] = 'Неверный пароль';
            }
        } else {
            $errors['username'] = 'Такой пользователь не найден';
        }

        if (empty($errors)) {
            $data['result'] = 'success';
            $data['data'] = $USER_DATA;
            $data['errors'] = [];
        } else {
            $data['result'] = 'failure';
            $data['data'] = [];
            $data['errors'] = $errors;
        }
    }

    header("Content-Type: application/json");
    $json = json_encode($data);
    if ($json === false) {
        $json = json_encode(["jsonError" => json_last_error_msg()]);
        if ($json === false) {
            $json = '{"jsonError":"unknown"}';
        }
        http_response_code(500);
    }
    echo $json;
}
