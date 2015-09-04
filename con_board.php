<?php
	$dsn = 'mysql:dbname=myapp_board;host=localhost;charset=utf8';
	$user = 'montan';
	$password = 'montan';

	try {
		$con = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

