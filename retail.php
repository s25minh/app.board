<?php
require_once 'con_board.php';
$id = $_GET['id'];
$sql = 'SELECT id, subject, user_name, body, created_at, updated_at FROM board WHERE id = ' . $id;

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
	<form action="insertform.php" method="post">
	<td><button type="submit" name="update_id" value="<?php echo $id; ?>">変更</button></td>
	</form>
	<form action="list.php" method="post">
		<td><button type="submit">リストへ</button></td>
	</form>
	</tr>
</table>
</section>
</body>
</html>
