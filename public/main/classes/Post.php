<?php

class Post
{
    private $data;

    public static function get($link, $id) {
        $sql_query =
            'SELECT p.id, u.nickname, p.created_at, p.image_url, p.heading, p.body
             FROM post p
             JOIN user u
             ON p.author_id = u.id
             WHERE p.id = ' . $id;
        $res = mysqli_query($link, $sql_query);
        return mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

    public static function get_by_user_id($link, $user_id) {
        $sql_query =
            'SELECT p.id, u.nickname, p.created_at, p.image_url, p.heading, p.body
             FROM post p
             JOIN user u
             ON p.author_id = u.id
             WHERE u.id = ' . $user_id . '
             ORDER BY p.created_at DESC';
        $res = mysqli_query($link, $sql_query);
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    public static function get_all($link) {
        $sql_query =
            'SELECT p.id, u.nickname, p.created_at, p.image_url, p.heading, p.body
             FROM post p
             JOIN user u
             ON p.author_id = u.id
             ORDER BY p.created_at DESC';
        $res = mysqli_query($link, $sql_query);
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    public function add($link, $user_id, $data) {
        array_unshift($data, $user_id);
        $sql_query = 'INSERT INTO post (author_id, heading, body, image_url) VALUES (?, ?, ?, ?)';
        $stmt = db_get_prepare_stmt($link, $sql_query, $data);
        $res = mysqli_stmt_execute($stmt);
        if ($res) {
            $this->data = $data;
        }
        return $res;
    }

    public static function delete($link, $id) {
        $sql_query = 'DELETE FROM post WHERE id =' . $id;
        return mysqli_query($link, $sql_query);
    }

    public static function update($link, $post_id, $data) {
        $fields = [
            'heading', 'body', 'image_url'
        ];
        $values = [];
        foreach ($data as $key => $value) {
            if (!$value || !in_array($key, $fields)) {
                continue;
            }
            $values[$key] = $key . '="' . mysqli_real_escape_string($link, $value) . '"';
        }
        $sql = 'UPDATE post SET '. implode(', ', $values) . ' WHERE id = ' . $post_id;
        $res = mysqli_query($link, $sql);
        return $res ? true : false;
    }
}
