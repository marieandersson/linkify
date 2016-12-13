<?php

// get user data for placeholders
function getUserInfo($db) {
	$id = $_SESSION["login"]["id"];
	$getUserInfoQuery = <<<EOT
	SELECT * FROM users WHERE id = '{$id}' LIMIT 1;
EOT;
	$getUserInfoStatement = $db->query($getUserInfoQuery);
	$userInfo = $getUserInfoStatement->fetch(PDO::FETCH_ASSOC);
	return $userInfo;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["saveChanges"])) {


	}
}
