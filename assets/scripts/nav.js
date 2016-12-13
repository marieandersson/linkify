'use strict';

let menuButton = document.querySelector(".menuLink");
menuButton.addEventListener("click",  event => {
		document.body.classList.toggle('navigationOpen');
});
