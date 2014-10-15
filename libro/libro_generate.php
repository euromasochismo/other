<?php

	require_once '../php/lib/meekrodb.2.2.class.php';
	require_once '../php/bootstrap.php';
	require_once '../php/lib/mpdf/mpdf.php';
	require_once '../php/helpers.php';
	require_once '../php/mod.api.php';
	require_once '../php/mod.generate.php';
	require_once '../php/mod.libro.php';

	$mpdf = new mPDF();

	// ----------------------------
	// COPERTINA (html1)

	$cover = Libro::get_copertina();

	$mpdf->WriteHTML($cover);

	// ----------------------------
	// TESTO (html2)

	$testo = Libro::get_testo();

	$mpdf->SetTopMargin(25);

	// HEADER

	$header = array (
    'L' => array (
      'content' => 'Facciamo Come',
      'font-size' => 10,
      'font-style' => 'I',
      'font-family' => 'Garamondopen',
      'color'=>'#000000'
    ),
    'C' => array (
    ),
    'R' => array (
      'content' => 'Un prontuario di supercazzole esterofile e piddine',
      'font-size' => 10,
      'font-style' => 'I',
      'font-family' => 'Garamondopen',
      'color'=>'#000000'
    ),
    'line' => 1,
	);

	$mpdf->SetHeader($header, 'O');  // E for Even header

	// FOOTER

	$footer = array (
    'L' => array (),
    'C' => array (),
    'R' => array (
      'content' => '{PAGENO}',
      'font-size' => 10,
      'font-family' => 'Garamondopen',
      'color'=>'#000000'
    ),
    'line' => 0,
	);

	$mpdf->SetFooter($footer, 'O');  // E for Even header

	$mpdf->WriteHTML($testo);

	// ----------------------------
	// INDICE ANALITICO (indice_analitico)

	$testo = Libro::get_indice_analitico();
	$mpdf->WriteHTML($testo);

	// ----------------------------
	// INDICE DEGLI AUTORI (indice_autori)

	$testo = Libro::get_indice_autori();
	$mpdf->WriteHTML($testo);

	// ----------------------------
	// COVER CHIUSURA (back_cover)

	// Disabilita header e footer

	$header['L']['content'] = '';
	$header['R']['content'] = '';
	$header['line'] = 0;

	$mpdf->SetHeader($header, 'O');

	$footer['R']['content'] = '';
	$mpdf->SetFooter($footer, 'O');

	$last_cover = Libro::get_html('back_cover');
	$mpdf->WriteHTML($last_cover);

	$mpdf->Output();
	exit;

?>