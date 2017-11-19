<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<title>YardSale</title>
<!-- <link rel="styleSheet" type="text/css" href="homePage.css"> -->

	<script type="text/javascript">
		function loginFailed() {
			alert("Login failed, please try again or create an account.");
		}
	</script>

	<?php
	include 'functions/databaseConnect.php';

	$userName = $_POST["userName"];
	$userPassword = $_POST["userPassword"];

		if (!empty($_POST)) {

			$loginQuery = "SELECT userID
										 FROM logins
										 WHERE userID = '$userName'
										 AND password = '$userPassword'";

			$result = $mysqli->query($loginQuery);

			if ($result->num_rows === 0) {
				echo "<script> loginFailed(); </script>";
			}

			else {
				$_SESSION['userName'] = $userName;
				$_SESSION['loggedIn'] = true;
				header("Location: /yardSale/homePageLogin.php");
				exit;
			}
		}
	?>
</head>

<body>
	<div>
		<h3>Login</h3>

		<p>Enter Login Info</p>

    <form action="" method="post">
      <label for="userName">Username: </label>
			<input type="text" name="userName" id="userName" required>
			<br>
			<label for="userPassword">Password: </label>
			<input type="password" name="userPassword" required>
			<br>
			<button type="submit" formmethod="post">Login</button>
		</form>

		<hr>
		<a href='/yardSale/homePageOpen.php'>Home</a>
		<a href="registerPage.php">Register</a>
	</div>

</body>
</html>
