<?php

function escapeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validateCookie($db) {
  $values = explode("|", $_COOKIE["linkify"]);
	$userId = $values[1];
	$first = $values[0];
	$second = $values[2];

	$getCookieFromDb = "SELECT user_id FROM cookies
  WHERE user_id = '{$userId}' AND first = '{$first}' AND second = '{$second}' AND expire >= NOW()";
	$getCookieStatement = $db->query($getCookieFromDb);

	if ($getCookieStatement->rowCount() > 0 ) {
     return $userId;
  }
  return NULL;
}

function checkLogin($db) {
	if (!isset($_SESSION["login"])) {
  	if (!isset($_COOKIE["linkify"])) {
    	return false;
    }
    if (!($userId = validateCookie($db))) {
      return false;
    }
    $_SESSION["login"]["id"] = $userId;
    }
  return true;
}

// constants for validation of posts input
define("POST_SUCCESS", "10");
define("MISSING_POST_INPUT", "11");
define("INVALID_URL", "12");

function validateNewPostFields($url) {
	// check if all fields has input
	foreach($_POST as $input=>$value) {
    if(empty($_POST[$input])) {
      return MISSING_POST_INPUT;
    }
  }
	if (!filter_var($url, FILTER_VALIDATE_URL)) {
    return INVALID_URL;
  }
	return POST_SUCCESS;
}

function getUserInfo($db) {
	$id = $_SESSION["login"]["id"];
	$getUserInfoQuery = "SELECT * FROM users WHERE id = '{$id}' LIMIT 1";
	$getUserInfoStatement = $db->query($getUserInfoQuery);
	$userInfo = $getUserInfoStatement->fetch(PDO::FETCH_ASSOC);
	return $userInfo;
}

function getPosts($db) {
	$getPostsQuery = "SELECT posts.id, posts.description, posts.subject, posts.url, posts.published, posts.user_id,
	users.name FROM posts INNER JOIN users ON posts.user_id = users.id";
	$getPostsStatement = $db->query($getPostsQuery);

	if ($getPostsStatement->rowCount() == 0 ) {
     return NULL;
  }
	$posts = $getPostsStatement->fetchAll(PDO::FETCH_ASSOC);
	return $posts;
}

function getComments($db, $postId) {
	$getCommentsQuery = "SELECT comments.id, comments.user_id, comments.comment, comments.published, comments.reply_to,
	users.name FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.post_id = '{$postId}'";
	$getCommentsStatement = $db->query($getCommentsQuery);

	if ($getCommentsStatement->rowCount() == 0 ) {
		 return NULL;
	}
	$comments = $getCommentsStatement->fetchAll(PDO::FETCH_ASSOC);
	return $comments;
}
// sort posts and comments by date
function sortByDate($postA, $postB) {
	return $postB["published"] <=> $postA["published"];
}

function sortPostsByVotes() {

}

function countVotes($db, $postId) {
	$countVotesQuery = "SELECT SUM(vote) AS sum_votes FROM votes WHERE post_id = '{$postId}'";
	$countVotesStatement = $db->query($countVotesQuery);

	$votes = $countVotesStatement->fetch(PDO::FETCH_ASSOC);
	return $votes;
}
// get info for other users profile pages
function getProfileInfo($db, $profileUsername) {
	$getProfileInfoQuery = "SELECT * FROM users WHERE username = '{$profileUsername}' LIMIT 1";
	$getProfileInfoStatement = $db->query($getProfileInfoQuery);
	$profileInfo = $getProfileInfoStatement->fetch(PDO::FETCH_ASSOC);
	return $profileInfo;
}
