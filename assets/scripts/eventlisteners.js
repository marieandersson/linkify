"use strict";

// show new post form
const showFormButton = document.querySelector(".clickToShowNewPostForm");
if (showFormButton) {
	showFormButton.addEventListener("click", function (event) {
		document.querySelector(".newPostWrap").classList.add("showNewPostForm");
	});
}
// close new post form
const closeNewPostForm = document.querySelector(".shareClose");
if (closeNewPostForm) {
	closeNewPostForm.addEventListener("click", function (event) {
		document.querySelector(".newPostWrap").classList.remove("showNewPostForm");
		document.querySelector(".jsMessage").classList.remove("showError");
	});
}
// replace post content with form
function replacePostWithForm(editButton) {
	let postElement = editButton.parentElement.parentElement.parentElement.parentElement.parentElement;
	let postContent = postElement.querySelector(".postContent");
	postContent.classList.toggle("postContentHide");
	let editForm = postElement.querySelector(".editPostForm");
	editForm.classList.toggle("editPostFormShow");
	if (postContent.classList.contains("postContentHide")) {
		editButton.innerHTML = "Close";
	} else {
		editButton.innerHTML = "Edit";
	}
}
const editButtons = document.querySelectorAll(".editButton");
editButtons.forEach (function(editButton) {
	editButton.addEventListener("click", function (event) {
		event.preventDefault();
		replacePostWithForm(editButton);
	});
});

// repalce comment content with form
function replaceCommentWithForm(editCommentButton) {
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
}
const editCommentButtons = document.querySelectorAll(".editCommentButton");
editCommentButtons.forEach (function(editCommentButton) {
	editCommentButton.addEventListener("click", function (event) {
		event.preventDefault();
		replaceCommentWithForm(editCommentButton);
	});
});

// show reply to comment fields
function showReplyForm(replyButton) {
	let commentDiv = replyButton.parentElement.parentElement.parentElement.parentElement;
	let replyInputFields = commentDiv.querySelector(".replyFields");
	replyInputFields.classList.toggle("replyFieldsShow");
	if (replyInputFields.classList.contains("replyFieldsShow")) {
		replyButton.innerHTML = "Close.";
	} else {
		replyButton.innerHTML = "Reply to this.";
	}
}
const replyToComment = document.querySelectorAll(".replyButton");
replyToComment.forEach (function(replyButton) {
	replyButton.addEventListener("click", function (event) {
		event.preventDefault();
		showReplyForm(replyButton);
	});
});

// show settings with edit and delete buttons
function showSettings(showSettingsButton) {
	let postButtonsForm = showSettingsButton.parentElement;
	let postSettingsButtons = postButtonsForm.querySelector(".postSettingsButtons");
	postSettingsButtons.classList.toggle("postSettingsButtonsShow");
}
const showPostSettings = document.querySelectorAll(".showPostSettings");
showPostSettings.forEach (function (showSettingsButton) {
	showSettingsButton.addEventListener("click", function (event) {
		event.preventDefault();
		showSettings(showSettingsButton);
	});
});

// show comments
function clickToShowComments(showComments) {
	let commentWrap = showComments.parentElement;
	let comments = commentWrap.querySelector(".comments");
	comments.classList.toggle("commentsShow");
	let readOrClose = showComments.querySelector(".readOrClose");
	if (comments.classList.contains("commentsShow")) {
		readOrClose.innerHTML = "Close";
	} else {
		readOrClose.innerHTML = "Read";
	}
}
const showCommentsLink = document.querySelectorAll(".commentLink");
showCommentsLink.forEach (function (showComments) {
	showComments.addEventListener("click", function (event) {
		clickToShowComments(showComments);
	});
});

// log in link from comments
const joinAndDiscuss = document.querySelectorAll(".joinAndDiscuss");
if (joinAndDiscuss) {
	joinAndDiscuss.forEach (function (loginLink) {
		loginLink.addEventListener("click", function (event) {
			document.body.classList.toggle("navigationOpen");
		});
	});
}
// login link on auth page when there is no posts
const join = document.querySelector(".joinLinkify");
if (join) {
	join.addEventListener("click", function (event) {
		document.body.classList.toggle("navigationOpen");
	});
}
