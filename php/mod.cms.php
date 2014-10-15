<?php

Class CMS {

	public static function get_templates() {

		$items = '';
		$ids = DB::queryFirstColumn("SELECT id FROM templates ORDER BY id DESC");

		foreach ($ids as $key => $id) {
			$items[$key] = self::get_template($id);
		}

		return $items;

	}


	public static function edit($id) {

		// Se $id = 'new' è un insert, se è numero è un update
		return ($id == 'new') ? self::insert() : ((is_numeric($id)) ? self::update($id) : false);

	}


	public static function insert() {

		if (Helpers::post('frase') and trim(Helpers::post('frase'))) {

			DB::insert('templates', array('quando' => date("Y-m-d", time())));
			$id = DB::insertId();
			self::update($id);

		}

	}


	public static function update($id) {

		// FRASE
		$frase = Helpers::post('frase');
		if ($frase and trim($frase)) DB::query("UPDATE templates SET frase=%s WHERE id=%i", $frase, $id);

		// DATA
		$quando = Helpers::post('quando');
		if ($quando and trim($quando)) DB::query("UPDATE templates SET quando=%s WHERE id=%i", $quando, $id);

		// ATTIVO, AUTORE
		DB::query("UPDATE templates SET attivo=%i, autore=%s WHERE id=%i", Helpers::post('attivo'), Helpers::post('autore'), $id);

		// TAGS
		$tagghi = Helpers::post('tagghi');
		$tagghi = explode(';', $tagghi);
		DB::delete('tagghi_templates', "key_template=%i", $id);

		foreach ($tagghi as $key => $taggo) {
			
			$id_taggo = Tags::id_tag_taggo($taggo);
			
			// Se non c'è
			if (!$id_taggo) {

				DB::insert('tagghi', array('taggo' => $taggo));
				$id_taggo = DB::insertId();
			
			}

			DB::insert('tagghi_templates', array('key_taggo' => $id_taggo, 'key_template' => $id));
			Tags::clean_tagghi();

		}

	}


	public static function delete($id) {

		if ($id and is_numeric($id)) {

			// TEMPLATES
			DB::delete('templates', "id=%i", $id);

			// TAGGHI
			DB::delete('tagghi_templates', "key_template=%i", $id);
			Tags::clean_tagghi();

		}
	}

	/* public static function insert() {

		if (Helpers::post('nuova') and trim(Helpers::post('nuova'))) {

			DB::insert('templates', array('frase' => Helpers::post('nuova'), 'quando' => date("Y-m-d", time())));

		}

	}

	public static function update() {

		if (Helpers::post('update')) {

			$templates = self::get_templates();

			// print_r($_POST); die();

			foreach ($templates as $template) {

				$id = $template['id'];

				if (isset($_POST["frase$id"]) and isset($_POST["quando$id"])) {

					$quando = Helpers::date_to_mysql(Helpers::post("quando$id"));
					$frase = Helpers::post("frase$id");

					DB::update('templates', array('frase' => $frase, 'attivo' => Helpers::post("attivo$id"), 'autore' => Helpers::post("autore$id"), 'quando' => $quando), "id=%i", $id);

				}
				
			}
			
		}

	}

	public static function delete() {

		if (isset($_GET['id']) and is_numeric($_GET['id'])) {

			DB::delete('templates', "id=%i", $_GET['id']);

		}

	}

	*/

	public static function get_template($id) {

		// Se è nuovo, restituisce vuoto
		if ($id == 'new') return array('id' => 'new', 'frase' => '', 'autore' => '', 'quando' => date("Y-m-d", time()), 'attivo' => '', 'tagghi' => array());

		// Se è id
		$item = DB::queryFirstRow("SELECT * FROM `templates` WHERE id=%i", $id);
		$item['tagghi'] = DB::queryFirstColumn("SELECT taggo FROM tagghi INNER JOIN tagghi_templates ON tagghi_templates.key_taggo = tagghi.id WHERE key_template = %i ORDER BY taggo ASC", $id);

		// print_r($item);
		return $item;

	}

}