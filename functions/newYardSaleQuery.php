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

echo $yardSaleMonth;
echo $yardSaleDay;
echo $yardSaleYear;

$yardSaleDate = $yardSaleMonth + $yardSaleDay + $yardSaleYear;

echo $yardSaleDate;

if ($mysqli->connect_errno) {
        echo "Could not connect to database \n";
        echo "Error: ". $mysqli->connect_error . "\n";
        exit;
}

else {
  $createYardSaleQuery = "INSERT INTO YardSales (yardSaleID, userID, dateTime,
                          address, yardSaleName, yardSaleDescription)
                          VALUES ('ys1234', 'dummy', '$yardSaleDate',
                          '$yardSaleAddress', '$yardSaleName', '$yardSaleDescription')";

  if (!$queryResult  = $mysqli->query($createYardSaleQuery)) {
    echo "Query failed, loser." . $mysqli->error . "\n";
    exit;
  }

  else {
    echo "you did it?";
    echo "<a href='/yardSale/homePageLogin.php'>Home</a>";
    // header("Location: /yardSale/homePageLogin.php");
    exit;
  }
}


?>
