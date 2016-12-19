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

function deleteComment($db) {
	$deleteCommentInDb = "DELETE FROM comments WHERE id = :commentId";
	$deleteCommentStatement = $db->prepare($deleteCommentInDb);
	$deleteCommentStatement->execute([
		":commentId" => $_POST["commentId"],
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
	if (isset($_POST["deleteComment"])) {
		deleteComment($db);
	}
}

function getComments($db, $postId) {
	$getCommentsQuery = "SELECT comments.id, comments.user_id, comments.comment, comments.published, users.name, users.avatar
	FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.post_id = '{$postId}'";
	$getCommentsStatement = $db->query($getCommentsQuery);

	if ($getCommentsStatement->rowCount() == 0 ) {
		 return false;
	}
	$comments = $getCommentsStatement->fetchAll(PDO::FETCH_ASSOC);
	return $comments;
}
