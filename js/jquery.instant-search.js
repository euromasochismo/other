/*!
	Instant Search v0.1 - 2014-01-26
	jQuery filter table plugin
	(c) 2014 Pietro Stefano Beretta
	license: http://www.opensource.org/licenses/mit-license.php
*/

(function ( $ ) {

	// Special selector icontains (Insensitive Case Contains)

	jQuery.expr[':'].icontains = function(a, i, m) {
	  return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
	};
 
  $.fn.instantSearch = function(options) {
 		
    var settings = $.extend({
		targetClass: "instant-search",
		caseInsensitive: true,
		hideHeaderOnNull: true,
        focusOnSearch: false
	}, options);

    // Elements
    var searchField = $('input.'+settings.targetClass);
    var table = $('table.'+settings.targetClass);
    var tr = $("table."+settings.targetClass+" tbody tr");
    var counter = $('span.'+settings.targetClass);

    if (settings.focusOnSearch) searchField.focus();

    $(searchField).on("keyup", function() {
    	// Searched key (ESCAPED)
      var key = $(this).val().replace(/\(([^\)])*\)/g,"").replace(/\(|\)(.)*/g,"");
    	// Key is not null
    	if (key) {
    		var rows = $("table."+settings.targetClass+" tbody tr:icontains('"+key+"')");
    		var nRows = rows.size();
    		tr.hide();
    		rows.show();
    		counter.html(nRows);
    		if (settings.hideHeaderOnNull) {
    			if (nRows === 0) { 
    				table.hide();
    			} else { 
    				table.show(); 
    			}
    		}
    	} else {
    		tr.show();
        table.show();
    	}
    })
	}
}(jQuery));
