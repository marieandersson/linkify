<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["byDate"])) {
		// user clicks to sort posts by publish date
		$_SESSION["sort"] = "byDate";
	 }
	 else if (isset($_POST["byPop"])) {
		// user clicks to sort posts by popularity
		$_SESSION["sort"] = "byPop";
	}
}
// default sort method
$sortMethod = "votes";
if (isset($_SESSION["sort"])) {
	if ($_SESSION["sort"] == "byDate") {
		$sortMethod = "published";
	}
}
$postsToShow = 1;
$posts = getPosts($db, $sortMethod, 0, $postsToShow+1);
$lastPost = checkIfLastPost($posts, $postsToShow+1);
if (count($posts) > $postsToShow) {
	array_pop($posts);
}
