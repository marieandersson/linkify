"use strict";

const saveReplyButtons = document.querySelectorAll(".replySubmit");
saveReplyButtons.forEach(function(saveReplyButton) {
	saveReplyButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleReply(saveReplyButton);
	});
});

function handleReply(saveReplyButton) {
	let commentId = saveReplyButton.parentElement.parentElement.querySelector(".commentIdReply").value;
	let postId = saveReplyButton.parentElement.parentElement.querySelector(".postIdReply").value;
	let comment = saveReplyButton.parentElement.parentElement.querySelector(".replyFields input[name=comment]").value;
	let errorMessage = document.querySelector(".jsMessage");

	if (comment == "") {
		errorMessage.innerHTML = "Write a comment before posting.";
		errorMessage.classList.add("showError");
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("comment", comment);
		postData.append("postId", postId);
		postData.append("commentId", commentId);
		postData.append("replySubmit", "submit");
		// post to the php script handling post requests for new comments
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
					saveReplyButton.parentElement.parentElement.reset();
					// display reply
					let newReply = document.createElement("div");
					newReply.innerHTML = result;
					newReply.classList.add("replyWrap");

					let commentWrap = saveReplyButton.parentElement.parentElement.parentElement.parentElement;
					let replies = commentWrap.querySelector(".replies");
					replies.insertBefore(newReply, replies.firstChild);
				});
			}
		});
	}
}
