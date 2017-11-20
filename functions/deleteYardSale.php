<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $yardSaleID = $_POST['deleteYardSale'];
  echo "$yardSaleID";
  $userID = $_SESSION['userName'];

  if (!empty($_POST)) {
    $deleteQuery = "DELETE FROM YardSales WHERE yardSaleID = '$yardSaleID'";

    if ($mysqli->query($deleteQuery) === true) {
      echo "Success";
    }

    else {
      echo "Failure";
    }

    // $result = $mysqli->query($deleteQuery);
    // header("Location: /yardSale/userPage.php");
  }

 ?>
