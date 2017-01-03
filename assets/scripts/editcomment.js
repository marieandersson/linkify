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
	// response after php script have been executed
	.then(function(response) {
		let commentElement = document.querySelector(".comment"+commentId).parentElement;
		// if no comments left for post remove comments div and commentcount
		let comments = commentElement.parentElement;
		commentElement.remove();
		let childNodes = comments.childNodes;
		let containsElement = false;
		// loop through node list to check for element nodes (ignoring text nodes)
		for (let node of childNodes.entries()) {
			if (node.nodeType == Node.ELEMENT_NODE) {
				containsElement = true;
				break;
			}
		}
		if (containsElement == false) {
			comments.parentElement.querySelector(".commentCount").innerHTML = "";
			comments.remove();
		}
	});
}
