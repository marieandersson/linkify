"use strict";

// handle up vote
const upVoteButtons = document.querySelectorAll(".up");
upVoteButtons.forEach (function(upVoteButton) {
	if (upVoteButton) {
		// set color on arrows on already voted posts
		setColorOnVoted(upVoteButton, "up");
		upVoteButton.addEventListener("click", function(event) {
			event.preventDefault();
			let isUserLoggedIn = upVoteButton.parentElement.querySelector(".loggedInUser").value;
			if (isUserLoggedIn == "noLoggedInUser") {
				// user can not vote if not logged in, open log in form
				document.body.classList.add("navigationOpen");
			} else {
				handleVote(upVoteButton, "up", 1);
			}
		});
	}
});

// handle down vote
const downVoteButtons = document.querySelectorAll(".down");
downVoteButtons.forEach (function(downVoteButton) {
	if (downVoteButton) {
		// set color on arrows on already voted posts
		setColorOnVoted(downVoteButton, "down");
		downVoteButton.addEventListener("click", function(event) {
			event.preventDefault();
			let isUserLoggedIn = downVoteButton.parentElement.querySelector(".loggedInUser").value;
			if (isUserLoggedIn == "noLoggedInUser") {
				// user can not vote if not logged in, open log in form
				document.body.classList.add("navigationOpen");
			} else {
				handleVote(downVoteButton, "down", -1);
			}
		});
	}
});

function setColorOnVoted(button, vote) {
	let postId = button.parentElement.querySelector(".postIdForVote").value;
	let loggedInUser = button.parentElement.querySelector(".loggedInUser").value;
	if (localStorage.getItem(loggedInUser+":vote"+postId) == vote) {
		button.style.borderColor = "#ab987a";
	}
}

function handleVote(voteButton, vote, number) {
	let postId = voteButton.parentElement.querySelector(".postIdForVote").value;
	let postUserId = voteButton.parentElement.querySelector(".postUserIdForVote").value;
	let loggedInUser = voteButton.parentElement.querySelector(".loggedInUser").value;
	let errorMessage = document.querySelector(".jsMessage");
	// check local storage to see if user already voted on post
	if (localStorage.getItem(loggedInUser+":vote"+postId) == vote) {
		errorMessage.innerHTML = "You have already voted " + vote + " on this link.";
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
		// fetch php script handling votes
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
					// update vote count and color on vote arrow
					if (result == "vote replaced") {
						votes.innerHTML = Number(votes.innerHTML) + number + number;
						if (number == -1) {
							voteButton.parentElement.querySelector(".up").style.borderColor = "#778899";
						} else {
							voteButton.parentElement.querySelector(".down").style.borderColor = "#778899";
						}
						// put vote in local storage
						localStorage.setItem(loggedInUser+":vote"+postId, vote);
					}
					if (result == "new vote saved") {
						votes.innerHTML = Number(votes.innerHTML) + number;
						// put vote in local storage
						localStorage.setItem(loggedInUser+":vote"+postId, vote);
					}
					voteButton.style.borderColor = "#ab987a";
				});
			}
		});
	}
}
