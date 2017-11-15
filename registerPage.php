<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Register</title>
</head>

<body>

	<div>
		<h1>Register</h1>

      <p>Register Here</p>

        <form action="functions/registerQuery.php" method="post">
          <label for="userName">Username: </label>
          <input type="text" name="newUserName" id="newUserName" required>
          <br>
			    <label for="newUserPassword">Password: </label>
			    <input type="password" name="newUserPassword" id="newUserPassword" required>
          <br>
			    <button type="submit" formmethod="post">Register</button>
        </form>

        <hr>
        <a href="loginPage.php">Login</a>
        <a href='/yardSale/homePageOpen.php'>Home</a>
	</div>

</body>
</html>
