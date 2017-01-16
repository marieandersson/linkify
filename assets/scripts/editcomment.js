"use strict";

// handle post request for deleting comments without page reload
const deleteCommentButtons = document.querySelectorAll(".deleteComment");
deleteCommentButtons.forEach (function(deleteButton) {
	deleteButton.addEventListener("click", function(event) {
		event.preventDefault();
		if (window.confirm("Are you sure you want to delete this comment?")) {
			handleCommentDelete(deleteButton);
		}
	});
});

function handleCommentDelete(deleteButton) {
	let commentId = deleteButton.parentElement.querySelector(".commentId").value;
	// put form input in object
	let postData = new FormData();
	postData.append("commentId", commentId);
	postData.append("deleteComment", "delete");
	// post to php script handling requests for deleting comments
	fetch("/app/posts/comments.php",
	{
		method: "POST",
		body: postData,
		credentials: "same-origin",
	})
	// response after php script has been executed
	.then(function(response) {
		let commentElement = document.querySelector(".comment"+commentId).parentElement;
		// if no comments left for post remove comments div and comment link
		let comments = commentElement.parentElement;
		commentElement.remove();
		// separate last comment left from last reply left
		if (comments.classList.contains("comments")) {
			let childNodes = comments.childNodes;
			let containsElement = false;
			// loop through node list to check for element nodes (ignoring text nodes)
			childNodes.forEach (function(node) {
				if (node.nodeType == Node.ELEMENT_NODE) {
					containsElement = true;
				}
			});
			if (containsElement == false) {
				comments.parentElement.querySelector(".commentLink").innerHTML = "";
				comments.remove();
			}
		}
	});
}

// handle post request for editing comments without page reload
const saveCommentEditButtons = document.querySelectorAll(".saveEditComment");
saveCommentEditButtons.forEach(function(editButton) {
	editButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleEditComment(editButton);
	});
});
function handleEditComment(editButton) {
	let commentId = editButton.parentElement.querySelector(".commentIdForEdit").value;
	let comment = editButton.parentElement.querySelector(".editComment").value;
	let errorMessage = document.querySelector(".jsMessage");

	if (comment == "") {
		errorMessage.innerHTML = "Comment can't be empty.";
		errorMessage.classList.add("showError");
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("commentIdForEdit", commentId);
		postData.append("editComment", comment);
		postData.append("saveEditComment", "save");
		// post to php script handling post request for editing comments
		fetch("/app/posts/comments.php",
		{
			method: "POST",
			body: postData,
			credentials: "same-origin",
		})
		// response after php script has been executed
		.then(function(response) {
			// if error
			if (!response.ok) {
				return response.text().then(function(error) {
					errorMessage.innerHTML = error;
					errorMessage.classList.add("showError");
				});
			} else {
				return response.text().then(function(result) {
					// if sucess remove possible error
					errorMessage.classList.remove("showError");
					// replace comment content
					let commentElement = document.querySelector(".comment"+commentId);
					commentElement.querySelector(".commentContent").innerHTML = comment;
					commentElement.querySelector(".commentDiv").classList.remove("commentHide");
					commentElement.querySelector(".editCommentForm").classList.remove("editCommentFormShow");
					commentElement.querySelector(".editCommentButton").innerHTML = "Edit";
					commentElement.querySelector(".postSettingsButtons").classList.remove("postSettingsButtonsShow");
				});
			}
		});
	}
}
