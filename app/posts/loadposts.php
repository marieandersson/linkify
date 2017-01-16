<?php
require __DIR__."/../../autoload.php";
$limit = intval($_POST["limit"]) + 1;

$postsToLoad = getPosts($db, $_POST["order"], $_POST["offset"], $limit, $_POST['userId']);
$lastPost = checkIfLastPost($postsToLoad, $limit);
if (count($postsToLoad) > $_POST["limit"]) {
	array_pop($postsToLoad);
}
$numberOfPosts = count($postsToLoad);

$i = 0;
for (; $i < $numberOfPosts - 1; $i++) {
  $post = $postsToLoad[$i]; ?>
	<div class="post fadeInPost">
	<?php include(__DIR__."/../../views/partials/post.block.php"); ?>
	</div>
<?php }
$post = $postsToLoad[$i]; ?>
<div class="post fadeInPost <?= $lastPost ? 'lastPost' : '';?>">
<?php include(__DIR__."/../../views/partials/post.block.php"); ?>
</div>
