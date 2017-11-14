<!DOCTYPE html>
<html>

<head>
<title>YardSale</title>
<!-- <link rel="styleSheet" type="text/css" href="homePage.css"> -->
</head>

<body>

	<div>
		<h1>Yardsale</h1>
                <p>did this work</p>

		<p>Enter Login Info</p>

        	<form action="functions/loginQuery.php" method="post">
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

	</div>

</body>
</html>
