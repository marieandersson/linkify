'use strict';

// slide in auth forms
function slideInDiv(div) {
	let page = document.querySelector(".page");
	page.style.width = "75%";
	page.style.animation = "shrinkWidth 0.5s linear";
	div.style.display = "block";
}

let loginLink = document.querySelector(".loginLink");

loginLink.addEventListener("click", function(event) {
	let div = document.querySelector(".menuSlideDiv");
	slideInDiv(div);
});
