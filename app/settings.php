<?php
require __DIR__."/../autoload.php";

function updateUser($db, $userId, $newInput, $column) {
	$updateUsernameInDb = sprintf("UPDATE users SET %s = :newInput WHERE id = :id", $column);
	$updateUsernameStatement = $db->prepare($updateUsernameInDb);
	$updateUsernameStatement->execute([
		":newInput" => $newInput,
		":id" => $userId,
	]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	foreach($_POST as $input=>$value) {
		$_POST[$input] = escapeInput($value);
	}
	if (isset($_POST["saveChanges"])) {
		$userInfo = getUserInfo($db);
		// check password to allow changes
		if (empty($_POST["saveWithPassword"])) {
			$_SESSION["error"] = "You need to fill out your password to make changes.";
			header("Location: /settings");
			exit();
		}
		if (!password_verify($_POST["saveWithPassword"], $userInfo["password"])) {
			$_SESSION["error"] = "You entered the wrong password.";
			header("Location: /settings");
			exit();
		}
		// update username
		if(!empty($_POST["editUsername"]) && $userInfo["username"] !== $_POST["editUsername"]) {
			updateUser($db, $userInfo["id"], $_POST["editUsername"], "username");
			header("Location: /settings");
			exit();
		}
		//update email
		if(!empty($_POST["editEmail"]) && $userInfo["email"] !== $_POST["editEmail"]) {
			if (!filter_var($_POST["editEmail"], FILTER_VALIDATE_EMAIL)) {
				$_SESSION["error"] = "You must enter a valid email.";
				header("Location: /settings");
				exit();
			}
			updateUser($db, $userInfo["id"], $_POST["editEmail"], "email");
			}
		//update name
		if (!empty($_POST["editFullName"]) && $userInfo["name"] !== $_POST["editFullName"]) {
			updateUser($db, $userInfo["id"], $_POST["editFullName"], "name");
		}
		// update password
		if (!empty($_POST["editPassword"])) {
			if($_POST["editPassword"] !== $_POST["repeatPassword"]) {
				$_SESSION["error"] = "Passwords are not matching.";
				header("Location: /settings");
				exit();
			}
			$newPassword = password_hash($_POST["editPassword"], PASSWORD_BCRYPT);
			updateUser($db, $userInfo["id"], $newPassword, "password");
			}
		//update about
		if ($userInfo["about"] !== $_POST["about"]) {
			updateUser($db, $userInfo["id"], $_POST["about"], "about");
		}
		//update avatar
		if(!empty($_FILES["avatar"]["name"])) {
			$allowed = array("png", "jpg");
			$ext = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
			// check file type
			if (!in_array($ext, $allowed)) {
				$_SESSION["error"] = "The file must be in jpg or png format.";
				header("Location: /settings");
				exit();
			}
			// check file errors
			if ($_FILES["avatar"]["error"] !== 0) {
				$_SESSION["error"] = "Something went wrong trying to upload your file.";
				header("Location: /settings");
				exit();
			}
			// check file size is not bigger than 5MB.
			if ($_FILES["avatar"]["size"] > 5242880) {
				$_SESSION["error"] = "The file is to big.";
				header("Location: /settings");
				exit();
			}
			// upload image
			if (!file_exists(__DIR__."/../assets/images/users/{$userInfo["id"]}")) {
        mkdir(__DIR__."/../assets/images/users/{$userInfo["id"]}");
      }
			$name = uniqid() . "." . $ext;
			move_uploaded_file($_FILES["avatar"]["tmp_name"], __DIR__."/../assets/images/users/{$userInfo['id']}/$name");
			updateUser($db, $userInfo["id"], $name, "avatar");
		}
		header("Location: /settings");
		exit();
	}
}
