<?php
require_once 'con_board.php';
$id = $_GET['id'];
$sql = 'SELECT subject, user_name, body, created_at, updated_at FROM board WHERE id = ' . $id;

$stmt = $con->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Retail of Board Mont</title>
	<link href="style/retail.css" rel="stylesheet" />
</head>
<body>
<section class="board">
<table class="retail-info">
	<tr>
		<td>Name:</td>
		<td><?php echo $row['user_name']; ?></td>
		<td>Created_at:</td>
		<td><?php echo $row['created_at']; ?></td>
	</tr>
	<tr>
		<td>Subject:</td>
		<td><?php echo $row['subject']; ?></td>
		<td>Updated_at:</td>
		<td><?php echo $row['updated_at']; ?></td>
	</tr>
	<tr>
		<td>Contents:</td>
		<td colspan="3"><?php echo $row['body']; ?></td>
	</tr>
	<tr>
		<td><button type="button">登録</button></td>
		<td><button type="button">削除</button></td>
		<td><button type="button">変更</button></td>
		<td><button type="button">リストへ</button></td>
	</tr>
</table>
</section>
</body>
</html>
