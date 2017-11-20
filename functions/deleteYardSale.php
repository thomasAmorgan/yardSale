<?php
  session_start();

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $yardSaleID = $_POST['deleteYardSale'];
  $userID = $_SESSION['userName'];

  if (!empty($_POST)) {
    $deleteQuery = "DELETE FROM YardSale WHERE yardSaleID = $yardSaleID";
    $query = $mysqli->query($deleteQuery);
    header("Location: /yardSale/userPage.php");
  }

 ?>
