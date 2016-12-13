<?php

function escapeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function checkLogin($db) {
	if (!isset($_SESSION["login"])) {
  	if (!isset($_COOKIE["linkify"])) {
    	return false;
    }
    if (!($userId = validateCookie($db))) {
      return false;
    }
    $_SESSION["login"]["id"] = $userId;
    }
  return true;
}
