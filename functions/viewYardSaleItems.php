<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
    <?php
      include 'databaseConnect.php';

      if ($_SESSION['loggedIn'] == false) {
        $_SESSION['status'] = "failed";
        header("location: loginPage.php");
      }
    ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~~ -->
  </head>

  <body>

    <h1>YardSale!</h1>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <a href="/yardSale/homePageLogin.php">Home</a>
      <a href="/yardSale/userPage.php">User Page</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <hr>

    <?php
//~~~~~~~~~~~~~~~~~~~~~~~~ START: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~
      $yardSaleID = $_POST['viewItems'];

      $findYardSaleMatch = "SELECT * FROM YardSales
                            WHERE yardSaleID = '$yardSaleID'";

      $matchResult = $mysqli->query($findYardSaleMatch);

      if ($matchResult->num_rows > 0) {
        while ($row = $matchResult->fetch_assoc()) {
          echo "<h3>" . $row["yardSaleName"] . "</h3>" .
               "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
               "Host: " . $row["userID"] . "<br>" .
               "Address: " . $row["streetAddress"] . ", " . $row["city"] . " "
               . $row["state"] . " " . $row["zipCode"] .  "<br>" .
               "Date: " . $row["yardSaleDate"] . "<br>" .
               "Time: " . $row["yardSaleTime"] . "<br>" .
               "Description: " . $row["yardSaleDescription"] . "<br><br>";

               echo "<b>Items:</b><br>";

               $displayItems = "SELECT * FROM Merchandise
                                WHERE yardSaleID = '$yardSaleID'";

               $displayResult = $mysqli->query($displayItems);

               if ($displayResult->num_rows > 0) {
                 while ($row = $displayResult->fetch_assoc()) {
                   echo "<br><b> Merch ID: " . $row["merchID"] . "</b> <br>" .
                        "Name: " . $row["itemName"] . "<br>" .
                        "Price: $" . $row["price"] .  "<br>" .
                        "Sold: " . $row["sold"] . "<br>" .
                        "Description: " . $row["description"] . "<br>";
                 }
               }
        }
      }

      else {
        echo "Invalid Yardsale ID";
      }

//~~~~~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~
     ?>


  </body>
</html>
