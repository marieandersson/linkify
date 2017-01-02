"use strict";
// handle new post
const commentPostButtons = document.querySelectorAll(".commentPost");
commentPostButtons.forEach (function(commentButton) {
	commentButton.addEventListener("click", function(event) {
		event.preventDefault();
		let comment = document.querySelector(".inputComment input[name=comment]").value;
		let postId = document.querySelector(".inputComment input[name=postId]").value;
		let errorMessage = document.querySelector(".jsMessage");
		// check if all fields has content
		if (comment == "") {
			errorMessage.innerHTML = "Write a comment before posting.";
			errorMessage.classList.add("showError"); // remove later?
		} else {
			// put form input in object
			let postData = new FormData();
			postData.append("comment", comment);
			postData.append("postId", postId);
			postData.append("commentPost", "submit");
			// post to the php script handling post requests for new posts
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
						// if success remove error reset form
						errorMessage.classList.remove("showError");
						document.querySelector(".commentForm").reset();
						console.log("sucess!");
						// and display new comment
						// let newComment = document.createElement("div");
						// newPost.innerHTML = result;
						// newPost.classList.add("post");
						// let allPosts = document.querySelector(".displayPosts");
						// allPosts.insertBefore(newPost, allPosts.firstChild);
						// problem: en 1:a visas?, redan inlästa script funkar inte.
					});
				}
			});
		}
	});
});
