"use strict";

// handle post request for deleting post without page reload
const deletePostButtons = document.querySelectorAll(".deleteButton");
deletePostButtons.forEach (function(deleteButton) {
	deleteButton.addEventListener("click", function(event) {
		event.preventDefault();
		if (window.confirm("Are you sure you want to delete this post?")) {
			handlePostDelete(deleteButton);
		}
	});
});

function handlePostDelete(deleteButton) {
	let postId = document.querySelector(".postSettingsButtons input[name=postId]").value;
	// put form input in object
	let postData = new FormData();
	postData.append("postId", postId);
	postData.append("deletePost", "delete");
	// post to php script handling requests for deleting post
	fetch("/app/posts/editpost.php",
	{
		method: "POST",
		body: postData,
		credentials: "same-origin",
	})
	// response after php script have been executed{
	.then(function(response) {
			let postElement = document.querySelector(".post"+postId).parentElement;
			postElement.remove();
	});
}
