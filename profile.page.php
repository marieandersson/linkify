<?php
require __DIR__."/autoload.php";
if (!checkLogin($db)) {
	header("Location: /");
}
$pageTitle = "Linkify - Profile";
$profile = getProfileInfo($db, $_GET["user"]);
$profileId = "= " . $profile["id"];
$postsToShowProfile = 10;
$posts = getPosts($db, "published", 0, $postsToShowProfile+1, $profileId);
$lastPost = checkIfLastPost($posts, $postsToShowProfile+1);
if (!$lastPost) {
	array_pop($posts);
}
require __DIR__."/views/partials/header.php";
?>
<div class="content">
	<?php if ($profile["id"] == $_SESSION["login"]["id"]) { ?>
	<h4 class="clickToShowNewPostForm">Share a link +</h4>
	<?php	}	?>
	<!-- client side validation error message -->
	<div class="jsMessage">
	</div>
	<?php
	// server side validation error message
		if ($message) { ?>
		<div class="message">
			<?= $message; ?>
		</div>
	<?php unset($_SESSION["message"]); } ?>

	<div class="profileWrap">
	<!-- write new post, show on click -->
	<?php require __DIR__."/views/partials/newpost.block.php"; ?>

		<div class="displayUserProfile displayUserProfilePage">
			<figure>
				<?php if ($profile["avatar"] !== NULL) {  ?>
					<img src="/assets/images/users/<?=$profile["id"]?>/<?=$profile["avatar"]?>" />
				<?php } else { ?>
					<img src="/assets/images/profileicon.png" />
				<?php } ?>
			</figure>
			<h4><?=$profile["name"]?></h4>
			<h5>@<?=$profile["username"]?></h5>
			<p><?=$profile["about"]?></p>
		</div>

		<div class="postsOnProfile">

			<div class="displayPosts">
				<!-- check if any posts exists -->
				<?php if ($posts) {
					foreach ($posts as $post) { ?>
						<div class="post">
						<?php
							require __DIR__."/views/partials/post.block.php";
						?>
						</div>
				<?php }} ?>
			</div>
			<?php if (!$lastPost) { ?>
			<div class="showMoreDiv">
				<button class="showMore showMoreProfile">Show more links...</button>
				<input type="hidden" class="profileId" value="<?=$profile['id']?>">
			</div>
			<?php } ?>

		</div>


	</div>

</div>
</div> <!-- end page -->

<?php
require __DIR__."/views/partials/navigation.php";
require __DIR__."/views/partials/footer.php";
?>
