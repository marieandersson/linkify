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
	let loggedInUser = voteButton.parentElement.querySelector(".loggedInUser").value;
	let errorMessage = document.querySelector(".jsMessage");
	// check local storage to see if user already voted on post
	if (localStorage.getItem(loggedInUser+":vote"+postId) == vote) {
		errorMessage.innerHTML = "You can only vote " + vote + " once.";
		errorMessage.classList.add("showError");
	} else if (postUserId == loggedInUser) {
		errorMessage.innerHTML = "Sorry, you can't vote on you own post.";
		errorMessage.classList.add("showError");
	} else {
		// remove error
		errorMessage.classList.remove("showError");
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
					//remove error
					errorMessage.classList.remove("showError");
					let votes = voteButton.parentElement.querySelector(".votes");
					if (result == "vote replaced") {
						votes.innerHTML = Number(votes.innerHTML) + number + number;
						// put vote in local storage
						localStorage.setItem(loggedInUser+":vote"+postId, vote);
					}
					if (result == "new vote saved") {
						votes.innerHTML = Number(votes.innerHTML) + number;
						// put vote in local storage
						localStorage.setItem(loggedInUser+":vote"+postId, vote);
					}
				});
			}
		});
	}
}
