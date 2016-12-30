<?php
require __DIR__.'/../../autoload.php';

function saveNewPost($db) {
	$published = date("Y-m-d H:i:s");
	$insertPostIntoDb = "INSERT INTO posts (user_id, subject, url, description, published)
	VALUES (:user_id, :subject, :url, :description, :published)";

	$insertPostStatement = $db->prepare($insertPostIntoDb);
	$insertPostStatement->execute([
		":user_id" => $_SESSION["login"]["id"],
		":subject" => $_POST["subject"],
		":url" => $_POST["url"],
		":description" => $_POST["description"],
		":published" => $published,
	]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["postLink"])) {
		// escape input to avoid exploit attempts
		foreach($_POST as $input=>$value) {
	      escapeInput($_POST[$input]);
	  }
		$result = validateNewPostFields($_POST["url"]);

		if ($result == MISSING_POST_INPUT) {
			$_SESSION["message"] = "You must fill out all fields";
			header("Location: /");
			exit();
		} else if ($result == INVALID_URL) {
			$_SESSION["message"] = "Incorrect url format.";
			header("Location: /");
			exit();
		} else {
			// save new post in database
			saveNewPost($db);
			header("Location: /");
			exit();
		}
	}
}
