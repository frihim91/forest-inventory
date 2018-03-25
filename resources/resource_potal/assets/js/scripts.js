$(function() {
	$('#navbar').affix({
		offset: {
			top: 20
		}
	});

	$("pre.html").snippet("html", {style:'matlab'});
	$("pre.css").snippet("css", {style:'matlab'});
	$("pre.javascript").snippet("javascript", {style:'matlab'});
    
	$('#paginationClass').easyPaginate({
		paginateElement: 'div.my',
		elementsPerPage: 20,
		effect: 'slide'
	});

	// $('#results-list-mymy').easyPaginate({
	// 	paginateElement: 'div.mymy',
	// 	elementsPerPage: 20,
	// 	effect: 'slide'
	// });

	$('#paginationClass_raw').easyPaginate({
		paginateElement: 'div.my_raw',
		elementsPerPage: 20,
		effect: 'slide'
	});

	$('#paginationClass_wd').easyPaginate({
		paginateElement: 'div.my_wd',
		elementsPerPage: 20,
		effect: 'slide'
	});
	
	


	$('#paginationClass_ef').easyPaginate({
		paginateElement: 'div.my_ef',
		elementsPerPage: 40,
		effect: 'slide'
	});


});