<?php

  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $amount = $_POST['amount'];
  $promoPrice = $_POST['promoPrice'];

  $updatePromoPriceQuery = "UPDATE Discount
                            SET $promoPrice = $amount";

  $updatePromoPriceResult = $mysqli->query($updatePromoPriceQuery);

  header("Location: /yardSale/managersPage.php");

 ?>
