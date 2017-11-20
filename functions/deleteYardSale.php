<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $yardSaleID = $_POST['deleteYardSale'];
  echo "$yardSaleID";

  if (!empty($_POST)) {
    $deleteQuery = "DELETE FROM YardSales WHERE yardSaleID = '$yardSaleID'
                    AND userID = '$userID'";

    if ($mysqli->query($deleteQuery) === true) {
      echo "Success";
      header("Location: /yardSale/userPage.php");
    }

    else {
      echo "Failure";
      header("Location: /yardSale/userPage.php");
    }
  }

 ?>
