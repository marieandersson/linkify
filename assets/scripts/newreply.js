"use strict";

const saveReplyButtons = document.querySelectorAll(".replySubmit");
if (saveReplyButtons) {
	saveReplyButtons.forEach(function(saveReplyButton) {
		saveReplyButton.addEventListener("click", function(event) {
			event.preventDefault();
			handleReply(saveReplyButton);
		});
	});
}

function handleReply(saveReplyButton) {
	let commentId = saveReplyButton.parentElement.parentElement.querySelector(".commentIdReply").value;
	let postId = saveReplyButton.parentElement.parentElement.querySelector(".postIdReply").value;
	let comment = saveReplyButton.parentElement.parentElement.querySelector(".replyFields input[name=comment]").value;
	let errorMessage = document.querySelector(".jsMessage");
	if (comment == "") {
		errorMessage.innerHTML = "Write a comment before posting.";
		errorMessage.classList.add("showError");
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("comment", comment);
		postData.append("postId", postId);
		postData.append("commentId", commentId);
		postData.append("replySubmit", "submit");
		// fetch php script handling post requests for new comments
		fetch("/app/posts/comments.php",
		{
			method: "POST",
			body: postData,
			credentials: "same-origin",
		})
		// response when php script has been executed
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
					saveReplyButton.parentElement.parentElement.reset();
					// display reply
					let newReply = document.createElement("div");
					newReply.innerHTML = result;
					newReply.classList.add("replyWrap");
					// append to replies div
					let commentWrap = saveReplyButton.parentElement.parentElement.parentElement.parentElement;
					let replies = commentWrap.querySelector(".replies");
					if (replies.hasChildNodes()) {
						replies.insertBefore(newReply, replies.firstChild);
					} else {
						replies.appendChild(newReply);
					}
					commentWrap.querySelector(".replyFields").classList.remove("replyFieldsShow");
					commentWrap.querySelector(".replyButton").innerHTML = "Reply to this.";
					// add event listeners to new reply
					let editCommentButton = newReply.querySelector(".editCommentButton");
					editCommentButton.addEventListener("click", function(event) {
						event.preventDefault();
						replaceCommentWithForm(editCommentButton);
					});
					let showSettingsButton = newReply.querySelector(".showPostSettings");
					showSettingsButton.addEventListener("click", function(event) {
						event.preventDefault();
						showSettings(showSettingsButton);
					});
					let deleteButton = newReply.querySelector(".deleteComment");
					deleteButton.addEventListener("click", function(event) {
						event.preventDefault();
						if (window.confirm("Are you sure you want to delete this comment?")) {
							handleCommentDelete(deleteButton);
						}
					});
					let newEditButton = newReply.querySelector(".saveEditComment");
					newEditButton.addEventListener("click", function(event) {
						event.preventDefault();
						handleEditComment(newEditButton);
					});
				});
			}
		});
	}
}
