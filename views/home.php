<?php
require __DIR__."/partials/header.php";
$user = getUserInfo($db);
?>

	<div class="content">

		<main class="homeMain">
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

			<div class="sharelinks">
				<form action="index.php" method="post">
					<h4>Share a link</h4>
					<div class="shareLinksFields">
						<input type="text" name="subject" placeholder="Subject">
						<input type="text" name="url" placeholder="Link">
						<input type="text" name="description" placeholder="Short description">
						<input type="submit" name="shareLink" value="Share">
					</div>
				</form>
			</div>

		</div>
	</main>

	<p>Start page, small profile, share links, news feed. edit links, delete links, comment on links. up and down vote links.</p>
</div> <!-- end page -->


<?php require __DIR__."/partials/navigation.php"; ?>

<?php require __DIR__."/partials/footer.php"; ?>
