<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["byDate"])) {
		$posts = getPosts($db, "published");
	}
	if (isset($_POST["byPop"])) {
		$posts = getPosts($db, "votes");
	}
} else {
	$posts = getPosts($db, "published");
}
