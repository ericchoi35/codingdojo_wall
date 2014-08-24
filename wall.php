<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Coding Dojo Wall</title>
		<link rel="stylesheet" type="text/css" href="wall.css">
	</head>
	<body>
		<div id="container">
			<div class="header">
				<h1>CodingDojo Wall</h1>
				<p>Welcome <?= $_SESSION['first_name'] ?></p>
				<a href="process.php">Log off</a>
			</div>
			<div class="post_area">
				<h3>Post a message</h3>
				<form action="process.php" method="post">
					<input type="hidden" name="action" value="post_message">
					<textarea name="message" placeholder="Enter your message here"></textarea>
					<input type="submit" value="Post message">
				</form>
			</div>
		<!-- 	<div class="message_area">
				<p>Eric Choi - January 1st 2014</p>
				<p>Hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello hello </p>
			</div> -->
<?php 		if(isset($_SESSION['message']))
			{	?>
				<div class="message_area">			
					<p><?= $_SESSION['first_name'] . ' ' .  $_SESSION['last_name'] . ' - ' . $_SESSION['created_at'] ?></p>
					<p><?= $message ?></p>
				</div>		
<?php		}	?>
		</div>
	</body>
</html>

