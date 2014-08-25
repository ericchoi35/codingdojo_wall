<?php 
	session_start();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Coding Dojo Wall Assignment</title>
		<link rel="stylesheet" href="main.css">
	</head>
	<body>
 		<div id="container">
	 		<h1>Welcome to the CodingDojo Wall</h1>
	 		<div id="main_content">
		 		<div class="register">
		 			<h2>Registration</h2>
			 		<form action="process.php" method="post">
			 			<input type="hidden" name="action" value="register">
			 			<label>First Name: 
			 				<input type="text" name="first_name" placeholder="Enter your first name here">
			 			</label>
			 			<label>Last Name:
			 				<input type="text" name="last_name" placeholder="Enter your last name here">
			 			</label>
			 			<label>Email Address: 
			 				<input type="text" name="email" placeholder="Enter email address here">
			 			</label>
			 			<label>Password: 
			 				<input type="password" name="password" placeholder="********">
			 			</label>
			 			<label>Confirm Password: 
			 				<input type="password" name="confirm_password" placeholder="********">
			 			</label>
			 			<label>
			 				<input type="submit" value="Register now">
			 			</label>
			 		</form>
		 		</div>
				<div id="main_right">
				 	<div class="login">
				 		<h2>Login</h2>
						<form action="process.php" method="post">
				 			<input type="hidden" name="action" value="login">
				 			<label>Email Address: 
				 				<input type="text" name="email" placeholder="Enter email address here">
				 			</label>
				 			<label>Password: 
				 				<input type="password" name="password" placeholder="********">
				 			</label>
				 			<label>
				 				<input type="submit" value="Login">
				 			</label>
				 		</form>
				 	</div>
					<div id="message_box">
<?php 					if(isset($_SESSION['errors']))
						{
							foreach($_SESSION['errors'] as $errors)
							{
								echo "<p>{$errors}</p>";
							}
								unset($_SESSION['errors']);
						}
						if(isset($_SESSION['success_message']))
						{
							echo "<p>{$_SESSION['success_message']}</p>";
							unset($_SESSION['success_message']);
						}	?> 
		 			</div>
				</div><!--end of main_right-->
			</div><!--end of main_content-->
		</div><!--end of container-->
 	</body>
</html>

<?php 

	$_SESSION = array();

?>