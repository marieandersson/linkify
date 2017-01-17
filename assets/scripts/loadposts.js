"use strict";

// when user clicks to show more posts
let showMore = document.querySelector(".showMore");
if (showMore) {
	showMore.addEventListener("click", function(event) {
		loadMorePosts(showMore);
	});
}
// when userId is set to "is not null" posts from all users is returned from database
let userId = "is not null";
// if user clicks to show more posts on a profile page only profile users posts is returned
let showMoreProfile = document.querySelector(".showMoreProfile");
if (showMoreProfile) {
	let getUserId = showMoreProfile.parentElement.querySelector(".profileId").value;
	userId = "= " + getUserId;
}
function loadMorePosts(showMore) {
	let countPosts = document.querySelectorAll(".post");
	let offset = countPosts.length;
	let limit = 10;
	let order = "published";
	let currentOrder = document.querySelector(".sortMethod");
	let errorMessage = document.querySelector(".jsMessage");

	if (currentOrder) {
		if (currentOrder.value === "Popular") {
			order = "votes";
		}
	}
	let postData = new FormData();
	postData.append("offset", offset);
	postData.append("limit", limit);
	postData.append("order", order);
	postData.append("possUserId", userId);

	// fetch php script to handle show more posts request
	fetch("/app/posts/loadposts.php",
	{
		method: "POST",
		body: postData,
		credentials: "same-origin",
	})
	.then(function(response) {
		if (!response.ok) {
			return response.text().then(function (error) {
				errorMessage.innerHTML = "Something went wrong trying to load.";
				errorMessage.classList.add("showError");
			});
		} else {
			return response.text().then(function(result) {
				// remove possible error message
				errorMessage.classList.remove("showError");
				let allPosts = document.querySelector(".displayPosts");
				allPosts.innerHTML += result;
				let posts = document.querySelectorAll(".post");
				posts.forEach (function(post) {
					// add event listners
					addPostEventListeners(post);
					addCommentEventListeners(post);
					let join = post.querySelector(".joinAndDiscuss");
					if (join) {
						join.addEventListener("click", function(event) {
							document.body.classList.toggle("navigationOpen");
						});
					}
					// remove temp class on posts after fade in is completed
					setTimeout(function(){
					  post.classList.remove("fadeInPost");
					}, 1000);
				});
				let lastPost = document.querySelector(".lastPost");
				if (lastPost) {
					// hide show more button if all posts is displayed
					showMore.classList.add("showMoreHide");
				}
			});
		}

	});
}
