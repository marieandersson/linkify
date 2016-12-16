'use strict';

// replace post content with form
const editButtons = document.querySelectorAll('.editButton');
editButtons.forEach (function(editButton) {
  editButton.addEventListener('click', function (event) {
		event.preventDefault();
		let postElement = editButton.parentElement.parentElement.parentElement;
		let postContent = postElement.querySelector('.postContent');
		postContent.classList.toggle("postContentHide");
		let editForm = postElement.querySelector(".editPostForm");
		editForm.classList.toggle("editPostFormShow");
		if (postContent.classList.contains("postContentHide")) {
			editButton.innerHTML = "Close";
		} else {
			editButton.innerHTML = "Edit";
		}
	});
});
