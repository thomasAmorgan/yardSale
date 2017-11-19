<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <h3><?php $_SESSION['userName'] ?></h3>

    <div class="">
      <a href="/yardSale/homePageLogin.php">Home</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>

    <hr>

    <div class="">
      <?php
        include 'functions/databaseConnect.php';\
        // will display all the yardsales in the database when nothing is searched

        $userName = $_SESSION['userName'];
        $userYardSales = "SELECT * FROM YardSales
                          WHERE userID = '$userName'";
        $result = $mysqli->query($userYardSales);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<br> <h3>" . $row["yardSaleName"] . "</h3>" .
                 "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
                 "Host: " . $row["userID"] . "<br>" .
                 "Address: " . $row["address"] . "<br>" .
                 "Date: " . $row["yardSaleDate"] . "<br>" .
                 "Description: " . $row["yardSaleDescription"] . "<br>";
          }
        }

        else {
          echo "There are no yardsales";
        }

        ?>
    </div>


  </body>
</html>
