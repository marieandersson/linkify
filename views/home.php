<?php
require __DIR__."/partials/header.php";
require __DIR__."/../app/posts/newpost.php";
$user = getUserInfo($db);
$posts = getPosts($db);
?>

	<div class="content">

		<main class="homeMain">

			<div class="homeTopWrap">
				<div class="displayUser">
					<figure>
						<?php if ($user["avatar"] !== NULL) {  ?>
							<img src="/assets/images/users/<?=$user["id"]?>/<?=$user["avatar"]?>" />
						<?php } else { ?>
							<img src="/assets/images/placeholder/smiley.jpg" />
						<?php } ?>
					</figure>
					<h4><?=$user["name"]?></h4>
					<h5>@<?=$user["username"]?></h5>
				</div>

				<div class="posts">
					<div class="newPost">
						<form action="index.php" method="post">
							<h4>Share a link</h4>
							<div class="postMessage"><?php if(isset($postMessage)) echo $postMessage; ?></div>
							<div class="newPostFields">
								<input type="text" name="subject" placeholder="Subject">
								<input type="text" name="url" placeholder="Link">
								<input type="text" name="description" placeholder="Short description">
								<input type="submit" name="postLink" value="Share">
							</div>
						</form>
					</div>
					<div class="displayPosts">
						<?php if ($posts) {
							foreach ($posts as $post) { ?>
								<div class="post">
									<h4><?=$post["subject"]?></h4>
									<p><?=$post["username"]?></p>
								</div>
						<?php }} ?>
					</div>
				</div> <!-- end posts -->
			</div> <!-- end topWrap -->


		</main>
	</div>

	<p>Start page, small profile, share links, news feed. edit links, delete links, comment on links. up and down vote links.</p>
</div> <!-- end page -->


<?php require __DIR__."/partials/navigation.php"; ?>

<?php require __DIR__."/partials/footer.php"; ?>
