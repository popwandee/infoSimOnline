<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Database Settings
|--------------------------------------------------------------------------
|
*/

$active_group = 'default';
$query_builder = TRUE;
$db['default'] = array(
	//'dsn'	=> getenv('mysql://b6d8ca3b852434:a62dff20@us-cdbr-east-03.cleardb.com/heroku_081da15c9931bb6?reconnect=true'),
	//'hostname' => "us-cdbr-east-03.cleardb.com",
	//'username' => "b6d8ca3b852434",
	//'password' => "a62dff20",
	//'database' => "heroku_081da15c9931bb6",
	'hostname' => "localhost",
	'username' => "datauser",
	'password' => "Data@mibn2020",
	'database' => "infosim",
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
