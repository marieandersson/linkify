"use strict";

// replace post content with form
function replacePostWithForm() {
	const editButtons = document.querySelectorAll(".editButton");
	editButtons.forEach (function(editButton) {
	  editButton.addEventListener("click", function (event) {
			event.preventDefault();
			let postElement = editButton.parentElement.parentElement.parentElement.parentElement;
			let postContent = postElement.querySelector(".postContent");
			postContent.classList.toggle("postContentHide");
			let editForm = postElement.querySelector(".editPostForm");
			editForm.classList.toggle("editPostFormShow");
			if (postContent.classList.contains("postContentHide")) {
				editButton.innerHTML = "Close";
			} else {
				editButton.innerHTML = "Edit post";
			}
		});
	});
}
replacePostWithForm();
// repalce comment content with form
function replaceCommentWithForm() {
	const editCommentButtons = document.querySelectorAll(".editCommentButton");
	editCommentButtons.forEach (function(editCommentButton) {
		editCommentButton.addEventListener("click", function (event) {
			event.preventDefault();
			let commentElement = editCommentButton.parentElement.parentElement.parentElement;
			let commentContent = commentElement.querySelector(".commentDiv");
			commentContent.classList.toggle("commentHide");
			let editCommentForm = commentElement.querySelector(".editCommentForm");
			editCommentForm.classList.toggle("editCommentFormShow");
			if (commentContent.classList.contains("commentHide")) {
				editCommentButton.innerHTML = "Close";
			} else {
				editCommentButton.innerHTML = "Edit";
			}
		});
	});
}
replaceCommentWithForm();
// show reply to comment fields
function showReplyForm() {
	const replyToComment = document.querySelectorAll(".replyButton");
	replyToComment.forEach (function(replyButton) {
		replyButton.addEventListener("click", function (event) {
			event.preventDefault();
			let form = replyButton.parentElement;
			let replyInputFields = form.querySelector(".replyFields");
			replyInputFields.classList.toggle("replyFieldsShow");
			if (replyInputFields.classList.contains("replyFieldsShow")) {
				replyButton.innerHTML = "Close";
			} else {
				replyButton.innerHTML = "Reply to this";
			}
		});
	});
}
showReplyForm();
// show settings with edit and delete buttons
function showSettings() {
	const showPostSettings = document.querySelectorAll(".showPostSettings");
	showPostSettings.forEach (function (showSettingsButton) {
		showSettingsButton.addEventListener("click", function (event) {
			event.preventDefault();
			let postButtonsForm = showSettingsButton.parentElement;
			let postSettingsButtons = postButtonsForm.querySelector(".postSettingsButtons");
			postSettingsButtons.classList.toggle("postSettingsButtonsShow");
		});
	});
}
showSettings();
// show comments
function clickToShowComments() {
	const showCommentsLink = document.querySelectorAll(".commentLink");
	showCommentsLink.forEach (function (showComments) {
		showComments.addEventListener("click", function (event) {
			event.preventDefault();
			let commentWrap = showComments.parentElement.parentElement;
			let comments = commentWrap.querySelector(".comments");
			comments.classList.toggle("commentsShow");
			let readOrClose = showComments.querySelector(".readOrClose");
			if (comments.classList.contains("commentsShow")) {
				readOrClose.innerHTML = "close";
			} else {
				readOrClose.innerHTML = "read";
			}
		});
	});
}
clickToShowComments();
// user must be looged in to vote on posts
function logInToVote() {
	const voteArrows = document.querySelectorAll(".notLoggedIn");
	voteArrows.forEach(function (arrow) {
	  arrow.addEventListener("click", function (event) {
	    event.preventDefault();
	    document.body.classList.add("navigationOpen");
	  });
	});
}
logInToVote();

// handle post request for new link post without page reload
const submitLinkButton = document.querySelector(".postLink");
submitLinkButton.addEventListener("click", function(event) {
	handleNewPost();
});

function handleNewPost() {
	event.preventDefault();
	let subject = document.querySelector(".newPostFields input[name=subject]").value;
	let url = document.querySelector(".newPostFields input[name=url]").value;
	let description = document.querySelector(".newPostFields input[name=description]").value;
	let errorMessage = document.querySelector(".jsMessage");
	// check if all fields has content
	if (subject == "" || url == "" || description == "") {
		errorMessage.innerHTML = "Please fill out all fields.";
		errorMessage.classList.add("showError"); // remove later?
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("subject", subject);
		postData.append("url", url);
		postData.append("description", description);
		postData.append("postLink", "share");
		// post to the php script handling post requests for new posts
		fetch("/app/posts/newpost.php",
		{
			method: "POST",
			body: postData,
			credentials: "same-origin",
		})
		// response when php script have been executed
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
					// and display new post
					let newPost = document.createElement("div");
					newPost.innerHTML = result;
					newPost.classList.add("post");
					let allPosts = document.querySelector(".displayPosts");
					allPosts.insertBefore(newPost, allPosts.firstChild);
					// add event listeners to new post
					replacePostWithForm();
					showSettings();
					let commentButton = newPost.querySelector(".commentPost");
					console.log(commentButton);
					commentButton.addEventListener("click", function(event) {
						handleCommentPost(commentButton);
					});
				});
			}
		});
	}
}

// handle post request for new comment without page reload
const commentPostButtons = document.querySelectorAll(".commentPost");
commentPostButtons.forEach (function(commentButton) {
	commentButton.addEventListener("click", function(event) {
		handleCommentPost(commentButton);
	});
});

function handleCommentPost(commentButton) {
	event.preventDefault();
	let comment = commentButton.parentElement.querySelector(".inputComment input[name=comment]").value;
	let postId = commentButton.parentElement.querySelector(".inputComment input[name=postId]").value;
	let errorMessage = document.querySelector(".jsMessage");
	// check if all fields has content
	if (comment == "") {
		errorMessage.innerHTML = "Write a comment before posting.";
		errorMessage.classList.add("showError"); // remove later?
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("comment", comment);
		postData.append("postId", postId);
		postData.append("commentPost", "submit");
		// post to the php script handling post requests for new posts
		fetch("/app/posts/comments.php",
		{
			method: "POST",
			body: postData,
			credentials: "same-origin",
		})
		// response when php script have been executed
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
					commentButton.parentElement.parentElement.reset();
					// and display new comment
					let newComment = document.createElement("div");
					newComment.innerHTML = result;
					newComment.classList.add("commentWrap");
					// append new comment to post
					let postDiv = commentButton.parentElement.parentElement.parentElement;
					let commentElement = postDiv.querySelector(".comments");
					// if this is the first comment create comments div
					if (commentElement === null) {
						let commentElement = document.createElement("div");
						commentElement.classList.add("comments");
						commentElement.classList.add("commentsShow");
						commentElement.appendChild(newComment);
						postDiv.appendChild(commentElement);
					} else {
						// else append to existing comment div
						commentElement.insertBefore(newComment, commentElement.firstChild);
						commentElement.classList.add("commentsShow");
					}
				});
			}
		});
	}
}
