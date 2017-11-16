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
		$host = 'localhost';
		$username = 'root';
		$password = 'Muffin380!'; //enter password
		$database = 'yardSaleDatabase'; //Enter database name
		$mysqli = new mysqli($host, $username, $password, $database);
		$userName = $_POST["userName"];
		$userPassword = $_POST["userPassword"];

		if (!empty($_POST)) {
			// Check for connection error
			// If there is an error we will use $mysqli->connect_error
			// to print the cause of the error
			if ($mysqli->connect_errno) {
							echo "Could not connect to database \n";
							echo "Error: ". $mysqli->connect_error . "\n";
							exit;
			}

			else {

							$loginQuery = "SELECT userID
														 FROM logins
														 WHERE userID = '$userName'
														 AND password = '$userPassword'";

							if (!$queryResult = $mysqli->query($loginQuery)) {
									echo "Query failed, loser." . $mysqli->error . "\n";
									exit;
							}

							else if ($queryResult->num_rows === 0) {
									// echo "Error: You don't have an account, plase make one.";
									// echo "<hr>";
									// echo "<a href='/yardSale/registerPage.php'>Register</a>";
									echo "<script> loginFailed(); </script>";
							}

							else {
									echo "You did it! ;)";
									header("Location: /yardSale/homePageLogin.php");
									exit;
							}
			}
		}
	?>
</head>

<body>
	<div>
		<h1>Yardsale</h1>

		<p>Enter Login Info</p>

      <form action="<?php echo $PHP_SELF;?>" method="post">
      <label for="userName">Username: </label>
			<input type="text" name="userName" id="userName" required>
			<br>
			<label for="userPassword">Password: </label>
			<input type="password" name="userPassword" required>
			<br>
			<button type="submit" formmethod="post">Login</button>
		</form>

		<hr>
		<a href="registerPage.php">Register</a>
		<a href='/yardSale/homePageOpen.php'>Home</a>

	</div>

</body>
</html>
