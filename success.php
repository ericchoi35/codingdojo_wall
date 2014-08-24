<?php 
	session_start();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Success</title>
 </head>
 <body>
 	<div>
 		<h2>Welcome <?= $_SESSION['first'] ?>, you are now logged in!</h2>
 		<a href='process.php'>Log out</a>
 	</div>
 </body>
 </html>

 <?php 

 	$_SESSION = array();

 ?>