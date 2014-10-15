<?php

require_once 'php/lib/meekrodb.2.2.class.php';
require_once 'php/bootstrap.php';
require_once 'php/helpers.php';
require_once 'php/mod.api.php';
require_once 'php/mod.generate.php';
require_once 'php/mod.log.php';

$function = $_GET['call'];

call_user_func("App::$function");

Class App {

	public function get_generazioni() {
	
		echo number_format(Generate::get_registro('generazioni'), 0, ',', '.');
	}

	// +++++++++++++++++++++++++++++++++++++++++++++
	// TEMPLATES
	// +++++++++++++++++++++++++++++++++++++++++++++

	public function get_numero_frasi_attive() {

		$stats = Log::get_stats();
		echo number_format($stats['template_attivi'], 0, ',', '.');
	}


	public function get_parameters_list() {

		$type = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'templates';
		$search = (array_key_exists('search', $_GET)) ? $_GET['search'] : false;

		return call_user_func('self::get_'.$type.'_list', $search);
	}


	public function get_templates_list($search = '') {

		$items = array();
		$templates = DB::query("SELECT * FROM templates WHERE attivo = 1 AND frase LIKE %s ORDER BY id DESC", '%'.$search.'%');

		foreach ($templates as $key => $template) {
			$items[$key]['id'] = $template['id'];
			$items[$key]['testo'] = Generate::replace_tokens($template, null);
		}

		echo json_encode($items);
	}

	public function get_template_testo() {

		$id = (array_key_exists('id', $_GET)) ? $_GET['id'] : 0;
		$template = DB::queryFirstRow("SELECT * FROM templates WHERE id=%i", $id);

		echo Generate::replace_tokens($template, null);
	}


	// +++++++++++++++++++++++++++++++++++++++++++++
	// COUNTRIES
	// +++++++++++++++++++++++++++++++++++++++++++++

	public function get_numero_paesi() {

		$paesi = DB::query('SELECT * FROM paesi');
		echo count($paesi);
	}

	public function get_countries_list($search = '') {

		$items = array();
		$countries = DB::query("SELECT * FROM paesi WHERE nome LIKE %s ORDER BY nome ASC", '%'.$search.'%');

		foreach ($countries as $key => $country) {
			$items[$key]['id'] = $country['id'];
			$items[$key]['testo'] = $country['nome'];
		}

		echo json_encode($items);

	}


	public function get_country_testo() {

		$id = (array_key_exists('id', $_GET)) ? $_GET['id'] : 0;
		echo DB::queryOneField('nome', "SELECT * FROM paesi WHERE id=%i", $id);
	}


	// +++++++++++++++++++++++++++++++++++++++++++++
	// BIUSO
	// +++++++++++++++++++++++++++++++++++++++++++++

	public function get_num_items() {
		
		$type = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'templates';

		echo ($type == 'templates') ? self::get_numero_frasi_attive() : self::get_numero_paesi();
	}

	public function get_list_items($type = 'templates', $search = '') {
		
		$type = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'templates';
		$search = (array_key_exists('search', $_GET)) ? $_GET['search'] : '';
		
		echo ($type == 'templates') ? self::get_templates_list($search) : self::get_countries_list($search);
	}

	public function get_testo_item() {

		$type = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'templates';
		
		echo ($type == 'templates') ? self::get_template_testo() : self::get_country_testo();
	}

}


