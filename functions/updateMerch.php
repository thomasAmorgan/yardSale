<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $itemName = $_POST['itemName'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  $userID = $_SESSION['userName'];
  $yardSaleID = $_SESSION['yardSaleID'];
  $merchID = $_SESSION['merchID'];
  $price = $_SESSION['merchPrice'];
  $sold = $_SESSION['merchSold'];

  $deleteMatch = "DELETE FROM Merchandise WHERE merchID = '$merchID'
                  AND yardSaleID = '$yardSaleID'
                  AND userID = '$userID'";

  if ($mysqli->query($deleteMatch) === true) {
    $createMerchQuery = "INSERT INTO Merchandise (merchID, itemName,
                         description, price, userID, yardSaleID, sold)
                         VALUES ('$merchID', '$itemName', '$itemDescription',
                         '$itemPrice', '$userID', '$yardSaleID', true)";

    $createMerchResult = $mysqli->query($createMerchQuery);

    $_SESSION['yardSaleID'] = "";
    $_SESSION['merchID'] = "";
    $_SESSION['merchPrice'] = "";
    $_SESSION['merchSold'] = "";

    header("Location: /yardSale/addMerchandise.php");
  }

  else {
    header("Location: /yardSale/addMerchandise.php");
  }
?>
