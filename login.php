<?php

	session_start();

	if ($_GET["logout"] == 1 AND $_SESSION['id']) {

		session_destroy();
		$logoutMessage = "You have been successfully logged out!";

	}

	include("connection.php");

	if ($_POST['submit'] == "Sign up") {

		if (!$_POST['email']) $error.="Please enter your email<br />";
			else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="Please enter a valid email address<br />";

		if (!$_POST['password']) $error.="Please enter a password<br />";
			else {
				if (strlen($_POST['password']) < 8) $error.="Passwords must be at least 8 characters long<br />";
				if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="Passwords must contain a capital letter<br />";
			}

		if ($error) $error = "There were problems! <br />".$error;
		else {
			$email = strtolower($_POST['email']);
			// Add the user to the database iff they're not already registered
			$query = "SELECT * FROM users WHERE `email`='".mysqli_real_escape_string($link, $email)."'";
			$result = mysqli_query($link, $query);
			$results = mysqli_num_rows($result);
			if ($results) $error = "That email address is already registered! Do you want to log in?";
			else {
				$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $email)."', '".md5(md5($email).$_POST['password'])."')";
				mysqli_query($link, $query);


				//put some default text into the diary
				$query = "INSERT INTO `users` (`diary`) VALUES ('Welcome to Yournal!\n\nAnything you type here will be automatically saved and can be accessed whenever you have internet access.\n\nThis is just default text - feel free to delete it and get writing!')";
				mysqli_query($link, $query);

				$_SESSION['id'] = mysqli_insert_id($link);

				header("Location: mainpage.php");

			}


		}

	}

	if ($_POST['submit'] == "Log in") {

		$loginEmail = strtolower($_POST['loginEmail']);

		$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link, $loginEmail)."' AND password='" .md5(md5($loginEmail).$_POST['loginPassword'])."' LIMIT 1";

		$result = mysqli_query($link, $query);

		$row = mysqli_fetch_array($result);

		if ($row) {

			$_SESSION['id'] = $row['ID'];
			header("Location: mainpage.php");

		} else {

			$error = "We could not find a user with that email and password";

		}

	}

?>