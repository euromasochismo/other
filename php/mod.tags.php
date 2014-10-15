<?php

Class Tags {

	public static function exists_tag_taggo($taggo, $inclusi_rimandi = false) {

		$where = (!$inclusi_rimandi) ? 'AND rimando = 0 ' : '';
		DB::query("SELECT * FROM tagghi WHERE taggo=%s $where", $taggo);
		return DB::count();

	}

	public static function id_tag_taggo($taggo, $inclusi_rimandi = false) {

		$where = (!$inclusi_rimandi) ? 'AND rimando = 0 ' : '';
		return DB::queryFirstField("SELECT id FROM tagghi WHERE taggo=%s $where", $taggo);

	}

	public static function get_list_tagghi() {

		return DB::queryFirstColumn("SELECT taggo FROM tagghi WHERE rimando = 0 ORDER BY taggo ASC");

	}

	public static function clean_tagghi() {

		$ids = DB::queryFirstColumn("SELECT id FROM tagghi WHERE rimando = 0 ORDER BY taggo ASC");

		foreach ($ids as $key => $id) {
			DB::query("SELECT * FROM tagghi_templates WHERE key_taggo=%i", $id);
			if (!DB::count()) DB::delete('tagghi', "id=%i", $id);
		}

	}

	public static function delete_taggo($id) {

		DB::delete('tagghi_templates', "key_taggo=%i", $id);
		DB::delete('tagghi', "id=%i AND rimando=0", $id);

	}

	public static function get_menu_tagghi() {

		$sql = 'SELECT id, taggo, COUNT(*) AS occorrenze FROM tagghi INNER JOIN tagghi_templates ON tagghi_templates.key_taggo = tagghi.id WHERE rimando = 0 GROUP BY tagghi.id ORDER BY taggo ASC';

		$menu = DB::query($sql);

		// print_r($menu);
		return $menu;

	}

	public static function update_tagghi() {

		$ids = DB::queryFirstColumn("SELECT id FROM tagghi WHERE rimando = 0 ORDER BY taggo ASC");

		foreach ($ids as $key => $id) {
			$taggo = Helpers::post("taggo$id");
			if ($taggo) DB::query("UPDATE tagghi SET taggo=%s WHERE id=%i", $taggo, $id);
		}

	}

	// -----------------------------------
	// RIMANDI

	public static function get_rimandi() {

		$sql = 'SELECT * FROM tagghi WHERE rimando <> 0 ORDER BY taggo ASC';
		$items = DB::query($sql);

		// print_r($items);
		return $items;

	}

	public static function add_rimando() {

		DB::insert('tagghi', array('taggo' => '_Nuovo', 'rimando' => 1));

	}

	public static function delete_rimando($id) {

		DB::delete('tagghi', "id=%i AND rimando<>0", $id);

	}

	public static function update_rimandi() {

		$tagghi = self::get_rimandi();

		// print_r($_POST); die();

		foreach ($tagghi as $taggo) {

			$id = $taggo['id'];
			$testo = Helpers::post("taggo$id");

			if ($testo) {

				DB::update('tagghi', array('taggo' => $testo, 'rimando' => Helpers::post("rimando$id")), "id=%i", $id);

			}
		}
	}

	// -----------------------------------
	// TUTTO INSIEME

	public static function get_tagghi_tutti() {

		

	}

}