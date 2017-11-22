<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $yardSaleID = $_POST['deleteYardSale'];
  $userID = $_SESSION['userName'];

  // also needs to delete items associated with the yardSale
  if (!empty($_POST)) {
    $deleteQuery = "DELETE FROM YardSales
                    WHERE yardSaleID = '$yardSaleID'
                    AND userID = '$userID'";

    if ($mysqli->query($deleteQuery) === true) {

      $deleteItems = "DELETE FROM Merchandise
                      WHERE yardSaleID = '$yardSaleID'
                      AND userID = '$userID'";

      if ($mysqli->query($deleteItems) === true) {
        header("Location: /yardSale/userPage.php");

      header("Location: /yardSale/userPage.php");
    }

    else {
      header("Location: /yardSale/userPage.php");
    }
  }
 ?>
