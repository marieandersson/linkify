"use strict";

let showMore = document.querySelector(".showMore");
if (showMore) {
	showMore.addEventListener("click", function(event) {
		loadMorePosts();
	});
}

function loadMorePosts() {
	let countPosts = document.querySelectorAll(".post");
	let offset = countPosts.length - 1;
	let limit = 2;
	let order = "published";
	let currentOrder = document.querySelector(".sortMethod");
	if (currentOrder) {
		if (currentOrder.value == "Popular") {
			let order = "votes";
		}
	}
	let postData = new FormData();
	postData.append("offset", offset);
	postData.append("limit", limit);
	postData.append("order", order);

	fetch("/app/posts/loadposts.php",
	{
		method: "POST",
		body: postData,
		credentials: "same-origin",
	})
	.then(function(response) {
		if (!response.ok) {
			// add error
		} else {
			return response.text().then(function(result) {
				// remove error
				let allPosts = document.querySelector(".displayPosts");
				allPosts.innerHTML += result;
				let posts = document.querySelectorAll(".fadeInPost");
				posts.forEach (function(post) {
					console.log(post);
					addExistingEventListeners(post);
				});
			});
		}

	});
}
