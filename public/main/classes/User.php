<?php

class User
{
    private $data;
    private $errors;

    public function get_data() {
        return $this->data;
    }

    public function get_errors() {
        return $this->errors;
    }

    public static function is_auth(): bool {
        return isset($_SESSION['user']);
    }

    public function login($link, $credentials) {
        $user = $this->check_credentials($link, $credentials);
        if ($user) {
            $this->data = $user;
            $_SESSION['user'] = $user;
            $this->update_last_login($link);
            return $user;
        }
        return false;
    }

    public static function update($link, $id, $data) {
        $fields = [
          'username', 'nickname', 'email', 'phone',
          'first_name', 'middle_name', 'last_name',
          'gender', 'birthday_at'
        ];
        $id = intval($id);
        if ($id == 0) {
            return false;
        }
        $values = [];
        foreach ($data as $key => $value) {
            if (!$value || !in_array($key, $fields)) {
                continue;
            }
            $values[$key] = $key . '="' . mysqli_real_escape_string($link, $value) . '"';
        }
        $sql = 'UPDATE user SET '. implode(', ', $values) . ' WHERE id = ' . $id;
        $res = mysqli_query($link, $sql);
        return $res ? true : false;
    }

    public static function register($link, $data) {
        $res_register = null;
        $errors = [];
        $username = mysqli_real_escape_string($link, $data['username']);
        $sql = 'SELECT id FROM user WHERE username = ?';
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($res) > 0) {
            $errors['username'] = 'Пользователь с этим логином уже зарегистрирован';
        } elseif ($data['password'] != $data['password2']) {
            $errors['password'] = 'Введенные пароли не совпадают';
        } else {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = 'INSERT INTO user (
                            username, password, nickname, first_name, last_name, middle_name, email, phone
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = db_get_prepare_stmt(
                $link, $sql, [
                $username, $password, $data['nickname'], $data['first_name'], $data['last_name'],
                $data['middle_name'], $data['email'], $data['phone']
            ]);
            $res_register = mysqli_stmt_execute($stmt);
        }

        return $res_register ? ['success' => true, 'errors' => []] : ['success' => false, 'errors' => $errors];
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    private function check_credentials($link, $credentials) {
        $username = mysqli_real_escape_string($link, $credentials['username']);
        $sql_query = 'SELECT * FROM user WHERE username = ?';
        $stmt = mysqli_prepare($link, $sql_query);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

        if ($user) {
            if (password_verify($credentials['password'], $user['password'])) {
                return $user;
            } else {
                $this->errors['password'] = 'Неверный пароль';
                return false;
            }
        } else {
            $this->errors['username'] = 'Такой пользователь не найден';
        }
    }

    private function update_last_login($link) {
        $sql_query = 'UPDATE user SET last_login_at = NOW() WHERE id = ?';
        $stmt = mysqli_prepare($link, $sql_query);
        mysqli_stmt_bind_param($stmt, 'i', $this->data['id']);
        mysqli_stmt_execute($stmt);
    }
}
