<?php
require __DIR__."/../../autoload.php";

function deletePost($db) {
	$deletePostInDb = "DELETE FROM posts WHERE id = :postId";
	$deletePostStatement = $db->prepare($deletePostInDb);
	$deletePostStatement->execute([
		":postId" => $_POST["postId"],
	]);
	// delete comments connected to post
	$deletePostsCommentsInDb = "DELETE FROM comments WHERE post_id = :postId";
	$deletePostsCommentsStatement = $db->prepare($deletePostsCommentsInDb);
	$deletePostsCommentsStatement->execute([
		":postId" => $_POST["postId"],
	]);
	// delete votes connected to post
	$deletePostsVotesInDb = "DELETE FROM votes WHERE post_id = :postId";
	$deletePostsVotesStatement = $db->prepare($deletePostsVotesInDb);
	$deletePostsVotesStatement->execute([
		":postId" => $_POST["postId"],
	]);

}

function editPost($db) {
	$edited = true;
	$editDate = date("Y-m-d H:i:s");
	$editPostInDb = "UPDATE posts SET subject = :subject, url = :url, description = :description,
	edited = :edited, edit_date = :editDate WHERE id = :postId";
	$editPostStatement = $db->prepare($editPostInDb);
	$editPostStatement->execute([
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
		header("Location: /");
		exit();
	}
	if (isset($_POST["saveEdit"])) {
		foreach($_POST as $input=>$value) {
	    $_POST[$input] = escapeInput($value);
	  }
		// call function in newpost.php
		$result = validateNewPostFields($_POST["editUrl"]);

		if ($result == MISSING_POST_INPUT) {
			$_SESSION["message"] = "Your changes wasn't saved. All fields must be filled.";
			header("Location: /");
			exit();
		}
		if ($result == INVALID_URL) {
			$_SESSION["message"] = "Your changes wasn't saved. Incorrect url format.";
			header("Location: /");
			exit();
		}
		editPost($db);
		header("Location: /");
		exit();
	}
}
