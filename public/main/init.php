<?php
require_once('db.php');
require_once('functions.php');

session_start();

try {
    $link = connect_db($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
} catch (Exception $e) {
    http_response_code(503);
    die($e);
}
