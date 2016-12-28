<?php

function checkVote($db) {
	$checkVoteQuery = "SELECT * FROM votes WHERE user_id = '{$_SESSION["login"]["id"]}' LIMIT 1";
	$checkVoteStatement = $db->query($checkVoteQuery);

	if ($checkVoteStatement->rowCount() == 0 ) {
     return false;
  }
	$vote = $checkVoteStatement->fetchAll(PDO::FETCH_ASSOC);
	return $vote;
}

function saveVote($db) {

}

function replaceVote($db) {

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["up"])) {
		// check if user already voted
		if (checkVote($db)) {
			//if user already voted up
			if ($vote["vote"] == 1) {
				return;
			}
			// if user already voted down
			replaceVote($db);
		}
		// if no vote - save up vote
		saveVote($db, 1);
	}
	if (isset($_POST["down"])) {
		// check if user already voted
		if (checkVote($db)) {
			//if user already voted down
			if ($vote["vote"] == -1) {
				return;
			}
			// if user already voted up
			replaceVote($db);
		}
		// if no vote - save down vote
		saveVote($db, -1);
	}
}
