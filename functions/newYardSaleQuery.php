<?php
//$Host = '128.163.141.169';
$host = 'localhost';
$username = 'root';
$password = 'Muffin380!'; //enter password
$database = 'yardSaleDatabase'; //Enter database name
$mysqli = new mysqli($host, $username, $password, $database);

$yardSaleName = $_POST['yardSaleName'];
$yardSaleAddress = $_POST['yardSaleAddress'];
$yardSaleMonth = $_POST['yardSaleMonth'];
$yardSaleDay = $_POST['yardSaleDay'];
$yardSaleYear = $_POST['yardSaleYear'];
$yardSaleDescription = $_POST['yardSaleDescription'];

if ($mysqli->connect_errno) {
        echo "Could not connect to database \n";
        echo "Error: ". $mysqli->connect_error . "\n";
        exit;
}

else {
  $createYardSaleQuery = "";
}



echo "<h1>Under Construction</h1>";

?>
