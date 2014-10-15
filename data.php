<?php

require_once 'php/lib/meekrodb.2.2.class.php';
require_once 'php/bootstrap.php';
require_once 'php/helpers.php';
require_once 'php/mod.api.php';
require_once 'php/mod.generate.php';

$function = $_GET['call'];
if (function_exists($function)) { call_user_func($function); } else exit();

function get_generazioni() {

	echo Generate::get_registro('generazioni');

}