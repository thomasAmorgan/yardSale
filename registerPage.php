<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Register</title>

  <script type="text/javascript">
    function accountExist() {
      alert("Account already exist, please login.");
    }
    function registerSuccess() {
      alert("You successfully registered!");
    }
  </script>

  <?php
    include 'functions/databaseConnect.php';

    $newUserName = $_POST["newUserName"];
    $newUserPassword = $_POST["newUserPassword"];

    if (!empty($_POST)) {

      $checkQuery = "SELECT userID
                     FROM logins
                     WHERE userID = '$newUserName'";

      $result = $mysqli->query($checkQuery);

      if ($result->num_rows === 1) {
        echo "<script> accountExist(); </script>";
      }

      else {
    		$registerQuery = "INSERT INTO logins (userID, password)
    					            VALUES ('$newUserName', '$newUserPassword')
                         ";

        $addUser = $mysqli->query($registerQuery);
        header("Location: /yardSale/loginPage.php");
      }
    }
  ?>
</head>

<body>
	<div>
		<h3>Register</h3>

      <p>Register Here</p>

        <form action="" method="post">
          <label for="userName">Username: </label>
          <input type="text" name="newUserName" id="newUserName" required>
          <br>
			    <label for="newUserPassword">Password: </label>
			    <input type="password" name="newUserPassword" id="newUserPassword" required>
          <br>
			    <button type="submit" formmethod="post">Register</button>
        </form>

        <br>
        <p>After successfully registering, you will be taken to the login page.</p>

        <hr>
        <a href='/yardSale/homePageOpen.php'>Home</a>
        <a href="loginPage.php">Login</a>
	</div>

</body>
</html>
