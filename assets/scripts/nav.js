'use strict';

// show navigation on click
const menuButtons = document.querySelectorAll(".menuLink");
menuButtons.forEach(function(menuButton) {
	menuButton.addEventListener("click",  event => {
		document.body.classList.toggle("navigationOpen");
	});
});
// keep navigation open if error message is displayed
const errorMessage = document.querySelector(".loginError");
if (errorMessage.innerHTML !== "") {
	document.body.classList.add("navigationOpen");
}

// close navigation
const closeNavButton = document.querySelector(".menuClose");
closeNavButton.addEventListener("click", event => {
	document.body.classList.remove("navigationOpen");
});
