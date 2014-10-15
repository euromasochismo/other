<?php

setlocale(LC_ALL, 'it_IT');
date_default_timezone_set('Europe/Rome');

$site_url = 'http://127.0.0.1/facciamocome/';

// ----------------------------------------------
// MYSQL
// ----------------------------------------------

DB::$host = '127.0.0.1';
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'facciamocome';
DB::$encoding = 'utf8';