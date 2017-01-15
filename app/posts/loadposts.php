<?php
require __DIR__."/../../autoload.php";

$limit = intval($_POST["limit"]) + 1;

$posts = getPosts($db, $_POST["order"], $_POST["offset"], $limit);
$numberOfPosts = count($posts);
$lastPost = true;
if ($numberOfPosts == $limit) {
	$lastPost = false;
}

$i = 0;
for (; $i < $_POST["limit"] - 1; $i++) {
  $post = $posts[$i]; ?>
	<div class="post fadeInPost">
	<?php include(__DIR__."/../../views/partials/post.block.php"); ?>
	</div>
<?php }
$post = $posts[$i]; ?>
<div class="post fadeInPost <?= $lastPost ? 'lastPost' : '';?>">
<?php include(__DIR__."/../../views/partials/post.block.php"); ?>
</div>
