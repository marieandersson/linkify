"use strict";
// handle post request for new comment
const commentPostButtons = document.querySelectorAll(".commentPost");
if (commentPostButtons) {
	commentPostButtons.forEach (function(commentButton) {
		commentButton.addEventListener("click", function(event) {
			event.preventDefault();
			handleCommentPost(commentButton);
		});
	});
}

function handleCommentPost(commentButton) {
	let comment = commentButton.parentElement.querySelector(".inputComment input[name=comment]").value;
	let postId = commentButton.parentElement.querySelector(".postId").value;
	let errorMessage = document.querySelector(".jsMessage");

	if (comment == "") {
		errorMessage.innerHTML = "Write a comment before posting.";
		errorMessage.classList.add("showError");
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("comment", comment);
		postData.append("postId", postId);
		postData.append("commentPost", "submit");
		// fetch php script handling post requests for new comments
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
					// display new comment
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
						// append to existing comment div
						commentElement.insertBefore(newComment, commentElement.firstChild);
						commentElement.classList.add("commentsShow");
					}
					// prepare for replies
					let replies = document.createElement("div");
					replies.classList.add("replies");
					newComment.appendChild(replies);
					let commentLink = newComment.parentElement.parentElement.querySelector(".commentLink");
					commentLink.innerHTML = "<h5><span class='readOrClose'>Close</span> comments</h5>";
					// add eventlistener to new comment post
					addCommentEventListeners(newComment);
					addCommentEventListenersForNewComments(newComment);
				});
			}
		});
	}
}

function addCommentEventListeners(newComment) {
	let editCommentButtons = newComment.querySelectorAll(".editCommentButton");
	if (editCommentButtons) {
		editCommentButtons.forEach (function(editCommentButton) {
			editCommentButton.addEventListener("click", function(event) {
				event.preventDefault();
				replaceCommentWithForm(editCommentButton);
			});
		});
	}

	let replyButtons = newComment.querySelectorAll(".replyButton");
	if (replyButtons) {
		replyButtons.forEach (function(replyButton) {
			replyButton.addEventListener("click", function(event) {
				event.preventDefault();
				showReplyForm(replyButton);
			});
		});
	}
	let deleteButtons = newComment.querySelectorAll(".deleteComment");
	if (deleteButtons) {
		deleteButtons.forEach(function(deleteButton) {
			deleteButton.addEventListener("click", function(event) {
				event.preventDefault();
				if (window.confirm("Are you sure you want to delete this comment?")) {
					handleCommentDelete(deleteButton);
				}
			});
		});
	}
	let newEditButtons = newComment.querySelectorAll(".saveEditComment");
	if (newEditButtons) {
		newEditButtons.forEach(function(newEditButton) {
			newEditButton.addEventListener("click", function(event) {
				event.preventDefault();
				handleEditComment(newEditButton);
			});
		});
	}
	let saveReplyButtons = newComment.querySelectorAll(".replySubmit");
	if (saveReplyButtons) {
		saveReplyButtons.forEach(function(saveReplyButton) {
			saveReplyButton.addEventListener("click", function(event) {
				event.preventDefault();
				handleReply(saveReplyButton);
			});
		});
	}
}
function addCommentEventListenersForNewComments(newComment) {
	let showSettingsButton = newComment.querySelector(".showPostSettings");
	if (showSettingsButton) {
		showSettingsButton.addEventListener("click", function(event) {
			event.preventDefault();
			showSettings(showSettingsButton);
		});
	}
}
