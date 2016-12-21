<?php

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
	}
	if (isset($_POST["saveEdit"])) {
		foreach($_POST as $input=>$value) {
	      escapeInput($_POST[$input]);
	  }
		// call function in newpost.php
		$result = validateNewPostFields($_POST["editUrl"]);

		if ($result == MISSING_POST_INPUT) {
			$editMessage = "Your changes wasn't saved. All fields must be filled.";
		} else if ($result == INVALID_URL) {
			$editMessage = "Your changes wasn't saved. Incorrect url format.";
		} else {
			editPost($db);
		}
	}
	header ('Location: ' . $_SERVER['REQUEST_URI']);
  exit();
}
