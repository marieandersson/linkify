<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["byDate"])) {
        // user clicks to sort posts by publish date
        $_SESSION["sort"] = "byDate";
    } elseif (isset($_POST["byPop"])) {
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
$postsToShow = 15;
// set +1 on number of posts to show, to check if the last post in database is included in result
$posts = getPosts($db, $sortMethod, 0, $postsToShow+1);
$lastPost = checkIfLastPost($posts, $postsToShow+1);
if (count($posts) > $postsToShow) {
    // drop the +1 post
    array_pop($posts);
}
