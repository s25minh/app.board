<?php
require_once 'con_board.php';

$contents = isset($_GET['contents']) ? $_GET['conetents'] : null;

$page = isset($_GET['page']) ? $_GET['page'] : null;

if ($page === '') {
	$page = 1;
}

$page = max($page, 1);
$sql = 'SELECT COUNT(id) AS count FROM board';
$stmt = $con->query($sql);
$table = $stmt->fetch(PDO::FETCH_ASSOC);
$maxPage = ceil($table['count'] / 10);
$start = ($page - 1) * 10;
$sql = "SELECT id, subject, body, user_name, created_at 
			FROM board ORDER BY id DESC, created_at DESC
				LIMIT " . $start . ", 10";

$stmt = $con->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


function setStrimWidth($string) {
	return mb_strimwidth($string, 0, 13, '...', 'UTF-8');
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>List of Board Mont</title>
	<link rel="stylesheet" href="list.css" />
	<link rel="stylesheet" href="search.css" />
</head>
<body>

<table class="board-list">
	<tr>
		<th class="r1">No.</th>
		<th class="r2">Subject</th>
		<th class="r3">Name</th>
		<th class="r4">Created At</th>
	</tr>
	<?php foreach ($rows as $row): ?>
	<tr>
		<td class="r1">
			<?php echo $row['id']; ?>
		</td>
		<td class="r2">
			<a href="<?php echo './retail.php'; ?>?id=<?php echo $row['id'] ?>"><?php echo setStrimWidth($row['subject']); ?></a>
		</td>
		<td class="r3">
			<?php echo $row['user_name']; ?> 
		</td>
		<td class="r4">
			<?php echo substr($row['created_at'], 2, strpos($row['created_at'], ' ')-2); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
	<div class="board-pager">
		<ul>
			<?php if($page >= 1): ?>
			<li><a href="<?php echo './list.php'; ?>?page=<?php print($page - 1); ?>">前のページへ</a></li>
			<?php endif; ?>
			<?php if($page < $maxPage): ?>
			<li><a href="<?php echo './list.php'; ?>?page=<?php print($page); ?>"><?php echo $page; ?></a></li>
			<li><a href="<?php echo './list.php'; ?>?page=<?php print($page + 1); ?>"><?php echo $page + 1; ?></a></li>
			<li><a href="<?php echo './list.php'; ?>?page=<?php print($page + 2); ?>"><?php echo $page + 2; ?></a></li>
			<li><a href="<?php echo './list.php'; ?>?page=<?php print($page + 1); ?>">次のページへ</a></li>
			<?php endif; ?>
		</ul>
	</div>
<?php include 'search.php'; ?>
</body>
</html>
