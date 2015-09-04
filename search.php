<?php
require_once 'con_board.php';

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		
		$type = isset($_GET['select-type']) ? $_GET['select-type'] : null;
		$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
		$keyword = htmlspecialchars($keyword);
		$count = 1;
		$sql = '';
		$words = '';

		$query = 'SELECT * FROM board 
			WHERE ';

		$keyword = trim($keyword);
		$keyword = str_replace('　', ' ', $keyword);

		if (stristr($keyword, ' ')) {
			$words = explode(' ', $keyword);
			$count = count($words);
		}

		
		if ($count === 1) {
			$sql = $query . $type . ' LIKE :keyword';
			$stmt = $con->prepare($sql);
			$keyword = '%'.$keyword.'%';
			$stmt->bindParam(':keyword', $keyword);
		} else if ($count > 1){ //OR検索
			for ($i=0; $i < $count; $i++) {
				if ($i === 0) {
					$sql .= $type . ' LIKE :keyword'.$i;
					continue;
				}
				$sql .= ' OR ';
				$sql .= $type . ' LIKE :keyword'.$i;
			}

			$sql = $query.$sql;
			$stmt = $con->prepare($sql);

			for ($i=0; $i < $count; $i++) {
				$word[$i] = '%'.$words[$i].'%';
				$pressholder = ':keyword'.$i;
				$stmt->bindParam($pressholder, $word[$i]);
			}
		}  	
		
		$stmt->execute();
		$row = $stmt->fetchAll();
//		echo '<pre>';
//		var_dump($sql);
//		echo '</pre>';
		$cnt = $stmt->rowCount();
	}

?>
<head>
</head>

<form class="search-form" action="" method="GET">
	<select id="" name="select-type">
		<option value="subject" selected>Subject</option>
		<option value="body">Content</option>
		<option value="user_name">Username</option>
		<input type="text" name="keyword" size="30"/>
		<input type="submit" value="Search" name="submit" />
	</select>
</form>
<?php if(isset($_GET['submit'])): ?>
<?php echo $cnt . '件が見つかりました。'; ?>
<?php foreach($row as $key): ?>
<p>Subject: <?php echo $key['subject']; ?></p>
<p>Contents:<?php echo $key['body']; ?></p>
<p>UserName:<?php echo $key['user_name']; ?></p>
<?php endforeach; ?>
<?php endif; ?>
