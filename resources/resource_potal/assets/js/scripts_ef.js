$(function() {
	$('#navbar').affix({
		offset: {
			top: 20
		}
	});

	$("pre.html").snippet("html", {style:'matlab'});
	$("pre.css").snippet("css", {style:'matlab'});
	$("pre.javascript").snippet("javascript", {style:'matlab'});

	$('#paginationClass_ef').easyPaginate({
		paginateElement: 'div.my_ef',
		elementsPerPage: 40,
		effect: 'slide'
	});
});