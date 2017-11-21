<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $yardSaleName = $_POST['yardSaleName'];

  $yardSaleStreet = $_POST['yardSaleStreet'];
  $yardSaleCity = $_POST['yardSaleCity'];
  $yardSaleState = $_POST['yardSaleState'];
  $yardSaleZip = $_POST['yardSaleZip'];

  $yardSaleMonth = $_POST['yardSaleMonth'];
  $yardSaleDay = $_POST['yardSaleDay'];
  $yardSaleYear = $_POST['yardSaleYear'];

  $yardSaleHour = $_POST['yardSaleHour'];
  $yardSaleAMPM = $_POST['yardSaleAMPM'];

  $yardSaleDescription = $_POST['yardSaleDescription'];

  $userID = $_SESSION['userName'];
  $yardSaleID = $_SESSION['yardSaleID'];

  $yardSaleDate = "$yardSaleMonth" . '/' . "$yardSaleDay" . '/' . "$yardSaleYear";
  $yardSaleTime = "$yardSaleHour" . "$yardSaleAMPM";

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

    $_SESSION['yardSaleID'] = "";

    header("Location: /yardSale/userPage.php");
  }

  else {
    header("Location: /yardSale/userPage.php");
  }
?>
