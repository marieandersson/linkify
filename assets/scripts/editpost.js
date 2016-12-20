"use strict";

// replace post content with form
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
// repalce comment content with form
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
// show reply to comment fields
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
			replyButton.innerHTML = "Reply";
		}
	});
});
// show edit and delete buttons
const showPostSettings = document.querySelectorAll(".showPostSettings");
showPostSettings.forEach (function (showSettingsButton) {
	showSettingsButton.addEventListener("click", function (event) {
		event.preventDefault();
		let postButtonsForm = showSettingsButton.parentElement;
		let postSettingsButtons = postButtonsForm.querySelector(".postSettingsButtons");
		postSettingsButtons.classList.toggle("postSettingsButtonsShow");
	});
});
// show comments
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
