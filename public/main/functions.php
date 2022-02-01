<?php

function get_user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}
