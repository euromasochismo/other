<?php

session_start();

require_once 'php/lib/meekrodb.2.2.class.php';
require_once 'php/bootstrap.php';
require_once 'php/helpers.php';
require_once 'php/mod.api.php';
require_once 'php/mod.generate.php';

echo Generate::randomize();