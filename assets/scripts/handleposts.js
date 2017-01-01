// handle post requests from forms
"use strict";
// post new link form
const submitLinkButton = document.querySelector(".postLink");
submitLinkButton.addEventListener("click", function(event) {
	event.preventDefault();
	let subject = document.querySelector(".subject").value;
	let url = document.querySelector(".url").value;
	let description = document.querySelector(".description").value;
	let errorMessage = document.querySelector(".jsMessage");
	if (subject == "" || url == "" || description == "") {
		errorMessage.innerHTML = "Please fill out all fields.";
		errorMessage.classList.add("showError"); // remove later?
		return;
	}
	//validate url

});


// vad händer med valideringen?
