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
	let postId = deleteButton.parentElement.querySelector(".postButtonsId").value;
	console.log(postId);
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

// handle post request for editing post without page reload
const saveEditButtons = document.querySelectorAll(".saveEdit");
saveEditButtons.forEach (function(editButton) {
	editButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleEditPost();
	});
});
function handleEditPost() {

	let subject = document.querySelector(".newPostFields input[name=subject]").value;
	let url = document.querySelector(".newPostFields input[name=url]").value;
	let description = document.querySelector(".newPostFields input[name=description]").value;
	let errorMessage = document.querySelector(".jsMessage");
}
