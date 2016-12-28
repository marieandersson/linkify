<?php

function getVote($db) {
	$getVoteQuery = "SELECT * FROM votes WHERE user_id = '{$_SESSION["login"]["id"]}' AND post_id = '{$_POST["postIdForVote"]}' LIMIT 1";
	$getVoteStatement = $db->query($getVoteQuery);

	if ($getVoteStatement->rowCount() == 0 ) {
     return NULL;
  }
	$vote = $getVoteStatement->fetchAll(PDO::FETCH_ASSOC);
	return $vote;
}

function saveVote($db, $value) {
	$insertVoteIntoDb = "INSERT INTO votes (post_id, user_id, vote)
	VALUES (:post_id, :user_id, :vote)";

	$insertVoteStatement = $db->prepare($insertVoteIntoDb);
	$insertVoteStatement->execute([
		":post_id" => $_POST["postIdForVote"],
		":user_id" => $_SESSION["login"]["id"],
		":vote" => $value,
	]);
}

function replaceVote($db, $value) {
	$replaceVoteInDb = "UPDATE votes SET vote = :vote WHERE user_id = :user_id AND post_id = :post_id";

	$replaceVoteStatement = $db->prepare($replaceVoteInDb);
	$replaceVoteStatement->execute([
		":post_id" => $_POST["postIdForVote"],
		":user_id" => $_SESSION["login"]["id"],
		":vote" => $value,
	]);

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["up"])) {
		// check if user already voted
		$vote = getVote($db);
		if ($vote) {
			//if user already voted up
			if ($vote[0]["vote"] == 1) {
				return;
			}
			// if user already voted down
			replaceVote($db, 1);
			header ("Location: " . $_SERVER["REQUEST_URI"]);
			exit();
		}
		// if no vote - save up vote
		saveVote($db, 1);
		header ("Location: " . $_SERVER["REQUEST_URI"]);
		exit();
	}
	if (isset($_POST["down"])) {
		// check if user already voted
		$vote = getVote($db);
		if ($vote) {
			//if user already voted down
			if ($vote[0]["vote"] == -1) {
				return;
			}
			// if user already voted up
			replaceVote($db, -1);
			header ("Location: " . $_SERVER["REQUEST_URI"]);
			exit();
		}
		// if no vote - save down vote
		saveVote($db, -1);
		header ("Location: " . $_SERVER["REQUEST_URI"]);
		exit();
	}
}
