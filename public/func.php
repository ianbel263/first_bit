<?php

function connect_db(string $host, string $user, string $pwd, string $name) {
    $link = mysqli_connect($host, $user, $pwd, $name);
    mysqli_set_charset($link, 'utf8');

    if (!$link) {
        return false;
    } else {
        return $link;
    }
}


/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template(string $name, array $data = []): string {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}


function filter_user_data($data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function get_post_value(string $name): string {
    return $_POST ? filter_user_data($_POST[$name]) : '';
}


function validate(array $data): array {
    $errors = [];
    foreach ($data as $key => $value) {
        switch ($key) {
            case 'username':
                $errors[$key] = empty($value) ? 'Введите логин' : null;
                break;
            case 'password':
                $errors[$key] = empty($value) ? 'Введите пароль' : null;
                break;
        }
    }
    return array_filter($errors);
}
