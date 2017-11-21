<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $deleteMatch = "DELETE FROM YardSales WHERE yardSaleID = '$yardSaleID'
                  AND userID = '$userID'";

  if ($mysqli->query($deleteMatch) === true) {
    $createYardSaleQuery = "INSERT INTO YardSales (yardSaleID, userID,
                            yardSaleDate, yardSaleTime, streetAddress,
                            yardSaleName, yardSaleDescription, state,
                            zipCode, city)
                            VALUES ('$yardSaleID', '$userID', '$yardSaleDate',
                            '$yardSaleTime', '$yardSaleStreet', '$yardSaleName',
                            '$yardSaleDescription', '$yardSaleState',
                            '$yardSaleZip', '$yardSaleCity')";

    $createYardSaleResult = $mysqli->query($createYardSaleQuery);

    header("Location: /yardSale/userPage.php");
  }

  else {
    header("Location: /yardSale/userPage.php");
  }
?>
