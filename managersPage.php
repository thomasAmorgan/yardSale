<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
    <?php
      include 'functions/databaseConnect.php';
      if ($_SESSION['loggedIn'] == false) {
        $_SESSION['status'] = "failed";
        header("location: loginPage.php");
      }

      if ($_SESSION['isManager'] == false) {
        header("location: homePageLogin.php");
      }
    ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~~ -->
  </head>

  <body>

    <h3>Manager Page</h3>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <a href="/yardSale/homePageLogin.php">Home</a>
      <a href="/yardSale/userPage.php">User Page</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <hr>

<!-- ~~~~~~~~~~~~~~~~~ START: CHANGE PROMOS/PRICE FORM ~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <form class="" action="functions/updatePromoPrice.php" method="post">
        <p>Adjust the promotion percent or the amount per advertisement.</p>
        <p>Promotion should be entered in as a decimal value example 0.4 = 40%</p>
        <input type="number" step="0.01" name="amount" id="amount">
        <select name="promoPrice" id="promoPrice">
          <option value="currentPromotion">Promotion</option>
          <option value="adPrice">Price</option>
        </select>
        <button type="submit" formmethod="post">Update</button>
      </form>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~ END: CHANGE PROMOS/PRICE FORM ~~~~~~~~~~~~~~~~~~~~~~ -->

    <div class="">
      <p><b>Current Promotion and Price/Ad</b></p>
      <?php
        $currentPromoPrice = "SELECT * FROM Discount";

        $result = $mysqli->query($currentPromoPrice);

        if ($result->num_rows > 0) {

          while ($row = $result->fetch_assoc()) {
            echo "Promotion: " . (($row["currentPromotion"] * 100)) . "%<br>" .
                 "Advertisement Price: $" . $row["adPrice"] .  "<br>";
          }
        }
       ?>
    </div>

<!-- ~~~~~~~~~~~~~~~~~~~~ START: DISPLAY TOTAL PROFITS ~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <p><b>Total Income</b></p>
      <?php
        $income = 0;
        $totalIncomeQuery = "SELECT discountPercentage, adPrice FROM YardSales";

        $incomeResult = $mysqli->query($totalIncomeQuery);

        if ($incomeResult->num_rows > 0) {
          while ($row = $incomeResult->fetch_assoc()) {
            $promo = $row['discountPercentage'];
            $price = $row['adPrice'];

            $calculatedPrice = $price - ($promo * $price);

            $income += $calculatedPrice;


          }
          echo "Income: $" . $income;
        }
      ?>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY TOTAL PROFITS ~~~~~~~~~~~~~~~~~~~~~~ -->

//~~~~~~~~~~~~~~~~~~~~~~~~ START: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~
// Displays all yardsales in the db
    <div class="">
      <p><b>Yardsale Incomes</b></p>
      <?php
          $allYardSales = "SELECT * FROM YardSales";
          $result = $mysqli->query($allYardSales);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<b>Name: " . $row["yardSaleName"] . "</b><br>" .
              "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
              "Host: " . $row["userID"] . "<br>" .
              "Date: " . $row["yardSaleDate"] . "<br>" .
              "Promotion: " . ($row["discountPercentage"] * 100) . "%<br>" .
              "Price: $" . $row["adPrice"] . "<br>" .
              "Profit: $" . ($row['adPrice'] - ($row["discountPercentage"] * $row['adPrice'])) . "<br><br>";
            }
          }

          else {
            echo "<br> <br>There are no yardsales";
          }
       ?>
    </div>
//~~~~~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~

  </body>
</html>
