<?php

  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $merchID = $_POST['deleteItem'];
  $userID = $_SESSION['userName'];
  $yardSaleID = $_SESSION['yardSaleID'];

  if (!empty($_POST)) {
    $deleteQuery = "DELETE FROM Merchandise WHERE merchID = '$merchID'
                    AND yardSaleID = '$yardSaleID'
                    AND userID = '$userID'";

    if ($mysqli->query($deleteQuery) === true) {
      // header("Location: /yardSale/addMerchandise.php");
      echo "$merchID" . " " . "$userID" . " " . "$yardSaleID";
    }

    else {
      // header("Location: /yardSale/addMerchandise.php");
      echo "$merchID" . " " . "$userID" . " " . "$yardSaleID";
    }
  }

 ?>
