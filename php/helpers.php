<?php

Class Helpers {

	public static function post($param) {

		if (!isset($_POST[$param])) return 0;
		return $_POST[$param];

	}

	public static function date_to_mysql($input) {
  
	  $giorno = substr($input, 0, 2);
	  $mese = substr($input, 3, 2);
	  $anno = substr($input, 6, 4);
	  
	  return "$anno-$mese-$giorno";

	}

	public static function str_replace_once($str_pattern, $str_replacement, $string){

    if (strpos($string, $str_pattern) !== false){
			$occurrence = strpos($string, $str_pattern);
      return substr_replace($string, $str_replacement, strpos($string, $str_pattern), strlen($str_pattern));
    }

    return $string;
	}

}
