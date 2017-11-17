<?php
include 'functions/databaseConnect.php';

$yardSaleID;
$idOK = false;

function generateID() {
  $randNumber = rand(0, 999999);
  return $randNumber;
}

function checkID() {
  $yardSaleID = generateID();

    while (!$idOK) {
      $checkYardSaleID =  "SELECT yardSaleID
                           FROM YardSales
                           WHERE yardSaleID = '$yardSaleID'";

      $result = $mysqli->query($checkYardSaleID);

      else if($result->num_rows === 1) {
        $yardSaleID = generateID();
      }

      else {
        $idOK = true;
        return $yardSaleID;
      }
    }
}
 ?>
