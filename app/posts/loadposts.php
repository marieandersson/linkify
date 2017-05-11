<?php

require __DIR__."/../../autoload.php";
// set +1 on number of posts to show, to check if the last post in database is included in result
$limit = intval($_POST["limit"]) + 1;

$postsToLoad = getPosts($db, $_POST["order"], $_POST["offset"], $limit, $_POST['possUserId']);
$lastPost = checkIfLastPost($postsToLoad, $limit);
if (count($postsToLoad) > $_POST["limit"]) {
    // drop the +1 post
    array_pop($postsToLoad);
}
$numberOfPosts = count($postsToLoad);

$i = 0;
for (; $i < $numberOfPosts - 1; $i++) {
    $post = $postsToLoad[$i]; ?>
	<div class="post fadeInPost">
	<?php include(__DIR__."/../../views/partials/post.block.php"); ?>
	</div>
<?php 
}
// echo last post separate, in case it is the last post
$post = $postsToLoad[$i]; ?>
<div class="post fadeInPost <?= $lastPost ? 'lastPost' : '';?>">
<?php include(__DIR__."/../../views/partials/post.block.php"); ?>
</div>
