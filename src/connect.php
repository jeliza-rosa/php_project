<?php

function connect() 
{
	$host = HOST_CONFIG;
	$user = USER_CONFIG;
	$pass = PASS_CONFIG;
	$dbname = DB_CONFIG;

	$dsn = "mysql:host=$host;dbname=$dbname";

	$opt = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];

	$pdo = new PDO($dsn, $user, $pass, $opt);

	return $pdo;
}
