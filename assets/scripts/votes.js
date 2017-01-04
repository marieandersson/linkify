"use strict";

// handle up vote
const upVoteButtons = document.querySelectorAll(".up");
upVoteButtons.forEach (function(upVoteButton) {
	upVoteButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleVote(upVoteButton, "up", 1);
	});
});

// handle down vote
const downVoteButtons = document.querySelectorAll(".down");
downVoteButtons.forEach (function(downVoteButton) {
	downVoteButton.addEventListener("click", function(event) {
		event.preventDefault();
		handleVote(downVoteButton, "down", -1);
	});
});

function handleVote(voteButton, vote, number) {
	let postId = voteButton.parentElement.querySelector(".postIdForVote").value;
	let postUserId = voteButton.parentElement.querySelector(".postUserIdForVote").value;
	let errorMessage = document.querySelector(".jsMessage");
	// put form input in object
	let postData = new FormData();
	postData.append("postIdForVote", postId);
	postData.append("postUserIdForVote", postUserId);
	postData.append(vote, "vote");
	// post to php script handling votes
	fetch("app/posts/votes.php",
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
				let votes = oteButton.parentElement.querySelector(".votes");
				if (result == "vote replaced") {
					votes.innerHTML = Number(votes.innerHTML) + number + number;
				}
				if (result == "new vote saved") {
					votes.innerHTML = Number(votes.innerHTML) + number;
				}
			});
		}
	});
}
