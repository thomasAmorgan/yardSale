<?php
//$Host = '128.163.141.169';
$host = 'localhost';
$username = 'root';
$password = 'Muffin380!'; //enter password
$database = 'yardSaleDatabase'; //Enter database name
$mysqli = new mysqli($host, $username, $password, $database);

if(empty($_POST['newUserName'])) {
        echo "Error: Missing Username.";
        echo "<hr>";
        echo "<a href='/yardSale/registerPage.php'>Register</a>";
}

else if(empty($_POST['newUserPassword'])) {
        echo "Error: Missing Password.";
        echo "<hr>";
        echo "<a href='/yardSale/registerPage.php'>Register</a>";
}

else {
	$newUserName = $_POST["newUserName"];
	$newUserPassword = $_POST["newUserPassword"];

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
          		echo "Error: Account already exist, please login.";
			        echo "<hr>";
			        echo "<a href='/yardSale/loginPage.php'>Login</a>";
          		//echo "<script 'type/javascript'> location.href = 'registerPage.php'; </script>";
        	}

        	else {
			         $registerQuery = "INSERT INTO logins (userID, password)
					     VALUES ('$newUserName', '$newUserPassword')";

			         if (!$queryResult = $mysqli->query($registerQuery)) {
				             echo "Register query failed." . $mysqli->error ."\n";
				             exit;
			         }

               echo "You registered! ;)";
			         echo "<hr>";
			         echo "<a href='/yardSale/loginPage.php'>Login</a>";
         }
	}
}

?>
