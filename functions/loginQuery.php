<?php
//http://tamo234.netlab.uky.edu/yardSale/homePage.php
//https://gist.github.com/hofmannsven/9164408
//https://stackoverflow.com/questions/4871942/how-to-redirect-to-another-page-using-php
//https://stackoverflow.com/questions/29387236/how-to-create-a-link-to-another-php-page
//https://stackoverflow.com/questions/768431/how-to-make-a-redirect-in-php

// This is a basic script showing how to connect to a local MySQL database
// and execute a query

// First, let's get our variables from the previous page
// remember, we stored them in a "post" variable called "professor"
//$userName = $_POST["userName"];
//$userPassword = $_POST["userPassword"];

// Now, we will create a mysqli object and connect to database
//$Host = '128.163.141.169';
$host = 'localhost';
$username = 'root';
$password = 'Muffin380!'; //enter password
$database = 'yardSaleDatabase'; //Enter database name
$mysqli = new mysqli($host, $username, $password, $database);

if(empty($_POST['userName'])) {
	echo "Error: Missing Username.";
	echo "<hr>";
	echo "<a href='/yardSale/loginPage.php'>Login</a>";
}

else if(empty($_POST['userPassword'])) {
	echo "Error: Missing Password.";
  echo "<hr>";
	echo "<a href='/yardSale/loginPage.php'>Login</a>";
}

else {
	$userName = $_POST["userName"];
        $userPassword = $_POST["userPassword"];

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
                               WHERE userID = '$userName' AND password = '$userPassword'
                               ";

                if (!$queryResult = $mysqli->query($loginQuery)) {
                        echo "Query failed, loser." . $mysqli->error . "\n";
                        exit;
                }

                else if ($queryResult->num_rows === 0) {
                        echo "Error: You don't have an account, plase make one.";
			echo "<hr>";
                        echo "<a href='/yardSale/registerPage.php'>Register</a>";
                }

                else {
                        echo "You did it! ;)";
			header("Location: /yardSale/homePage.php");
                	exit;
		}
        }
}


?>
