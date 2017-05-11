<?php
require __DIR__."/autoload.php";

// check if user is logged in
if (!checkLogin($db)) {
    require __DIR__."/views/authentication.php";
} else {
    require __DIR__."/views/home.php";
}
