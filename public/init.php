<?php
require_once('db.php');
require_once('func.php');

session_start();

$link = connect_db($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);