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
    //$Host = '128.163.141.169';
    $host = 'localhost';
    $username = 'root';
    $password = 'Muffin380!'; //enter password
    $database = 'yardSaleDatabase'; //Enter database name
    $mysqli = new mysqli($host, $username, $password, $database);
    $newUserName = $_POST["newUserName"];
    $newUserPassword = $_POST["newUserPassword"];

    if (!empty($_POST)) {

      if ($mysqli->connect_errno) {
            	echo "Could not connect to database \n";
            	echo "Error: ". $mysqli->connect_error . "\n";
            	exit;
    	}

    	else {
            	$checkQuery = "SELECT userID
                           	 FROM logins
                             WHERE userID = '$newUserName'";

            	if (!$queryResult = $mysqli->query($checkQuery)) {
              		echo "Query failed, loser." . $mysqli->error . "\n";
              		exit;
            	}
            	else if ($queryResult->num_rows === 1) {
                echo "<script> accountExist(); </script>";
            	}

            	else {
    			         $registerQuery = "INSERT INTO logins (userID, password)
    					     VALUES ('$newUserName', '$newUserPassword')";

    			         if (!$queryResult = $mysqli->query($registerQuery)) {
    				             echo "Register query failed." . $mysqli->error ."\n";
    				             exit;
    			         }

                   header("Location: /yardSale/loginPage.php");
             }
    	}
    }
  ?>

</head>

<body>

	<div>
		<h1>Register</h1>

      <p>Register Here</p>

        <form action="<?php echo $PHP_SELF;?>" method="post">
          <label for="userName">Username: </label>
          <input type="text" name="newUserName" id="newUserName" required>
          <br>
			    <label for="newUserPassword">Password: </label>
			    <input type="password" name="newUserPassword" id="newUserPassword" required>
          <br>
			    <button type="submit" formmethod="post">Register</button>
        </form>

        <br>
        <p>After a successfully registering, you will be taken to the login page.</p>

        <hr>
        <a href="loginPage.php">Login</a>
        <a href='/yardSale/homePageOpen.php'>Home</a>
	</div>

</body>
</html>
