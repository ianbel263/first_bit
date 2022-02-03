<?php

function get_user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}


function connect_db(string $host, string $user, string $pwd, string $name) {
    $link = mysqli_connect($host, $user, $pwd, $name);
    mysqli_set_charset($link, 'utf8');

    if (!$link) {
        throw new Exception('Error connect DB');
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
    $name = $_SERVER['DOCUMENT_ROOT'] . '/templates/' . $name;
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
            case 'nickname':
                $errors[$key] = empty($value) ? 'Введите никнэйм' : null;
                break;
            case 'last_name':
                $errors[$key] = empty($value) ? 'Введите фамилию' : null;
                break;
            case 'first_name':
                $errors[$key] = empty($value) ? 'Введите имя' : null;
                break;
            case 'password2':
                $errors[$key] = empty($value) ? 'Подтвердите пароль' : null;
                break;
            case 'heading':
                $errors[$key] = empty($value) ? 'Введите заголовок' : null;
                break;
            case 'body':
                $errors[$key] = empty($value) ? 'Введите текст' : null;
                break;
        }
    }
    return array_filter($errors);
}


function validate_file(bool $is_errors): array {
    $errors = [];
    $file_url = null;

    $file_mime_types = [
        'image/png',
        'image/jpg',
        'image/jpeg'
    ];

    if (!empty($_FILES['post_image']['name'])) {
        $tmp_name = $_FILES['post_image']['tmp_name'];
        $file_name = $_FILES['post_image']['name'];
        $file_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        $file_url = '/uploads/' . $file_name;

        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($file_info, $tmp_name);

        if (!in_array($file_type, $file_mime_types)) {
            $errors['file'] = 'Загрузите картинку в формате jpg/jpeg/png';
        } elseif (!$is_errors) {
            move_uploaded_file($_FILES['post_image']['tmp_name'], $file_path . $file_name);
        }
    }

    return [
        'errors' => $errors,
        'url' => $file_url
    ];
}


/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt(object $link, string $sql, array $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            } else if (is_string($value)) {
                $type = 's';
            } else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}

