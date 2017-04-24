<?php

// This is the database connection configuration.
return array(
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	/*'connectionString' => 'pgsql:host=siud.gandafitrandia-380d.aivencloud.com;port=23879;dbname=defauldb',
	'emulatePrepare' => true,
	'username' => 'avnadmin',
	'password' => 'tgdpqpmdpmr9w5n6',
	'charset' => 'utf8',*/

	'connectionString' => 'pgsql:host=localhost;port=5432;dbname=siud_db',
	'emulatePrepare' => true,
	'username' => 'postgres',
	'password' => '12345',
	'charset' => 'utf8',

	/*'connectionString' => 'mysql:host=localhost;dbname=dumm',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',*/
	
);