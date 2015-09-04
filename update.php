<?php
require_once 'con_board.php';

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
	
	$sql = "UPDATE board
	   			SET subject=:subject, user_name=:user_name,
				body=:body 
				WHERE id=:id";

	$stmt = $con->prepare($sql);
	
}
