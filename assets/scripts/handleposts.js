// handle post requests from forms
"use strict";
// post new link form
const submitLinkButton = document.querySelector(".postLink");
submitLinkButton.addEventListener("click", function(event) {
	event.preventDefault();
	let subject = document.querySelector(".newPostFields input[name=subject]").value;
	let url = document.querySelector(".newPostFields input[name=url]").value;
	let description = document.querySelector(".newPostFields input[name=description]").value;
	// check if all fields has content
	if (subject == "" || url == "" || description == "") {
		let errorMessage = document.querySelector(".jsMessage");
		errorMessage.innerHTML = "Please fill out all fields.";
		errorMessage.classList.add("showError"); // remove later?
		// also validate url?
	} else {
		let postData = new FormData();
		postData.append("subject", subject);
		postData.append("url", url);
		postData.append("description", description);
		postData.append("postLink", "share");
		fetch("/app/posts/newpost.php",
		{
			method: "POST",
			body: postData,
			credentials: "same-origin",
		})
		.then(function(response) {
			return response.text();
		})
		.then(function(result) {

		});
	}

});
