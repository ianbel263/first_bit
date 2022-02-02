<?php
require_once('main/init.php');
require_once('main/functions.php');
require_once('main/classes/User.php');

$response_data = [
    'result' => '',
    'data' => [],
    'errors' => [],
];

if ($link) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $json = file_get_contents('php://input');
        $post_data = json_decode($json, true);
        $errors = validate($post_data);

        $user = new User($link, $post_data);

        if ($user->is_auth()) {
            $response_data = [
                'result' => 'failure',
                'data' => [],
                'errors' => ['user' => 'Пользователь уже авторизован'],
            ];
        } else {
            if (count($errors)) {
                $response_data = [
                    'result' => 'failure',
                    'data' => [],
                    'errors' => $errors,
                ];
            } else {
                if (!$user->login()) {
                    $errors = $user->get_errors();
                }

                if ($user->is_auth() && empty($errors)) {
                    $response_data = [
                        'result' => 'success',
                        'data' =>  $user->get_data(),
                        'errors' => [],
                    ];
                } else {
                    $response_data = [
                        'result' => 'failure',
                        'data' =>  [],
                        'errors' => $errors,
                    ];
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