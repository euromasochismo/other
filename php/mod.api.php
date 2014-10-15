<?php

Class API {

	// TEMPLATE
	public static function template() {

		// Se è specificato l'id (template)
		if (isset($_GET['template']) and is_numeric($_GET['template'])) {

			$id = $_GET['template'];

			DB::query("SELECT * FROM templates WHERE id=%i", $id);
			return (DB::count()) ? $id : false;

		}

		return false;

	}


	// COUNTRY
	public static function country() {

		if (isset($_GET['country']) and is_numeric($_GET['country'])) {

			$id = $_GET['country'];
			DB::query("SELECT * FROM paesi WHERE id=%i", $id);
			return (DB::count()) ? $id : false;

		}

		return false;
		
	}


	// COLOR
	// ...


	public static function country_list() {

		return DB::query('SELECT * FROM paesi ORDER BY nome ASC');

	}


	// TAGGO
	public static function taggo() {

		// Se è specificato l'id (template)
		if (isset($_GET['tag']) and is_numeric($_GET['tag'])) {

			$id = $_GET['tag'];

			DB::query("SELECT * FROM tagghi WHERE id=%i", $id);
			return (DB::count()) ? $id : false;

		}

		return false;

	}

	public static function tagghi_list() {

		return DB::query('SELECT * FROM tagghi ORDER BY taggo ASC');

	}

}