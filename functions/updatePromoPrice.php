<?php

  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $amount = (int) $_POST['amount'];
  $promoPrice = $_POST['promoPrice'];

  // $deleteMatch = "TRUNCATE Discount";

  // if ($mysqli->query($deleteMatch) === true) {
    // $updatePromoPriceQuery = "INSERT INTO Discount (currentPromotion, adPrice)
    //                           VALUES ('$amount', '$promoPrice')";
    $updatePromoPriceQuery = "UPDATE Discount
                              SET $promoPrice ='$amount'";

    $updatePromoPriceResult = $mysqli->query($updatePromoPriceQuery);

    header("Location: /yardSale/managersPage.php");
  // }

  // else {
  //   header("Location: /yardSale/managersPage.php");
  // }

 ?>
