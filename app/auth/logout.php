<?php

session_start();
$_SESSION = [];
session_destroy();

if (isset($_COOKIE['linkify'])) {
    setcookie('linkify', '', time(), '/');
}

header('Location: /');
exit();
