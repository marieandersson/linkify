// handle post request for new comment without page reload
const commentPostButtons = document.querySelectorAll(".commentPost");
commentPostButtons.forEach (function(commentButton) {
	commentButton.addEventListener("click", function(event) {
		handleCommentPost(commentButton);
	});
});

function handleCommentPost(commentButton) {
	event.preventDefault();
	let comment = commentButton.parentElement.querySelector(".inputComment input[name=comment]").value;
	let postId = commentButton.parentElement.querySelector(".inputComment input[name=postId]").value;
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
					// if success remove error and reset form
					errorMessage.classList.remove("showError");
					commentButton.parentElement.parentElement.reset();
					// and display new comment
					let newComment = document.createElement("div");
					newComment.innerHTML = result;
					newComment.classList.add("commentWrap");
					// append new comment to post
					let postDiv = commentButton.parentElement.parentElement.parentElement;
					let commentElement = postDiv.querySelector(".comments");
					// if this is the first comment create comments div
					if (commentElement === null) {
						let commentElement = document.createElement("div");
						commentElement.classList.add("comments");
						commentElement.classList.add("commentsShow");
						commentElement.appendChild(newComment);
						postDiv.appendChild(commentElement);
					} else {
						// else append to existing comment div
						commentElement.insertBefore(newComment, commentElement.firstChild);
						commentElement.classList.add("commentsShow");
						// add commentcount paragraph?
					}
					// add eventlistener to new comment post
					replaceCommentWithForm();
					showSettings();
					showReplyForm();
				});
			}
		});
	}
}
