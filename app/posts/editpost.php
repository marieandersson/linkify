<?php
require __DIR__."/../../autoload.php";

function deletePost($db) {
	$deletePostInDb = "DELETE FROM posts WHERE id = :postId";
	prepareAndExecute($db, $deletePostInDb, [
		":postId" => $_POST["postId"],
	]);
	// delete comments connected to post
	$deletePostsCommentsInDb = "DELETE FROM comments WHERE post_id = :postId";
	prepareAndExecute($db, $deletePostsCommentsInDb, [
		":postId" => $_POST["postId"],
	]);
	// delete votes connected to post
	$deletePostsVotesInDb = "DELETE FROM votes WHERE post_id = :postId";
	prepareAndExecute($db, $deletePostsVotesInDb, [
		":postId" => $_POST["postId"],
	]);

}

function editPost($db) {
	$edited = true;
	$editDate = date("Y-m-d H:i:s");
	$editPostInDb = "UPDATE posts SET subject = :subject, url = :url, description = :description,
	edited = :edited, edit_date = :editDate WHERE id = :postId";
	prepareAndExecute($db, $editPostInDb, [
		":subject" => $_POST["editSubject"],
		":url" => $_POST["editUrl"],
		":description" => $_POST["editDescription"],
		":edited" => $edited,
		":editDate" => $editDate,
		":postId" => $_POST["postIdForEdit"],
	]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["deletePost"])) {
		deletePost($db);
	}
	if (isset($_POST["saveEdit"])) {
		foreach($_POST as $input=>$value) {
	    $_POST[$input] = escapeInput($value);
	  }
		// check if all fields has input
		$result = validateNewPostFields($_POST["editUrl"]);

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
		editPost($db);
	}
}
