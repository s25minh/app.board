<?php
require_once 'con_board.php';

	$d = new DateTime();
	$now = $d->format('Y-m-d H:i:s');
	$id = $_POST['id'];
	$sql = 'UPDATE board SET user_name = :user_name, password = :password,
		subject = :subject, body = :body, updated_at = :updated_at
		WHERE id = ' . $id;

	
	$stmt = $con->prepare($sql);
	$stmt->bindParam(':user_name', $_POST['user_name']);
	$stmt->bindParam(':password', $_POST['password']);
	$stmt->bindParam(':subject', $_POST['subject']);
	$stmt->bindParam(':body', $_POST['body']);
	$stmt->bindParam(':updated_at', $now);
	
	$stmt->execute();
	$row = $stmt->rowCount();
	echo $row . '件を更新しました。';
	$con = null;

?>

