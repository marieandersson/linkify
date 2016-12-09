<?php

function escapeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function createLoginCookie($db, $userId) {
  $first = bin2hex(random_bytes(64));
  $second = bin2hex(random_bytes(128));
  $cookie = "$first|$userId|$second";
  $timestamp = time() + 60 * 60 * 24 * 30;
  $expire = date("Y-m-d H:i:s", $timestamp);

	$insertCookieIntoDb = <<<EOT
	INSERT INTO cookies (user_id, expire, first, second)
	VALUES (:user_id, :expire, :first, :second);
EOT;
	$insertCookieStatement = $db->prepare($insertCookieIntoDb);
	$insertCookieStatement->execute([
		":user_id" => $userId,
		":expire" => $expire,
		":first" => $first,
		":second" => $second,
	]);
  setcookie("linkify", $cookie, $timestamp, "/", "", false, true);
}

function validateCookie($db) {
  $values = explode("|", $_COOKIE["linkify"]);
	$userId = $values[1];
	$first = $values[0];
	$second = $values[2];

	$getCookieFromDb = <<<EOT
	SELECT user_id FROM cookies WHERE user_id = '{$userId}' AND first = '{$first}' AND second = '{$second}' AND expire >= NOW();
EOT;
	$getCookieStatement = $db->query($getCookieFromDb);

	if ($getCookieStatement->rowCount() > 0 ) {
     return $userId;
  }
  return false;
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
