<?php

Class Generate {

	public static $colors = array('27ae61', 'd74235', '1b70c0', '222222');

	public static function get_templates() {
		
		$sql = "SELECT *, DATE_FORMAT(quando, '%d-%m-%Y') AS giorno FROM templates WHERE attivo = 1 ORDER BY quando DESC";
		
		$templates = DB::query($sql);

		foreach ($templates as $key => $template) {
			
			$templates[$key]['frase'] = ucfirst(self::replace_tokens($template, null));

		}

		return $templates;

	}


	public static function randomize() {

		$country_set = self::get_country();
		$template = self::get_template();
		
		$phrase = ucfirst(self::replace_tokens($template, $country_set));
		$color = self::$colors[array_rand(self::$colors)];

		$generate = array('phrase' => "$phrase", 'id' => $template['id'], 'color' => $color);

		$_SESSION['generate'] = $generate;
		self::update_registro();
		
		return json_encode($generate);

	}


	public static function get_country() {

		$api_id = API::country();

		return ($api_id) ? DB::queryFirstRow("SELECT * FROM `paesi` WHERE id=%i", $api_id) : DB::queryFirstRow('SELECT * FROM `paesi` ORDER BY RAND() LIMIT 1');

	}


	public static function get_template() {

		$api_id = API::template();

		// API: specificato id
		if ($api_id) return DB::queryFirstRow("SELECT * FROM templates WHERE id=%i", $api_id);

		// Il taggo è passato nel GET 'tag' sia nell'api sia nell'interfaccia ajax principale
		$taggo_id = API::taggo();

		if ($taggo_id) return DB::queryFirstRow("SELECT * FROM templates INNER JOIN tagghi_templates ON tagghi_templates.key_template = templates.id WHERE key_taggo = $taggo_id AND attivo = 1 ORDER BY RAND() LIMIT 1");

		return DB::queryFirstRow('SELECT * FROM templates WHERE attivo = 1 ORDER BY RAND() LIMIT 1');

	}


	// Chiamato da generate e da get_templates
	public static function replace_tokens($template, $country_set = null) {

		// Se country_set è null, fa una sostituzione fake (per list e log)

		$phrase = $template['frase'];
		$tokens = self::get_tokens($phrase);

		foreach ($tokens as $key => $token) {

			$function = (substr($token, 0, 4) == 'VERB') ? 'verbalize' : ((substr($token, 0, 4) == 'DECL') ? 'declinize' : 'tokenize');
			$declined = call_user_func("self::$function", $token, $country_set);
			$phrase = Helpers::str_replace_once("%$token%", $declined, $phrase);

		}

		return $phrase;

	}


	// Chiamato da replace_tokens
	public static function tokenize($token, $country_set) {

		if (!$country_set) return '[paese]';

		$tokenized = '...';

		switch ($token) {

			// IN
			case 'IN':
				
				$tokenized = ($country_set['in']) ? $country_set['in'] : 'in';
				break;
	
			// DA
			case 'DA':
				
				$das = array('l\'' => 'dall\'', 'la' => 'dalla', 'il' => 'dal', null => 'da', 'lo' => 'dallo', 'gli' => 'dagli', 'le' => 'dalle', 'i' => 'dai');
				$tokenized = $das[$country_set['articolo']];
				break;

			// DI
			case 'DI':
				
				$das = array('l\'' => 'dell\'', 'la' => 'della', 'il' => 'del', null => 'di', 'lo' => 'dello', 'gli' => 'degli', 'le' => 'delle', 'i' => 'dei');
				$tokenized = $das[$country_set['articolo']];
				break;

			// A
			case 'A':
				
				$das = array('l\'' => 'all\'', 'la' => 'alla', 'il' => 'al', null => 'a', 'lo' => 'allo', 'gli' => 'agli', 'le' => 'alle', 'i' => 'ai');
				$tokenized = $das[$country_set['articolo']];
				break;

			// ART
			case 'ART':

			$tokenized = $country_set['articolo'];
			break;

		}

		$tokenized .= (substr($tokenized, -1) == "'") ? '' : ' ';
		return $tokenized.$country_set['nome'];

	}


	// Chiamato da replace_tokens
	public static function verbalize($verbs, $country_set) {

		$verbalized = '...';

		$verbs = str_replace('VERB|', '', $verbs);
		$verbs = explode('|', $verbs);
		if (count($verbs) == 2) {
			// Se country_set è null, ritorna il singolare
			if (!$country_set) return $verbs[0];
			return (in_array($country_set['articolo'], array('gli', 'le', 'i'))) ? $verbs[1] : $verbs[0];
		}

	}


	// Chiamato da replace_tokens
	public static function declinize($options, $country_set) {

		// $options è 0singmaschile|1singfemminile|2plurmaschile|3plurfeminile

		$declinized = '...';

		$options = str_replace('DECL|', '', $options);
		$options = explode('|', $options);
		
		if (count($options) == 4) {
			// Singolare maschile
			if (!$country_set or $country_set['gen_num'] == 'ms') return $options[0];
			// Singolare femminile
			if ($country_set['gen_num'] == 'fs') return $options[1];
			// Plurale maschile
			if ($country_set['gen_num'] == 'fs') return $options[2];
			// Plurale femminile
			if ($country_set['gen_num'] == 'fp') return $options[3];
		}

		return $declinized;

	}


	/* public static function get_token($template, $start = '%', $end = '%') {

    $template = " ".$template;
    $ini = strpos($template, $start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($template, $end, $ini) - $ini;
    return substr($template, $ini, $len);

	} */


	public static function get_tokens($phrase, $start = '%', $end = '%') {

		preg_match_all("~$start(.+?)$end~", $phrase, $tokens);
		return $tokens[1];

	}


	public static function update_registro($parametro = 'generazioni') {

		DB::query('UPDATE registri SET valore = (valore + 1) WHERE parametro = "'.$parametro.'"');

	}


	public static function get_registro($parametro = 'generazioni') {

		return DB::queryFirstField("SELECT valore FROM registri WHERE parametro=%s", $parametro);

	}

}