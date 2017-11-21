<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
    <?php
      if ($_SESSION['loggedIn'] == false) {
        $_SESSION['status'] = "failed";
        header("location: loginPage.php");
      }

      $userName = $_SESSION['userName'];
    ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~~ -->
  </head>
  <body>

    <div class="">
      <?php echo "<h3> Hi, " . $userName . "</h3>"; ?>
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <a href="/yardSale/homePageLogin.php">Home</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <hr>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~ START: DELETE FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <p>To delete a yardsale enter its ID and press delete</p>
      <form class="" action="functions/deleteYardSale.php" method="post">
        <label for="deleteYardSale"></label>
        <input type="text" name="deleteYardSale" id="deleteYardSale">
        <button type="submit" formmethod="post">Delete</button>
      </form>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ END: DELETE FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: EDIT FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <p>To edit a yardsale enter its ID and press edit</p>
      <form class="" action="functions/editYardSale.php" method="post">
        <label for="editYardSale"></label>
        <input type="text" name="editYardSale" id="editYardSale">
        <button type="submit" formmethod="post">Edit</button>
      </form>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: EDIT FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: EDIT ITEMS ~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <p>To edit a yardsale's items enter its ID and press edit</p>
      <form class="" action="addMerchandise.php" method="post">
        <label for="editYardSaleItems"></label>
        <input type="text" name="editYardSaleItems" id="editYardSaleItems">
        <button type="submit" formmethod="post">Edit</button>
      </form>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: EDIT ITEMS ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~ START: SHOW USER YSs ~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <?php
        include 'functions/databaseConnect.php';
        // will display all the yardsales in the database when nothing is searched

        $userYardSales = "SELECT * FROM YardSales
                          WHERE userID = '$userName'";
        $result = $mysqli->query($userYardSales);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<h3>" . $row["yardSaleName"] . "</h3>" .
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
          echo "<br> <p>There are no yardsales</p>";
        }
      ?>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ END: SHOW USER YSs ~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  </body>
</html>
