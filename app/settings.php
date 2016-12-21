<?php

function updateUser($db, $userId, $newInput, $column) {
	$updateUsernameInDb = sprintf("UPDATE users SET %s = :newInput WHERE id = :id", $column);
	$updateUsernameStatement = $db->prepare($updateUsernameInDb);
	$updateUsernameStatement->execute([
		":newInput" => $newInput,
		":id" => $userId,
	]);
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
				updateUser($db, $userInfo["id"], $_POST["editUsername"], "username");
			}
			//update email
			if(!empty($_POST["editEmail"]) && $userInfo["email"] !== $_POST["editEmail"]) {
				if (!filter_var($_POST["editEmail"], FILTER_VALIDATE_EMAIL)) {
					$updateErrorMessage = "You must enter a valid email.";
				} else {
					updateUser($db, $userInfo["id"], $_POST["editEmail"], "email");
				}
			}
			//update name
			if (!empty($_POST["editFullName"]) && $userInfo["name"] !== $_POST["editFullName"]) {
				updateUser($db, $userInfo["id"], $_POST["editFullName"], "name");
			}
			// update password
			if (!empty($_POST["editPassword"])) {
				if($_POST["editPassword"] !== $_POST["repeatPassword"]) {
					$updateErrorMessage = "Passwords not matching.";
				} else {
					$newPassword = password_hash($_POST["editPassword"], PASSWORD_BCRYPT);
					updateUser($db, $userInfo["id"], $newPassword, "password");
				}
			}
			//update about
			if ($userInfo["about"] !== $_POST["about"]) {
				updateUser($db, $userInfo["id"], $_POST["editPassword"], "about");
			}
			//update avatar
			if(!empty($_FILES["avatar"]["name"])) {
				$allowed = array("png", "jpg");
				$ext = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
				// check file type
				if (!in_array($ext, $allowed)) {
				$updateErrorMessage = "The file must be jpg or png format.";
				// check file errors
				} else if ($_FILES["avatar"]["error"] !== 0) {
				$updateErrorMessage = "something went wrong trying upload your file.";
				// check file size is not bigger than 5MB.
				} else if ($_FILES["avatar"]["size"] > 5242880) {
					$updateErrorMessage = "The file is to big.";
				// upload image
				} else {
					if (!file_exists(__DIR__."/../assets/images/users/{$userInfo["id"]}")) {
            mkdir(__DIR__."/../assets/images/users/{$userInfo["id"]}");
        	}
					$name = uniqid() . "." . $ext;
					move_uploaded_file($_FILES["avatar"]["tmp_name"], __DIR__."/../assets/images/users/{$userInfo['id']}/$name");
					updateUser($db, $userInfo["id"], $name, "avatar");
				}
			}
		}
	}
	header ('Location: ' . $_SERVER['REQUEST_URI']);
  exit();
}
