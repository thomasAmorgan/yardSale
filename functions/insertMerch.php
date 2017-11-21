<?php
  session_start();
  include 'databaseConnect.php';

  if ($_SESSION['loggedIn'] == false) {
    $_SESSION['status'] = "failed";
    header("location: loginPage.php");
  }

  $itemName = $_POST['itemName'];
  $itemPrice = (int) $_POST['itemPrice'];
  $itemDescription = $_POST['itemDescription'];

  $userID = $_SESSION['userName'];
  $yardSaleID = $_SESSION['yardSaleID'];

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~ START: GENERATE ID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  function generateID() {
    $randNumber = rand(0, 99999);
    return $randNumber;
  }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: GENERATE ID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~~~~~~~~~ START: CREATE YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~
  if (!empty($_POST)) {

    $randNum = generateID();
    $merchID = "item#" . "$randNum";

    $createMerchQuery = "INSERT INTO Merchandise (merchID, itemName,
                            description, price, userID, yardSaleID, sold)
                            VALUES ('$merchID', '$itemName', '$itemDescription',
                            '$itemPrice', '$userID', '$yardSaleID', false)";

    $createMerchResult = $mysqli->query($createMerchQuery);

    header("Location: /yardSale/addMerchandise.php");
  }
//~~~~~~~~~~~~~~~~~~~~~~~~~~ END: CREATE YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~


 ?>
