<?php

$host = 'localhost';
$username = 'root';
$password = 'Muffin380!'; //enter password
$database = 'yardSaleDatabase'; //Enter database name
$mysqli = new mysqli($host, $username, $password, $database);

$yardSaleID;
$idOK = false;

function generateID() {
  $randNumber = rand(0, 999999);
  return $randNumber;
}

function checkID() {
  $yardSaleID = generateID();

  if ($mysqli->connect_errno) {
          echo "Could not connect to database \n";
          echo "Error: ". $mysqli->connect_error . "\n";
          exit;
  }

  else {

    while (!$idOK) {
      $checkYardSaleID =  "SELECT yardSaleID
                           FROM YardSales
                           WHERE yardSaleID = '$yardSaleID'";

      // problem is here
      if (!$queryResult  = $mysqli->query($checkYardSaleID)) {
        echo "Query failed, loser." . $mysqli->error . "\n";
        exit;
      }

      else if($queryResult->num_rows === 1) {
        $yardSaleID = generateID();
      }

      else {
        $idOK = true;
        return $yardSaleID;
      }
    }
  }
}






 ?>
