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

function updateUsername($db, $userId, $newUsername) {
	$updateUsernameInDb = <<<EOT
	UPDATE users SET username = :newUsername WHERE id = :id;
EOT;
	$updateUsernameStatement = $db->prepare($updateUsernameInDb);
	$updateUsernameStatement->execute([
		":newUsername" => $newUsername,
		":id" => $userId,
	]);
}

function updateEmail($db, $userId, $newEmail) {
	$updateEmailInDb = <<<EOT
	UPDATE users SET email = :newEmail WHERE id = :id;
EOT;
	$updateEmailStatement = $db->prepare($updateEmailInDb);
	$updateEmailStatement->execute([
		":newEmail" => $newEmail,
		":id" => $userId,
	]);
}

function updateName($db, $userId, $newName) {
	$updateNameInDb = <<<EOT
	UPDATE users SET name = :newName WHERE id = :id;
EOT;
	$updateNameStatement = $db->prepare($updateNameInDb);
	$updateNameStatement->execute([
		":newName" => $newName,
		":id" => $userId,
	]);
}
function updatePassword($db, $userId, $newPassword) {
	$newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
	$updatePasswordInDb = <<<EOT
	UPDATE users SET password = :newPassword WHERE id = :id;
EOT;
	$updatePasswordStatement = $db->prepare($updatePasswordInDb);
	$updatePasswordStatement->execute([
		":newPassword" => $newPassword,
		":id" => $userId,
	]);
}
function updateAbout($db, $userId, $newAbout) {
	$updateAboutInDb = <<<EOT
	UPDATE users SET about = :newAbout WHERE id = :id;
EOT;
	$updateAboutStatement = $db->prepare($updateAboutInDb);
	$updateAboutStatement->execute([
		":newAbout" => $newAbout,
		":id" => $userId,
	]);
}
function updateImage($db, $userId, $nimageInfo) {

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["saveChanges"])) {
		$userInfo = getUserInfo($db);
		// check password to allow changes
		if (empty($_POST["saveWithPassword"])) {
			$updateErrorMessage = "You need to fill out your password to make changes.";
		} else if (!password_verify($_POST["saveWithPassword"], $userInfo["password"])) {
			$updateErrorMessage = "You entered the wrong password";
		}  else {
			// update username
			if(!empty($_POST["editUsername"]) && $userInfo["username"] !== $_POST["editUsername"]) {
				updateUsername($db, $userInfo["id"], $_POST["editUsername"]);
			}
			//update email
			if(!empty($_POST["editEmail"]) && $userInfo["email"] !== $_POST["editEmail"]) {
				if (!filter_var($_POST["editEmail"], FILTER_VALIDATE_EMAIL)) {
					$updateErrorMessage = "You must enter a valid email.";
				} else {
					updateEmail($db, $userInfo["id"], $_POST["editEmail"]);
				}
			}
			//update name
			if (!empty($_POST["editFullName"]) && $userInfo["name"] !== $_POST["editFullName"]) {
				updateName($db, $userInfo["id"], $_POST["editFullName"]);
			}
			// update password
			if (!empty($_POST["editPassword"])) {
				if($_POST["editPassword"] !== $_POST["repeatPassword"]) {
					$updateErrorMessage = "Passwords not matching.";
				} else {
					updatePassword($db, $userInfo["id"], $_POST["editPassword"]);
				}
			}
			//update about
			if ($userInfo["about"] !== $_POST["about"]) {
				updateAbout($db, $userInfo["id"], $_POST["editPassword"]);
			}
			//update avatar
			if(!empty($_FILES)) {
				if (!file_exists(__DIR__."/../assets/images/users/{$_SESSION["login"]["id"]}")) {
            mkdir(__DIR__."/../assets/images/users/{$_SESSION["login"]["id"]}");
        }
				updateImage($db, $userInfo["id"], $_FILES["avatar"])
			}
		}
	}
}
