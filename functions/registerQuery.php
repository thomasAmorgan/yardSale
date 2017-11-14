<?php
// This is a basic script showing how to connect to a local MySQL database
// and execute a query

// First, let's get our variables from the previous page
// remember, we stored them in a "post" variable called "professor"
//$newUserName = $_POST["newUserName"];
//$newUserPassword = $_POST["newUserPassword"];

// Now, we will create a mysqli object and connect to database
//$Host = '128.163.141.169';
$host = 'localhost';
$username = 'root';
$password = 'Muffin380!'; //enter password
$database = 'yardSaleDatabase'; //Enter database name
$mysqli = new mysqli($host, $username, $password, $database);

// Check for connection error
// If there is an error we will use $mysqli->connect_error
// to print the cause of the error

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
                               WHERE userID = '$newUserName'
                               ";

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
