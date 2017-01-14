<?php
require __DIR__."/../../autoload.php";

$posts = getPosts($db, $_POST["order"], $_POST["offset"], $_POST["limit"]);

foreach ($posts as $post) { ?>
	<div class="post fadeInPost">
	<?php include(__DIR__."/../../views/partials/post.block.php"); ?>
	</div>
<?php } ?>
