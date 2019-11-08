$(document).ready(function () {
	var currentItem = $('.nav-link[href="'+location.href+'"]').parents(".nav-item");
	currentItem.addClass("active");
});