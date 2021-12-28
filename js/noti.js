'use strict';

// Written using ES5 JS for browser support
window.addEventListener('DOMContentLoaded', function () {
	var form = document.querySelector('#lista-productos');

	form.addEventListener('submit', function (e) {
		e.preventDefault();

		window.createNotification({
			closeOnClick: closeOnClick,
			displayCloseButton: displayClose,
			positionClass: position,
			showDuration: duration,
			theme: theme
		})({
			title: title,
			message: message
		});
	});
});