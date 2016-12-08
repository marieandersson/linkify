<?php

// conncetion to database
$connectionString = "mysql:host=localhost;port=8889;dbname=linkify;charset=utf8";
$user = "admin";
$password = "secret";
try {
	$db = new PDO($connectionString, $user, $password);
} catch (PDOException $connectionException) {
  echo "Connection failed: ", $connectionException->getMessage();
}
