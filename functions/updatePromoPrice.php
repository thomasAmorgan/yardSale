<?php

  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $amount = (int) $_POST['amount'];
  $promoPrice = $_POST['promoPrice'];

  $deleteMatch = "DELETE * FROM Discount";

  if ($mysqli->query($deleteMatch) === true) {
    $updatePromoPriceQuery = "INSERT INTO Discount
                              VALUES ('$amount', '$promoPrice')";

    $updatePromoPriceResult = $mysqli->query($updatePromoPriceQuery);

    header("Location: /yardSale/managersPage.php");
  }

  else {
    header("Location: /yardSale/managersPage.php");
  }

 ?>
