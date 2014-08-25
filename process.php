<?php 
	session_start();
	include('connection.php');

	if(isset($_POST['action']) && $_POST['action'] == 'register')
	{
		registration($_POST);
	}
	if(isset($_POST['action']) && $_POST['action'] == 'login')
	{
		login($_POST);
	}
	if(isset($_POST['action']) && $_POST['action'] == 'post_message')
	{
		post_message($_POST);
	}
	if(isset($_POST['action']) && $_POST['action'] == 'post_comment')
	{	
		post_comment($_POST);
	}
	if(isset($_POST['action']) && $_POST['action'] == 'delete_comment')
	{	
		delete_comment($_POST);
	}
	else
	{
		session_destroy();
		header('Location: index.php');
		die();
	}

	function registration($post)
	{
		$_SESSION['errors'] = array();

		if(empty($post['first_name']))
		{
			$_SESSION['errors'][] = "Please enter your first name";
		}
		if(empty($post['last_name']))
		{
			$_SESSION['errors'][] = "Please enter your last name";
		}
		if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errors'][] = "Please enter a valid email";
		}
		if(empty($post['password']))
		{
			$_SESSION['errors'][] = "Please enter a password";
		}
		if(!empty($post['password']) && strlen($post['password']) < 6)
		{
			$_SESSION['errors'][] = "Password must be longer than 6 characters";
		}
		if($post['password'] !== $post['confirm_password'])
		{
			$_SESSION['errors'][] = "Passwords do not match";
		}

		if(count($_SESSION['errors']) > 0)
		{
			header('Location: index.php');
			die();
		}
		else
		{
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES ('{$post['first_name']}', '{$post['last_name']}', '{$post['email']}', '{$post['password']}', NOW(), NOW());";

			run_mysql_query($query);

			$_SESSION['success_message'] = "Thank you for registering. You may now login!";
			header('Location: index.php');
			die();
		}
	}

	function login($post)
	{
		$_SESSION['errors'] = array();

		if(empty($post['email']))
		{
			$_SESSION['errors'][] = "Please enter your email address";
		}
		if(!empty($post['email']) && !filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errors'][] = "Please enter a valid email";
		}
		if(empty($post['password']))
		{
			$_SESSION['errors'][] = "Please enter your password";
		}

		else
		{
			$query = "SELECT * FROM users WHERE users.email = '{$post['email']}' AND users.password = '{$post['password']}';";
			$user = fetch_all($query);
			if(count($user) > 0)
			{
				$_SESSION['user_id'] = $user[0]['id'];
				$_SESSION['first_name'] = $user[0]['first_name'];
				$_SESSION['last_name'] = $user[0]['last_name'];
				$_SESSION['logged_in'] = TRUE;
				header('Location: wall.php');
				die();
			}
			else
			{
				$_SESSION['errors'][] = "That user does not exist";
			}
		}

		if(count($_SESSION['errors']) > 0)
		{
			header('Location: index.php');
			die();
		}
	}

	function post_message($post)
	{	
		if(!empty($post['message']))
		{	
			// insert message into database
			$query = "INSERT INTO messages (user_id, message, created_at, updated_at) VALUES ('{$_SESSION['user_id']}', '{$post['message']}', NOW(), NOW());";

			run_mysql_query($query);
		}	
		header('Location: wall.php');
		die();
	}

	function post_comment($post)
	{
		if(!empty($post['comment']))
		{
			$query = "INSERT INTO comments (user_id, message_id, comment, created_at, updated_at) VALUES ('{$_SESSION['user_id']}', '{$post['message_id']}', '{$post['comment']}', NOW(), NOW());";

			run_mysql_query($query);
		}
		header('Location: wall.php');
		die();
	}

	function delete_comment($post)
	{
		$query = "DELETE FROM comments WHERE id = '{$post['comment_id']}';";

		run_mysql_query($query);
		
		header('Location: wall.php');
		die();
	}

?>