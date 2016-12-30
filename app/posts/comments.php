<?php
require __DIR__."/../../autoload.php";

function saveNewComment($db, $replyTo = NULL) {
	$published = date("Y-m-d H:i:s");
	$insertCommentIntoDb = "INSERT INTO comments (comment, published, user_id, post_id, reply_to)
	VALUES (:comment, :published, :user_id, :post_id, :reply_to)";

	$insertCommentStatement = $db->prepare($insertCommentIntoDb);
	$insertCommentStatement->execute([
		":comment" => $_POST["comment"],
		":published" => $published,
		":user_id" => $_SESSION["login"]["id"],
		":post_id" => $_POST["postId"],
		":reply_to" => $replyTo,
	]);
}

function deleteComment($db) {
	$deleteCommentInDb = "DELETE FROM comments WHERE id = :commentId OR reply_to = :commentId";
	$deleteCommentStatement = $db->prepare($deleteCommentInDb);
	$deleteCommentStatement->execute([
		":commentId" => $_POST["commentId"],
	]);
}

function editComment($db) {
	$edited = true;
	$editDate = date("Y-m-d H:i:s");
	$editCommentInDb = "UPDATE comments SET comment = :comment,
	edited = :edited, edit_date = :editDate WHERE id = :commentId";
	$editCommentStatement = $db->prepare($editCommentInDb);
	$editCommentStatement->execute([
		":comment" => $_POST["editComment"],
		":edited" => $edited,
		":editDate" => $editDate,
		":commentId" => $_POST["postIdForEditComment"],
	]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	handleSubmits($db);
}
function handleSubmits($db) {
	if (isset($_POST["commentPost"])) {
		// escape input to avoid exploit attempts
		escapeInput($_POST["comment"]);
		// check if comment has content
		if (empty($_POST["comment"])) {
			header("Location: /");
			exit();
		}
		saveNewComment($db);
		header("Location: /");
		exit();
	}
	if (isset($_POST["deleteComment"])) {
		deleteComment($db);
		header("Location: /");
		exit();
	}
	if (isset($_POST["saveEditComment"])) {
		// escape input to avoid exploit attempts
		escapeInput($_POST["editComment"]);
		// Check if comment has content
		if (empty($_POST["editComment"])) {
			header("Location: /");
			exit();
		}
		editComment($db);
		header("Location: /");
		exit();
	}
	if (isset($_POST["replySubmit"])) {
		// escape input to avoid exploit attempts
		escapeInput($_POST["comment"]);
		// Check if comment has content
		if (empty($_POST["comment"])) {
			header("Location: /");
			exit();
		}
		$replyTo = $_POST["commentId"];
		saveNewComment($db, $replyTo);
		header("Location: /");
		exit();
	}
}
