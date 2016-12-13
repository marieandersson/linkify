'use strict';

// show navigation on click
const menuButton = document.querySelector(".menuLink");
menuButton.addEventListener("click",  event => {
		document.body.classList.toggle("navigationOpen");
});
// keep navigation open if error message is displayed
const errorMessages = document.querySelectorAll(".authMessage");
errorMessages.forEach(function(message) {
	if (message.innerHTML !== "") {
		document.body.classList.add("navigationOpen");
	}
});
