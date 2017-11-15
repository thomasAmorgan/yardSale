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

if ($yardSaleMonth == "Jan") {
  $yardSaleMonth = "01";
}
elseif ($yardSaleMonth == "Feb") {
  $yardSaleMonth = "02";
}
elseif ($yardSaleMonth == "Mar") {
  $yardSaleMonth = "03";
}
elseif ($yardSaleMonth == "Apr") {
  $yardSaleMonth = "04";
}
elseif ($yardSaleMonth == "May") {
  $yardSaleMonth = "05";
}
elseif ($yardSaleMonth == "June") {
  $yardSaleMonth = "06";
}
elseif ($yardSaleMonth == "July") {
  $yardSaleMonth = "07";
}
elseif ($yardSaleMonth == "Aug") {
  $yardSaleMonth = "08";
}
elseif ($yardSaleMonth == "Sept") {
  $yardSaleMonth = "09";
}
elseif ($yardSaleMonth == "Oct") {
  $yardSaleMonth = "10";
}
elseif ($yardSaleMonth == "Nov") {
  $yardSaleMonth = "11";
}
elseif ($yardSaleMonth == "Dec") {
  $yardSaleMonth = "12";
}

settype($yardSaleDay);
settype($yardSaleYear);

$yardSaleDate = "$yardSaleMonth" . "/" . "$yardSaleDay" . "/" . "$yardSaleYear";

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
    echo "<a href='/yardSale/homePageLogin.php'>Home</a>";
    // header("Location: /yardSale/homePageLogin.php");
    exit;
  }
}


?>
