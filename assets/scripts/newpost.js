"use strict";
// handle new post
const submitLinkButton = document.querySelector(".postLink");
submitLinkButton.addEventListener("click", function(event) {
	event.preventDefault();
	let subject = document.querySelector(".newPostFields input[name=subject]").value;
	let url = document.querySelector(".newPostFields input[name=url]").value;
	let description = document.querySelector(".newPostFields input[name=description]").value;
	let errorMessage = document.querySelector(".jsMessage");
	// check if all fields has content
	if (subject == "" || url == "" || description == "") {
		errorMessage.innerHTML = "Please fill out all fields.";
		errorMessage.classList.add("showError"); // remove later?
	} else {
		// put form input in object
		let postData = new FormData();
		postData.append("subject", subject);
		postData.append("url", url);
		postData.append("description", description);
		postData.append("postLink", "share");
		// post to the php script handling post requests for new posts
		fetch("/app/posts/newpost.php",
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
					document.querySelector(".newPostForm").reset();
					// and display new post
					let newPost = document.createElement("div");
					newPost.innerHTML = result;
					newPost.classList.add("post");
					let allPosts = document.querySelector(".displayPosts");
					allPosts.insertBefore(newPost, allPosts.firstChild);
					// problem: edan inlästa script funkar inte.
					showSettings();
				});
			}
		});
	}
});
