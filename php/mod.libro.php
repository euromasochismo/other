<?php

Class Libro {

	// COVER
	public static function get_copertina() {

		$bk = array();

		self::set_n_edizione();
		$bk['n_edizione'] = Generate::get_registro('libro');
		$bk['data_generazione'] = strftime("%d %h %Y");

		// Preparazione HTML

		$html = file_get_contents('../libro/copertina.php');

		foreach ($bk as $key => $value) {
			$html = str_replace("%$key%", $value, $html);
		}

		return $html;

	}

	// TESTO
	public static function get_testo() {

		$bk = array();

		$bk['n_frasi'] = number_format(Generate::get_registro('generazioni'), 0, ',', '.');
		$bk['frasi'] = self::get_frasi();

		// Preparazione HTML

		$html = file_get_contents('../libro/testo.php');

		foreach ($bk as $key => $value) {
			$html = str_replace("%$key%", $value, $html);
		}

		return $html;

	}


	// INDICE ANALITICO
	public static function get_indice_analitico() {

		$bk = array();

		$bk['tagghi'] = self::get_tagghi();

		// Preparazione HTML
		$html = file_get_contents('../libro/indice_analitico.php');

		foreach ($bk as $key => $value) {
			$html = str_replace("%$key%", $value, $html);
		}

		return $html;

	}


	// INDICE AUTORI
	public static function get_indice_autori() {

		$bk = array();

		$bk['autori'] = self::get_autori();

		// Preparazione HTML
		$html = file_get_contents('../libro/indice_autori.php');

		foreach ($bk as $key => $value) {
			$html = str_replace("%$key%", $value, $html);
		}

		return $html;

	}


	// HTML GENERICO (senza variabili)
	public static function get_html($file) {

		// Preparazione HTML

		return file_get_contents("../libro/$file.php");

	}


	// Da get_copertina
	public static function set_n_edizione() {

		return DB::query('UPDATE registri SET valore = (valore + 1) WHERE parametro = "libro"');
	
	}

	// Da get_testo
	public static function get_frasi() {
		
		$frasi = '';
		$templates = DB::query('SELECT * FROM templates WHERE attivo = 1 ORDER BY id ASC');

		foreach ($templates as $key => $template) {
			
			$country_set = Generate::get_country();
			$testo = ucfirst(Generate::replace_tokens($template, $country_set));
			$frasi .= '<p>'.$template['id'].'. '.$testo.'</p>';

		}

		return $frasi;

	}

	// Da get_indice_analitico
	public static function get_tagghi() {

		$indice = '';
		$tagghi = DB::query('SELECT * FROM tagghi ORDER BY taggo ASC');

		$indice = '<p style="font-size:0.9em">';

		foreach ($tagghi as $key => $taggo) {
			
			$indice .= ($key > 0 and ($taggo['taggo'][0] != $tagghi[$key-1]['taggo'][0])) ? '&nbsp;<br>' : '';

			$indice .= '<strong>'.$taggo['taggo'].'</strong>: ';

			if ($taggo['rimando']) {
				// Rimando
				$rimando = DB::queryOneField('taggo', "SELECT * FROM tagghi WHERE id=%i", $taggo['rimando']);
				$indice .= "<em>v. $rimando</em>";
			} else {
				// Tag "reale"
				$id_templates = DB::queryFirstColumn("SELECT key_template FROM tagghi_templates WHERE key_taggo=%i ORDER BY key_taggo ASC", $taggo['id']);
				sort($id_templates);
				$indice .= implode(', ', $id_templates);
			}

			$indice .= '.<br>';

		}

		return "</p>$indice";

	}


	public static function get_autori() {

		$indice = '';
		$autori = DB::queryFirstColumn('SELECT DISTINCT autore FROM templates WHERE autore <> "" ORDER BY autore ASC');

		foreach ($autori as $key => $autore) {
			$id_templates = DB::queryFirstColumn("SELECT id FROM templates WHERE autore = %s ORDER BY id ASC", $autore);
			// $indice .= (substr($autore, 0, 1) == '@') ? "<a href='https://twitter.com/".substr($autore, 1)."'>$autore</a>: " : "$autore: ";
			$indice .= "<strong>$autore</strong>: ";
			$indice .= implode(', ', $id_templates);
			$indice .= '.<br>';
		}

		return $indice;

	}

}
