$(document).ready(function() {

	$.fn.instantSearch({focusOnSearch: true});

	// Aggiungi nuova

	$('a#aggiungi-nuova').colorbox({

		href: 'frase.php?id=new',
		width: '960',
		height: '400'

	});

	// Edit riga

	$('a.edit').click(function(e) {

		e.preventDefault();
		var id = $(this).attr("template-id");
		$(this).colorbox({

			href: 'frase.php?id='+id,
			width: '960',
			height: '400'

		});

	});

})