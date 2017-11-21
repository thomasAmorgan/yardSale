<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $itemName = $_POST['itemName'];
  $price = $_POST['itemPrice'];
  $description = $_POST['itemDescription'];
  $sold = $_POST['itemSold'];

  $userID = $_SESSION['userName'];
  $yardSaleID = $_SESSION['yardSaleID'];
  $merchID = $_SESSION['merchID'];

  $deleteMatch = "DELETE FROM Merchandise WHERE merchID = '$merchID'
                  AND yardSaleID = '$yardSaleID'
                  AND userID = '$userID'";

  if ($mysqli->query($deleteMatch) === true) {
    $createMerchQuery = "INSERT INTO Merchandise (merchID, itemName,
                         description, price, userID, yardSaleID, sold)
                         VALUES ('$merchID', '$itemName', '$description',
                         '$price', '$userID', '$yardSaleID', '$sold')";

    $createMerchResult = $mysqli->query($createMerchQuery);

    $_SESSION['yardSaleID'] = "";
    $_SESSION['merchID'] = "";

    header("Location: /yardSale/addMerchandise.php");
  }

  else {
    header("Location: /yardSale/addMerchandise.php");
  }
?>
