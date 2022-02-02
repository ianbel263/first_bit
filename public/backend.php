<?php
require_once('init.php');
require_once('main/functions.php');

$response_data = [
    'result' => '',
    'data' => [],
    'errors' => [],
];

if ($link) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (get_user()) {
            $response_data['result'] = 'failure';
            $response_data['data'] = [];
            $response_data['errors'] = ['user' => 'Пользователь уже авторизован'];
        } else {
            $json = file_get_contents('php://input');
            $post_data = json_decode($json, true);
            $errors = validate($post_data);

            if (count($errors)) {
                $response_data['result'] = 'failure';
                $response_data['data'] = [];
                $response_data['errors'] = $errors;
            } else {
                $username = mysqli_real_escape_string($link, $post_data['username']);
                $sql_query = 'SELECT * FROM user WHERE username = ?';
                $stmt = mysqli_prepare($link, $sql_query);
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

                if ($user) {
                    if ($user['password'] == $post_data['password']) {
                        $_SESSION['user'] = $user;
                    } else {
                        $errors['password'] = 'Неверный пароль';
                    }
                } else {
                    $errors['username'] = 'Такой пользователь не найден';
                }

                if ($user && empty($errors)) {
                    $response_data['result'] = 'success';
                    $response_data['data'] = $user;
                    $response_data['errors'] = [];
                } else {
                    $response_data['result'] = 'failure';
                    $response_data['data'] = [];
                    $response_data['errors'] = $errors;
                }
            }
        }

        header("Content-Type: application/json");
        $json = json_encode($response_data);
        if ($json === false) {
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                $json = '{"jsonError":"unknown"}';
            }
            http_response_code(500);
        }
        echo $json;
    }
}