'use strict';

// show navigation on click
const menuButton = document.querySelector(".menuLink");
menuButton.addEventListener("click",  event => {
	document.body.classList.toggle("navigationOpen");
});

// close navigation
const closeNavButton = document.querySelector(".menuClose");
closeNavButton.addEventListener("click", event => {
	document.body.classList.remove("navigationOpen");
});

// keep navigation open if error message is displayed
const errorMessage = document.querySelector(".loginError");
if (errorMessage) {
	if (errorMessage.innerHTML !== "") {
		document.body.classList.add("navigationOpen");
	}
}
