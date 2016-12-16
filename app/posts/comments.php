<?php

function saveNewComment($db) {
	$published = date("Y-m-d H:i:s");
	$insertCommentIntoDb = "INSERT INTO comments (comment, published, user_id, post_id)
	VALUES (:comment, :published, :user_id, :post_id)";

	$insertCommentStatement = $db->prepare($insertCommentIntoDb);
	$insertCommentStatement->execute([
		":comment" => $_POST["comment"],
		":published" => $published,
		":user_id" => $_SESSION["login"]["id"],
		":post_id" => $_POST["postId"],
	]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["commentPost"])) {
		// escape input to avoid exploit attempts
		escapeInput($_POST["comment"]);
		// check if comment has content
		if (empty($_POST["comment"])) {
			return;
		} else {
			saveNewComment($db);
		}
	}
}
