"use strict";

// replace post content with form
const editButtons = document.querySelectorAll(".editButton");
editButtons.forEach (function(editButton) {
  editButton.addEventListener("click", function (event) {
		event.preventDefault();
		let postElement = editButton.parentElement.parentElement.parentElement;
		let postContent = postElement.querySelector(".postContent");
		postContent.classList.toggle("postContentHide");
		let editForm = postElement.querySelector(".editPostForm");
		editForm.classList.toggle("editPostFormShow");
		if (postContent.classList.contains("postContentHide")) {
			editButton.innerHTML = "Close";
		} else {
			editButton.innerHTML = "Edit";
		}
	});
});
// repalce comment content with form
const editCommentButtons = document.querySelectorAll(".editCommentButton");
editCommentButtons.forEach (function(editCommentButton) {
	editCommentButton.addEventListener("click", function (event) {
		event.preventDefault();
		let commentElement = editCommentButton.parentElement.parentElement;
		let commentContent = commentElement.querySelector(".commentContent");
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
