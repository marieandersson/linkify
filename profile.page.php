<?php
require __DIR__."/autoload.php"
require __DIR__."/app/posts/votes.php";
require __DIR__."/views/partials/header.php";
$user = getUserInfo($db);
$posts = getPosts($db);
?>
<div class="content">
	<div class="profileWrap">

		<div class="displayUserProfile">
			<figure>
				<?php if ($user["avatar"] !== NULL) {  ?>
					<img src="/assets/images/users/<?=$user["id"]?>/<?=$user["avatar"]?>" />
				<?php } else { ?>
					<img src="/assets/images/placeholder/smiley.jpg" />
				<?php } ?>
			</figure>
			<h4><?=$user["name"]?></h4>
			<h5>@<?=$user["username"]?></h5>
			<p><?=$user["about"]?></p>
		</div>

		<div class="postsOnProfile">
			<?php require __DIR__."/views/partials/newpost.block.php";	?>

			<div class="displayPosts">
				<!-- check if any posts exists -->
				<?php if ($posts) {
					$userPosts = [];
					foreach ($posts as $post) {
						if ($post["user_id"] == $_SESSION["login"]["id"]) {
							$userPosts[] = $post;
						}
					}
					usort($userPosts, "sortByDate");
					foreach ($userPosts as $post) { ?>
						<div class="post">
							<?php require __DIR__."/views/partials/post.block.php";	?>
						</div>
				<?php }} ?>
			</div>
		</div>


	</div>

</div>
</div> <!-- end page -->
<?php
require __DIR__."/views/partials/footer.php";
require __DIR__."/views/partials/navigation.php";
?>
