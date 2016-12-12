'use strict';

let loginLink = document.querySelector(".loginLink");

loginLink.addEventListener("click", function(event) {
	let forms = document.querySelector(".forms");
	forms.style.display = "block";
	let page = document.querySelector(".page");
	page.style.animation = "shrinkWidth 0.5s linear";
	page.style.width = "75%";

});
