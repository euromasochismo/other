<?php

session_start();

require_once 'php/lib/meekrodb.2.2.class.php';
require_once 'php/bootstrap.php';
require_once 'php/mod.generate.php';

Generate::update_registro('download');

// Lunghezza max riga
$max_length = 42;

// Alloc imagine
$image = imagecreate(900,300);

// Colore sfondo
$stored_color = (array_key_exists('color', $_GET)) ? $_GET['color'] : ((array_key_exists('generate', $_SESSION)) ? $_SESSION['generate']['color'] : '000');
list($r, $g, $b) = hex2rgb($stored_color);
$color = imagecolorallocate($image, $r, $g, $b);
// Colore testo
$white = ImageColorAllocate($image, 255,255,255);
// Font
$font = 'fonts/NewsCycle-Bold.ttf';
$size = 35;
// Testo
$text = (array_key_exists('phrase', $_GET)) ? urldecode($_GET['phrase']) : ((array_key_exists('generate', $_SESSION)) ? $_SESSION['generate']['phrase'] : '...');
// Capoverso
$text = wordwrap($text, $max_length, "\n");

// Frase
imagettftext($image, $size, 0, 50, 70, $white, $font, $text);

// URL
$font = 'fonts/playtime.ttf';
$size = 18;
imagettftext($image, $size, 0, 640, 280, $white, $font, 'http://facciamocome.org');
// ID
$id = (isset($_SESSION['generate'])) ? ((array_key_exists('id', $_SESSION['generate'])) ? $_SESSION['generate']['id'] : '...') : '...';
imagettftext($image, $size, 0, 50, 280, $white, $font, $id);

// Logo Euromasochismo
// $logo = imagecreatefromjpeg('images/euromasochismo.jpeg');
// imagecopy($image, $logo, 50, 250, 0, 0, 35, 35);

// HEADERS

if (!isset($_GET['nodownload'])) {

    header("Pragma: public");
    header("Expires: -1");
    header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
    header('Content-Disposition: attachment; filename="'.time().'"');

}

if (isset($_GET['filetype']) and $_GET['filetype'] == 'jpeg') {
	header('Content-Type: image/jpeg');
	imagejpeg($image, null, 100);
} else {
	header('Content-Type: image/png');
	imagepng($image);
}

imagedestroy($image);

// ------------------------------------------------------------------
// CONVERTE HEX > RGB

function hex2rgb($hex) {

 	if(strlen($hex) == 3) {
    $r = hexdec(substr($hex,0,1).substr($hex,0,1));
    $g = hexdec(substr($hex,1,1).substr($hex,1,1));
    $b = hexdec(substr($hex,2,1).substr($hex,2,1));
 	} else {
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
 	}

 	$rgb = array($r, $g, $b);
 	//return implode(",", $rgb); // returns the rgb values separated by commas
 	return $rgb; // returns an array with the rgb values

}