'use strict';

// if cookies not accepted
if (!localStorage.getItem("acceptCookies")) {
	const element = document.querySelector(".acceptCookies");
  const button = document.querySelector('.cookieButton');
  // show cookie alert div
	element.classList.add("cookieShow");
	button.addEventListener('click', event => {
  // save users cookie acceptance in local storage
  localStorage.setItem("acceptCookies", true);
  // hide cookie alert div
  element.classList.remove("cookieShow");
  });
}
