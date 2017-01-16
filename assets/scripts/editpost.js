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
	// response after php script have been executed
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
		handleEditPost(editButton);
	});
});
function handleEditPost(editButton) {
	let postId = editButton.parentElement.querySelector(".postIdForEdit").value;
	let subject = editButton.parentElement.querySelector(".editInputField input[name=editSubject]").value;
	let url = editButton.parentElement.querySelector(".editInputField input[name=editUrl]").value;
	let description = editButton.parentElement.querySelector(".editInputField input[name=editDescription]").value;
	let errorMessage = document.querySelector(".jsMessage");

	if (subject == "" || url == "" || description == "") {
		errorMessage.innerHTML = "Please fill out all fields.";
		errorMessage.classList.add("showError");
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("postIdForEdit", postId);
		postData.append("editSubject", subject);
		postData.append("editUrl", url);
		postData.append("editDescription", description);
		postData.append("saveEdit", "save");
		// post to php script handling post requests for edit posts
		fetch("/app/posts/editpost.php",
		{
			method: "POST",
			body: postData,
			credentials: "same-origin",
		})
		// response after php script have been executed
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
					// replace post content
					let postElement = document.querySelector(".post"+postId);
					postElement.querySelector(".postWrap h4 a").innerHTML = subject;
					postElement.querySelector(".postWrap h4 a").href = url;
					postElement.querySelector(".postContent p").innerHTML = description;
					postElement.querySelector(".postContent").classList.remove("postContentHide");
					postElement.querySelector(".editPostForm").classList.remove("editPostFormShow");
					postElement.querySelector(".editButton").innerHTML = "Edit";
					postElement.querySelector(".postSettingsButtons").classList.remove("postSettingsButtonsShow");
				});
			}
		});
	}
}
