<?php session_start(); ?>
<!-- session start is necessary in order to know who is currently logged in  -->
<!DOCTYPE html>
<html>
<head>
	<title>YardSale</title>
<!-- <link rel="styleSheet" type="text/css" href="homePage.css"> -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: SCRIPT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- script that pops up an alert box to tell user that log in failed -->
	<script type="text/javascript">
		function loginFailed() {
			alert("Login failed, please try again or create an account.");
		}
	</script>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ END: SCRIPT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: LOGIN FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- performs the login query, checks if user exist and lets them in or not -->
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

			// if the user doesn't exist there will be no rows that much the credentials
			if ($result->num_rows === 0) {
				echo "<script> loginFailed(); </script>";
			}

			// saves userID so the user can be identified in other pages
			// redirects to a home page for logged in users
			else {
				$_SESSION['userName'] = $userName;
				$_SESSION['loggedIn'] = true;
				header("Location: /yardSale/homePageLogin.php");
				exit;
			}
		}
	?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: LOGIN FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
</head>

<body>

	<h3>Login</h3>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div class="">
		<a href='/yardSale/homePageOpen.php'>Home</a>
		<a href="registerPage.php">Register</a>
	</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

	<hr>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~ START: LOGIN FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div>
		<!-- handles the form input for logging in -->
    <form action="" method="post">
      <label for="userName">Username: </label>
			<input type="text" name="userName" id="userName" required>
			<br>
			<label for="userPassword">Password: </label>
			<input type="password" name="userPassword" required>
			<br>
			<button type="submit" formmethod="post">Login</button>
		</form>
	</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ END: LOGIN FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
</body>
</html>
