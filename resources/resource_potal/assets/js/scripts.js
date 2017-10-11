$(function() {
	$('#navbar').affix({
		offset: {
			top: 20
		}
	});

	$("pre.html").snippet("html", {style:'matlab'});
	$("pre.css").snippet("css", {style:'matlab'});
	$("pre.javascript").snippet("javascript", {style:'matlab'});
    
	$('#results-list').easyPaginate({
		paginateElement: 'div.my',
		elementsPerPage: 20,
		effect: 'slide'
	});

	$('#results-list-mymy').easyPaginate({
		paginateElement: 'div.mymy',
		elementsPerPage: 20,
		effect: 'slide'
	});

	$('#results-list-raw').easyPaginate({
		paginateElement: 'div.my_raw',
		elementsPerPage: 20,
		effect: 'slide'
	});
	


	$('#results-list-bio').easyPaginate({
		paginateElement: 'div.my_bio',
		elementsPerPage: 40,
		effect: 'slide'
	});


});