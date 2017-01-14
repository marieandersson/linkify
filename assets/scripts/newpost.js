"use strict";

// handle post request for new link post without page reload
const submitLinkButton = document.querySelector(".postLink");
if (submitLinkButton) {
	submitLinkButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleNewPost();
	});
}

function handleNewPost() {
	let subject = document.querySelector(".newPostFields input[name=subject]").value;
	let url = document.querySelector(".newPostFields input[name=url]").value;
	let description = document.querySelector(".newPostFields input[name=description]").value;
	let errorMessage = document.querySelector(".jsMessage");
	// check if all fields has content
	if (subject == "" || url == "" || description == "") {
		errorMessage.innerHTML = "Please fill out all fields.";
		errorMessage.classList.add("showError");
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("subject", subject);
		postData.append("url", url);
		postData.append("description", description);
		postData.append("postLink", "share");
		// post to php script handling post requests for new posts
		fetch("/app/posts/newpost.php",
		{
			method: "POST",
			body: postData,
			credentials: "same-origin",
		})
		// response after php script have been executed
		.then(function(response) {
			// if error
			if (!response.ok) {
				return response.text().then(function (error) {
					errorMessage.innerHTML = error;
					errorMessage.classList.add("showError");
				});
			} else {
				return response.text().then(function(result) {
					// if success remove error and reset form
					errorMessage.classList.remove("showError");
					document.querySelector(".newPostForm").reset();
					document.querySelector(".newPostWrap").classList.remove("showNewPostForm");
					// display new post
					let newPost = document.createElement("div");
					newPost.innerHTML = result;
					newPost.classList.add("post");
					newPost.classList.add("fadeInPost");
					let allPosts = document.querySelector(".displayPosts");
					allPosts.insertBefore(newPost, allPosts.firstChild);
					// add event listeners to new post
					addExistingEventListeners(newPost);
				});
			}
		});
	}
}

function addExistingEventListeners(newPost) {
	let commentButton = newPost.querySelector(".commentPost");
	commentButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleCommentPost(commentButton);
	});
	let deleteButton = newPost.querySelector(".deleteButton");
	deleteButton.addEventListener("click", function(event) {
		event.preventDefault();
		if (window.confirm("Are you sure you want to delete this post?")) {
			handlePostDelete(deleteButton);
		}
	});
	let newEditButton = newPost.querySelector(".saveEdit");
	newEditButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleEditPost(newEditButton);
	});
	let showSettingsButton = newPost.querySelector(".showPostSettings");
	showSettingsButton.addEventListener("click", function(event) {
		event.preventDefault();
		showSettings(showSettingsButton);
	});
	let editButton = newPost.querySelector(".editButton");
	editButton.addEventListener("click", function(event) {
		event.preventDefault();
		replacePostWithForm(editButton);
	});
	let upVoteNewPost = newPost.querySelector(".up");
	upVoteNewPost.addEventListener("click", function(event) {
		event.preventDefault();
		handleVote(upVoteNewPost, "up", 1);
	});
	let downVoteNewPost = newPost.querySelector(".down");
	downVoteNewPost.addEventListener("click", function(event) {
		event.preventDefault();
		handleVote(downVoteNewPost, "down", -1);
	});
}
