<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Register</title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
-->
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
	</div>

</body>
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
-->
</html>

