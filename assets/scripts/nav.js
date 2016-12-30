'use strict';

// show navigation on click
const menuButtons = document.querySelectorAll(".menuLink");
menuButtons.forEach(function(menuButton) {
	menuButton.addEventListener("click",  event => {
		document.body.classList.toggle("navigationOpen");
	});
});
// keep navigation open if error message is displayed
const errorMessages = document.querySelectorAll(".error");
errorMessages.forEach(function(message) {
	if (message.innerHTML !== "") {
		document.body.classList.add("navigationOpen");
	}
});
