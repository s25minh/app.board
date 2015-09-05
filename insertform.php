<?php
require_once 'con_board.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = isset($_POST['update_id']) ? $_POST['update_id'] : null ;
	
	$sql = 'SELECT * FROM board WHERE id = ' . $id;
	$stmt = $con->query($sql);
	
	echo '<pre>' . var_dump($sql). '</pre>';
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	$errors = array();



	$user_name = null;
	if (!isset($row['user_name']) || !strlen($row['user_name'])) {
		$errors['user_name'] = 'Insert your name!';
	} else if (!preg_match('/^\w{3,20}$/', $row['user_name'])) {
		$errors['user_name'] = 'You missed! In the form, correctly insert numbers of letter from 3 to 20.';
	} else {
		$user_name = $row['user_name'];
	}

	$password = null;
	if (!isset($row['password']) || !strlen($row['password'])) {
		$errors['password'] = 'Insert your password!';
	} elseif (strlen($row['password']) > 40) {
		$errors['password'] = 'Your Password is not allowed. Check your password!';
	} else {
		$password = $row['password'];
	}

	$subject = null;
	if (!isset($row['subject']) || !strlen($row['subject'])) {
		$errors['subject'] = 'Subject is needed!';
	} elseif (strlen($row['subject']) > 30) {
		$errors['subject'] = 'Your Subject is too Long!';
	} else {
		$subject = $row['subject'];
	}

	if(count($errors) === 0) {
#		header("Location: http://". $_SERVER['HTTP_HOST'] . "/retail.php");
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My App Board</title>
	<link href="style/index.css" rel="stylesheet" >
</head>
<body>
<div class="wrapper">
<header>
	<h2>Mont Board</h2>
</header>
<section class="board">
<fieldset class="register-group">
<form action="update.php" method="post">
<?php if(count($errors) > 0): ?>
<ul>
	<?php foreach($errors as $error): ?>
	<li><?php echo $error; ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
	<label>
		Name:
		<input type="text" name="user_name" value="<?php echo $row['user_name']; ?>" />
	</label>
	<label>
		Password:
		<input type="password" name="password" <?php echo $row['password']; ?>/><br />
	</label>
	<label>
		Subject:
			<input type="text" name="subject" value="<?php echo $row['subject']; ?>"/>
	</label>
	<label>
		Contents:		
			<textarea name="body" cols="30" rows="5"><?php echo $row['body']; ?>"</textarea></td>
	</label>
	<label>
		<input type="submit" id="btn" name="id" value="click" />
	</label>
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
</form>
</fieldset>
</section>
</div>
</body>
</html>
