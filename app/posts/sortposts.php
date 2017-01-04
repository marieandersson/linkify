<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// user clicks to sort posts by publish date
	if (isset($_POST["byDate"])) {
		$posts = getPosts($db, "published");
		// save users choice in session
		$_SESSION["sort"] = "byDate";
	}
	// user clicks to sort posts by popularity
	if (isset($_POST["byPop"])) {
		$posts = getPosts($db, "votes");
		// save users choice in session
		$_SESSION["sort"] = "byPop";
	}
	// check if choice has been made
} else if (checkLogin($db) && $_SESSION["sort"] == "byDate") {
	$posts = getPosts($db, "published");
} else {
	// sort by popularity by default
	$posts = getPosts($db, "votes");
}
