"use strict";

let showMore = document.querySelector(".showMore");
if (showMore) {
	showMore.addEventListener("click", function(event) {
		loadMorePosts(showMore);
	});
}
function loadMorePosts(showMore) {
	let countPosts = document.querySelectorAll(".post");
	let offset = countPosts.length;
	let limit = 2;
	let order = "published";
	let currentOrder = document.querySelector(".sortMethod");

	if (currentOrder) {

		if (currentOrder.value === "Popular") {
			order = "votes";
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
				let posts = document.querySelectorAll(".post");
				posts.forEach (function(post) {
					addPostEventListeners(post);
					addCommentEventListeners(post);
					let join = post.querySelector(".joinAndDiscuss");
					if (join) {
						join.addEventListener("click", function(event) {
							document.body.classList.toggle("navigationOpen");
						});
					}
				});
				let lastPost = document.querySelector(".lastPost");
				if (lastPost) {
					showMore.classList.add("showMoreHide");
				}
			});
		}

	});
}
