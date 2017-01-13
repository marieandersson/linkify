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
		":commentId" => $_POST["commentIdForEdit"],
	]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	handleSubmits($db);
}
function handleSubmits($db) {
	// escape input to avoid exploit attempts
	foreach($_POST as $input=>$value) {
		$_POST[$input] = escapeInput($value);
	}
	if (isset($_POST["commentPost"])) {
		// check if comment has content
		if (empty($_POST["comment"])) {
			http_response_code(406);
			echo "Write a comment before posting.";
			exit();
		}
		// save new comment in database
		saveNewComment($db);
		// return new comment to js response
		$commentId = $db->lastInsertId();
		$getNewCommentQuery = "SELECT comments.id, comments.user_id, comments.comment, comments.published, comments.reply_to, comments.edited,
		users.username FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.id = '{$commentId}' AND comments.post_id = '{$_POST["postId"]}'";
		$getNewCommentStatement = $db->query($getNewCommentQuery);
		$comment = $getNewCommentStatement->fetch(PDO::FETCH_ASSOC);

		include(__DIR__."/../../views/partials/comment.block.php");
		http_response_code(200);
	}
	if (isset($_POST["deleteComment"])) {
		deleteComment($db);
	}
	if (isset($_POST["saveEditComment"])) {
		// Check if comment has content
		if (empty($_POST["editComment"])) {
			http_response_code(406);
			echo "Comment can't be empty.";
			exit();
		}
		// save updates in database
		editComment($db);

	}
	if (isset($_POST["replySubmit"])) {
		// Check if comment has content
		if (empty($_POST["comment"])) {
			http_response_code(406);
			echo "Comment can't be empty.";
			exit();
		}
		// save reply in database
		$replyTo = $_POST["commentId"];
		saveNewComment($db, $replyTo);

		$commentId = $db->lastInsertId();
		$getReplyQuery = "SELECT comments.id, comments.user_id, comments.comment, comments.published, comments.reply_to, comments.edited,
		users.username FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.id = '{$commentId}' AND comments.post_id = '{$_POST["postId"]}'";
		$getReplyStatement = $db->query($getReplyQuery);
		$reply = $getReplyStatement->fetch(PDO::FETCH_ASSOC);

		include(__DIR__."/../../views/partials/reply.block.php");
		http_response_code(200);
	}
}
