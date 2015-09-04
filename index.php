<?php
require_once 'con_board.php';
	$errors = array();


	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	

	$user_name = null;
	if (!isset($_POST['user_name']) || !strlen($_POST['user_name'])) {
		$errors['user_name'] = 'Insert your name!';
	} else if (!preg_match('/^\w{3,20}$/', $_POST['user_name'])) {
		$errors['user_name'] = 'You missed! In the form, correctly insert numbers of letter from 3 to 20.';
	} else {
		$user_name = $_POST['user_name'];
	}

	$password = null;
	if (!isset($_POST['password']) || !strlen($_POST['password'])) {
		$errors['password'] = 'Insert your password!';
	} elseif (strlen($_POST['password']) > 40) {
		$errors['password'] = 'Your Password is not allowed. Check your password!';
	} else {
		$password = $_POST['password'];
	}

	$subject = null;
	if (!isset($_POST['subject']) || !strlen($_POST['subject'])) {
		$errors['subject'] = 'Subject is needed!';
	} elseif (strlen($_POST['subject']) > 30) {
		$errors['subject'] = 'Your Subject is too Long!';
	} else {
		$subject = $_POST['subject'];
	}
	
	$date = new DateTime();
	$now = $date->format('Y-m-d H:i:s');

	if(count($errors) === 0) {
		$sql = "
			INSERT INTO board (user_name, password, body, subject, created_at) 
				VALUES(:user_name, :password, :body, :subject, :created_at)
		";

		$stmt = $con->prepare($sql);
		$stmt->bindParam(':user_name', $_POST['user_name']);
		$stmt->bindParam(':password', $_POST['password']);
		$stmt->bindParam(':subject', $_POST['subject']);
		$stmt->bindParam(':body', $_POST['body']);
		$stmt->bindParam(':created_at', $now, PDO::PARAM_STR);
		$stmt->execute();
		$con = null;
		
		header("Location: http://". $_SERVER['HTTP_HOST'] . '/list.php');
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
<form action="index.php" method="post">
<?php if(count($errors) > 0): ?>
<ul>
	<?php foreach($errors as $error): ?>
	<li><?php echo $error; ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
	<label>
		Name:
			<input type="text" name="user_name" />
	</label>
	<label>
		Password:
			<input type="password" name="password" /><br />
	</label>
	<label>
		Subject:
			<input type="text" name="subject" />
	</label>
	<label>
		Contents:		
			<textarea name="body" cols="30" rows="5"></textarea></td>
	</label>
	<label>
		<input type="submit" id="btn" value="click" />
	</label>
</form>
</fieldset>
</section>
</div>
</body>
</html>
