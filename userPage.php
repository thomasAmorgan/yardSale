<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <?php
      if ($_SESSION['loggedIn'] == false) {
        $_SESSION['status'] = "failed";
        header("location: loginPage.php");
      }
    ?>

    <?php $userName = $_SESSION['userName']; ?>
  </head>
  <body>

    <div class="">
      <?php echo "<h3> Hi, " . $userName . "</h3>"; ?>
    </div>

    <div class="">
      <a href="/yardSale/homePageLogin.php">Home</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>

    <hr>

    <div class="">
      <p>To delete a yardsale enter its ID and press delete</p>
      <form class="" action="functions/deleteYardSale.php" method="post">
        <label for="deleteYardSale"></label>
        <input type="text" name="deleteYardSale" id="deleteYardSale">
        <button type="submit" formmethod="post">Delete</button>
      </form>
    </div>

    <div class="">
      <?php
        include 'functions/databaseConnect.php';
        // will display all the yardsales in the database when nothing is searched

        $userYardSales = "SELECT * FROM YardSales
                          WHERE userID = '$userName'";
        $result = $mysqli->query($userYardSales);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<br> <h3>" . $row["yardSaleName"] . "</h3>" .
                 "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
                 "Host: " . $row["userID"] . "<br>" .
                 "Address: " . $row["streetAddress"] . ", " . $row["city"] . " "
                 . $row["state"] . " " . $row["zipCode"] .  "<br>" .
                 "Date: " . $row["yardSaleDate"] . "<br>" .
                 "Time: " . $row["yardSaleTime"] . "<br>" .
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
