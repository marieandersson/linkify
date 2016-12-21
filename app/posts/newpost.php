<?php

define("POST_SUCCESS", "10");
define("MISSING_POST_INPUT", "11");
define("INVALID_URL", "12");

function validateNewPostFields($url) {
	// check if all fields has input
	foreach($_POST as $input=>$value) {
    if(empty($_POST[$input])) {
      return MISSING_POST_INPUT;
    }
  }
	if (!filter_var($url, FILTER_VALIDATE_URL)) {
    return INVALID_URL;
  }
	return POST_SUCCESS;
}

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
			$postMessage = "You must fill out all fields";
		} else if ($result == INVALID_URL) {
			$postMessage = "Incorrect url format.";
		} else {
			// save new post in database
			saveNewPost($db);
		}
	}
	header ('Location: ' . $_SERVER['REQUEST_URI']);
  exit();
}
