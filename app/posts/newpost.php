<?php
require __DIR__."/../../autoload.php";

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
	    $_POST[$input] = escapeInput($value);
	  }
		$result = validateNewPostFields($_POST["url"]);

		if ($result == MISSING_POST_INPUT) {
			http_response_code(406);
			echo "Please fill out all fields.";
			exit();
		}
		if ($result == INVALID_URL) {
			http_response_code(406);
			echo "Invalid url format.";
			exit();
		}
		// save new post in database
		saveNewPost($db);
		echo "Success!";
		http_response_code(200);
		// return new post to js fetch request
	}
}
