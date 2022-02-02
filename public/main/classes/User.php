<?php

class User
{
    private $link;
    private $username;
    private $password;
    private $data;
    private $errors;

    public function __construct($link, $credentials) {
        $this->link = $link;
        $this->username = mysqli_real_escape_string($link, $credentials['username']);
        $this->password = $credentials['password'];
    }

    public function get_data() {
        return $this->data;
    }

    public function get_errors() {
        return $this->errors;
    }

    public function is_auth(): bool {
        return isset($_SESSION['user']);
    }

    public function login() {
        $user = $this->check_credentials();
        if ($user) {
            $this->data = $user;
            $_SESSION['user'] = $user;
            $this->update_last_login();
            return $user;
        }
        return false;
    }

    public function logout() {
        $link = null;
        $username = null;
        $password = null;
        $this->data = null;
        $this->errors = null;
    }

    private function check_credentials() {
        $sql_query = 'SELECT * FROM user WHERE username = ?';
        $stmt = mysqli_prepare($this->link, $sql_query);
        mysqli_stmt_bind_param($stmt, 's', $this->username);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

        if ($user) {
            if ($this->password == $user['password']) {
                return $user;
            } else {
                $this->errors['password'] = 'Неверный пароль';
                return false;
            }
        } else {
            $this->errors['username'] = 'Такой пользователь не найден';
        }
    }

    private function update_last_login() {
        $sql_query = 'UPDATE user SET last_login_at = NOW() WHERE id = ?';
        $stmt = mysqli_prepare($this->link, $sql_query);
        mysqli_stmt_bind_param($stmt, 'i', $this->data['id']);
        mysqli_stmt_execute($stmt);
    }
}
