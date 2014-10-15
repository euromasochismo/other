$(document).ready(function() {

	// Click su salva

	$("a#edit-salva").on('click', function(e) {

		e.preventDefault();
		$("form#form-edit").submit();
		// var id = $(this).attr("template-id");
		// $.colorbox.close();
	
	});

});