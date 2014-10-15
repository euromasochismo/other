$(document).ready(function() {

	$.fn.instantSearch();

	setTimeout(function(){ $('input#campoCerca').focus(); }, 1000);

	$('#picker table#lista td').on('click', function(e) {
		e.preventDefault();
		var type = $(this).closest('table').attr('itemType');
		parent.$('input#pick'+type).val($(this).text());
		parent.$('input#pick'+type+'Id').val($(this).attr('idItem'));
		$.colorbox.close();
	})
})