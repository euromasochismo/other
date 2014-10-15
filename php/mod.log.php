<?php

Class Log {

	public static function get_stats() {

		$stats = array();

		DB::query('SELECT * FROM templates');
		$stats['template_totali'] = DB::count();

		DB::query('SELECT * FROM templates WHERE attivo = 1');
		$stats['template_attivi'] = DB::count();
		
		return $stats;

	}


	public static function get_templates($contributes = false) {

		$templates = array();
		$where = ($contributes) ? 'AND autore IS NOT NULL AND autore <> "" ' : '';

		$giorni = DB::query("SELECT DISTINCT DATE_FORMAT(quando, '%d-%m-%Y') AS giorno, quando FROM templates WHERE 1=1 $where ORDER BY quando DESC");

		foreach ($giorni as $key => $giorno) {
			$templates[$key]['giorno'] = $giorno['giorno'];
			$templates[$key]['items'] = DB::query("SELECT * FROM templates WHERE quando=%s $where ORDER BY id DESC", $giorno['quando']);
			foreach ($templates[$key]['items'] as $key2 => $template) {
				// Tokens
				$templates[$key]['items'][$key2]['frase'] = Generate::replace_tokens($template, null);
				// Autori
				// --> Twitter
				if (substr($template['autore'], 0, 1) == '@') {
					$templates[$key]['items'][$key2]['autore'] = ' (via <a href="https://twitter.com/'.str_replace('@', '', $template['autore']).'" target="_blank">'.$template['autore'].'</a>)';
				// --> Nome semplice
				} elseif ($template['autore']) {
					$templates[$key]['items'][$key2]['autore'] = ' (via '.$template['autore'].')';
				// --> Nessuno 
				} else {
					$templates[$key]['items'][$key2]['autore'] = '';
				}
			}
		}

		return $templates;
		
	}


	public static function get_contributi() {

		return self::get_templates(true);

	}

}