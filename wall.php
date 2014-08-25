<?php 
	session_start();
	include('connection.php');

	$query = "SELECT users.first_name, users.last_name, messages.message, messages.created_at, messages.id FROM messages LEFT JOIN users ON messages.user_id = users.id ORDER BY messages.created_at DESC;";
	$messages = fetch_all($query);

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
			<div id='message_area'>
<?php 		foreach($messages as $message)
			{		
			$sql_time = strtotime($message['created_at']);
			$time = date("F jS Y h:i:s A", $sql_time);	

			$comment_query = "SELECT comments.user_id, comments.id, users.first_name, users.last_name, comments.message_id, comments.created_at, comments.comment FROM comments LEFT JOIN users ON users.id = comments.user_id WHERE comments.message_id = '{$message['id']}';";
			$comments = fetch_all($comment_query);
			// var_dump($comments);
					?>

				<div class="messages">
					<h2><?= $message['first_name'] . ' ' . $message['last_name'] . ' - ' . $time ?></h2>
					<p><?= $message['message'] ?></p>
<?php 			foreach($comments as $comment)
				{ 	
					$sql_time = strtotime($comment['created_at']);
					$time = date("F jS Y h:i:s A", $sql_time);

					
					// echo '<br>COMMENT TIME<br>' . $sql_time . '<br>';
					$time1 = date_default_timezone_set('America/Los_Angeles');
					// echo 'TIME1<br>' .$time1 . '<br>'; 
					// echo 'CURRENT TIME<br>' . time() . '<br>';
					$time_difference = date('i',(time() - $sql_time));
					// echo 'TIME DIFFERENCE<br>' . $time_difference . '<br>';	

					?>
					<div class="comments">
						<h2><?= $comment['first_name'] . ' ' . $comment['last_name'] . ' - ' . $time ?></h2>
						<p><?= $comment['comment'] ?></p>
<?php					if($comment['user_id'] == $_SESSION['user_id'] && $time_difference < 30)	
						{	?>
						<form action='process.php' method='post'>
							<input type='hidden' name='action' value='delete_comment'>
							<input type='hidden' name='comment_id' value='<?= $comment['id'] ?>'>
							<input type='submit' value='Delete comment'>
						</form>
<?php 					} 	?>
					</div>
<?php			} 	?>
					<form action='process.php' method='post'>
						<input type='hidden' name='action' value='post_comment'>
						<input type='hidden' name='message_id' value='<?= $message['id'] ?>'>
						<textarea name='comment' placeholder='Enter your comment here'></textarea>
						<input type='submit' value='Post comment'>
					</form>
				</div>
<?php 		}	?>
			</div><!--end of message_area div-->
		</div><!--end of container div-->
	</body>
</html>

