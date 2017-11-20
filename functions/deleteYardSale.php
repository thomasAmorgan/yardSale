<?php
  session_start();
  include 'functions/databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $yardSaleID = $_POST['deleteYardSale'];
  echo "$yardSaleID";
  $userID = $_SESSION['userName'];

  if (!empty($_POST)) {
    $deleteQuery = "DELETE FROM YardSales WHERE yardSaleID = '$yardSaleID'";
    $query = $mysqli->query($deleteQuery);
    // header("Location: /yardSale/userPage.php");
  }

 ?>
