$(document).ready(function() {

	loadPhrase();

	$('a.generate').click(function(e) { 

		e.preventDefault();
		loadPhrase();

	})

	// PERSONALIZZA

	// Tasto personalizza per mostrare il modulo
	/* $('a#showPersonalizza').click(function(e) { 

		e.preventDefault();
		$('div.personalizza').slideToggle();

	}) */

	// Click su campo frase
	$('input#pickPhrase').colorbox({

		href: 'includes/pick_template.php',
		width: '960',
		height: '500'

	})

	// Click su campo paese
	$('input#pickCountry').colorbox({

		href: 'includes/pick_country.php',
		width: '960',
		height: '500'

	})

	// Click su facebook
	/* $('a#facebook').click(function(e) {

		e.preventDefault();
		facebookOpenWindow();

	}) */

})

function loadPhrase() {

	var domPhrase = $('.title h2');
	domPhrase.html('<img src="images/ajax-loader.gif">');

	var templateId = $('input#pickPhraseId').val();
	var countryId = $('input#pickCountryId').val();
	var taggoId = $('select#pickTaggoId').val();

	$('#share').css('visibility', 'hidden');
	$('#tweet iframe').remove();

	var url = 'generate.php?template='+templateId+'&country='+countryId+'&tag='+taggoId;
	// alert(url);

	$.getJSON(url, function(data) {

		// FRASE
		domPhrase.text(data.phrase);

		// SFONDO
		$('#featured').css('background-color', '#'+data.color);

		// TWEET
		$.ajax({ 
			url: 'http://platform.twitter.com/widgets.js', 
			dataType: 'script', 
			cache: true,
		}).done(function() {
			tweetButton(data.phrase);
		})

		// FACEBOOK
		facebookButton(data.phrase);

	})

}

// TWEET

var tweetUrl = "https://twitter.com/intent/tweet?button_hashtag=facciamocome";

function tweetButton(phrase) {

	var tweetButton = $('<a></a>')
  	.addClass('twitter-share-button')
    .attr('href', 'http://twitter.com/share')
    .attr('data-url', 'http://facciamocome.org/')
    .attr('data-text', phrase);

  $('#tweet').html(tweetButton);
  twttr.widgets.load();
  setTimeout(function() { $('#share').css('visibility', 'block'); }, 1500);

}

// FACEBOOK

var facebookHref = "https://www.facebook.com/dialog/feed?app_id=405023762975995&display=popup&name=[PHRASE]&link=http://facciamocome.org&description="+encodeURI("Facciamocome è un generatore random di supercazzole esterofile e piddine. Se vuoi conoscere in anticipo le puttanate e luoghi comuni del mainstream piddin-montian-renziano, consulta il frasario e aiuta i tuoi amici a vergognarsi di essere italiani!")+"&redirect_uri=http://www.facebook.com";

function facebookButton(phrase) {

	var href = facebookHref.replace("[PHRASE]", encodeURI(phrase));
	$('a#facebook').attr('href', href);

}

/* function facebookOpenWindow() {

	var href = $('a#facebook').attr("href");
	window.open(href,"",'width=560,height=470,toolbar=0, menubar=0, location=0, status=0, scrollbars=0, resizable=1,left=0,top=0');
	return false;

} */
