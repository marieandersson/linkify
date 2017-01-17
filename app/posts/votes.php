<?php
require __DIR__."/../../autoload.php";

function getVote($db) {
	$getVoteQuery = "SELECT * FROM votes WHERE user_id = '{$_SESSION["login"]["id"]}' AND post_id = '{$_POST["postIdForVote"]}' LIMIT 1";
	$votes = queryToDb($db, $getVoteQuery);

	if ($votes->rowCount() == 0 ) {
     return NULL;
  }
	$vote = $votes->fetchAll(PDO::FETCH_ASSOC);
	return $vote;
}

function saveVote($db, $value) {
	$insertVoteIntoDb = "INSERT INTO votes (post_id, user_id, vote)
	VALUES (:post_id, :user_id, :vote)";
	prepareAndExecute($db, $insertVoteIntoDb, [
		":post_id" => $_POST["postIdForVote"],
		":user_id" => $_SESSION["login"]["id"],
		":vote" => $value,
	]);
}

function replaceVote($db, $value) {
	$replaceVoteInDb = "UPDATE votes SET vote = :vote WHERE user_id = :user_id AND post_id = :post_id";
	prepareAndExecute($db, $replaceVoteInDb, [
		":post_id" => $_POST["postIdForVote"],
		":user_id" => $_SESSION["login"]["id"],
		":vote" => $value,
	]);

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// user can't vote on own post
	if ($_POST["postUserIdForVote"] == $_SESSION["login"]["id"]) {
		http_response_code(406);
		echo "Sorry, you can't vote on you own post.";
		exit();
	}
	if (isset($_POST["up"])) {
		// check if user already voted
		$vote = getVote($db);
		if ($vote) {
			//if user already voted up
			if ($vote[0]["vote"] == 1) {
				http_response_code(406);
				echo "You have already voted up on this link.";
				exit();
			}
			// if user already voted down replace vote in database
			replaceVote($db, 1);
			echo "vote replaced";
			exit();
		}
		// if no vote - save up vote in database
		saveVote($db, 1);
		echo "new vote saved";
		exit();
	}
	if (isset($_POST["down"])) {
		// check if user already voted
		$vote = getVote($db);
		if ($vote) {
			//if user already voted down
			if ($vote[0]["vote"] == -1) {
				http_response_code(406);
				echo "You have already voted down on this link.";
				exit();
			}
			// if user already voted up
			replaceVote($db, -1);
			echo "vote replaced";
			exit();
		}
		// if no vote - save down vote
		saveVote($db, -1);
		echo "new vote saved";
		exit();
	}
}
