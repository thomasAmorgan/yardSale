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
      <p><b>Current Promotion and Price</b></p>
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

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~ START: SEARCH FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <p><b>Filter</b></p>
      <p>To filter statistics for last week, month, or year select an option below and click filter</p>
      <form class="" action="" method="post">
        <label for="incomeStatistic">Income Statistics: </label>
        <select name="incomeStatistic" id="incomeStatistic">
          <option value="all">All</option>
          <option value="week">Week</option>
          <option value="month">Month</option>
          <option value="year">Year</option>
        </select>
        <button type="submit" formmethod="post">Filter</button>
      </form>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ END: SEARCH FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: SEARCH FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div class="">
    <?php
      if ($_POST['incomeStatistic'] != "all" && !empty($_POST['incomeStatistic'])) {

        $searchQuery = "SELECT * FROM YardSales";

        $searchResult = $mysqli->query($searchQuery);

        $currentDate = date("m/d/Y");

        $currentYear = substr($currentDate, 6, 4);

        $lastTotal = 0;
        $profitsLastWeek = 0;

        if ($searchResult->num_rows > 0) {

          while ($row = $searchResult->fetch_assoc()) {

            $yardSaleDate = $row['yardSaleDate'];
            $d = strtotime($yardSaleDate);

            // 01/01/2017
            $yardSaleYear = substr($yardSaleDate, 6, 4);

            $lastPromo = $row['discountPercentage'];
            $lastPrice = $row['adPrice'];

            $lastCalculatedPrice = $lastPrice - ($lastPromo * $lastPrice);

            $lastWeek = strtotime($currentDate) - (6 * 24 * 60 * 60);
            $twoWeeksAgo = strtotime($currentDate) - (2 * (6 * 24 * 60 * 60));

            // WEEK
            if ($_POST['incomeStatistic'] == "week") {

              if ((-1 * ($currentDate - $lastWeek)) >= $d && (-1 * ($currentDate - $twoWeeksAgo)) < $d) {
                $lastTotal += $lastCalculatedPrice;
                $profitsLastWeek += $lastCalculatedPrice;
              }
            }

            // MONTH
            elseif ($_POST['incomeStatistic'] == "month") {
              $lastMonth = strtotime($currentDate) - (30 * 24 * 60 * 60);
              $twoMonthsAgo = strtotime($currentDate) - (2 * (30 * 24 * 60 * 60));

              if ((-1 * ($currentDate - $lastWeek)) >= $d && (-1 * ($currentDate - $twoWeeksAgo)) < $d) {
                $profitsLastWeek += $lastCalculatedPrice;
              }

              if ((-1 * ($currentDate - $lastMonth)) >= $d && (-1 * ($currentDate - $twoMonthsAgo)) < $d) {
                $lastTotal += $lastCalculatedPrice;
              }
            }

            // YEAR
            else {
              if (((int)$currentYear - 1) == (int)$yardSaleYear) {
                $lastTotal += $lastCalculatedPrice;
              }
            }
          }

          if ($_POST['incomeStatistic'] == "week") {
            echo "<p><b>Last Week's Income</b></p>";
          }

          elseif ($_POST['incomeStatistic'] == "month") {
            $lastTotal = $lastTotal + $profitsLastWeek;
            echo "<p><b>Last Month's Income</b></p>";
          }

          else {
            echo "<p><b>Last Year's Income</b></p>";
          }
          echo "Income: $" . $lastTotal;
        }

        else {
          echo "<br>There are no yardsales that match the search";
        }
      }
     ?>
  </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: SEARCH FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~ START: DISPLAY TOTAL PROFITS ~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <?php
        if ($_POST['incomeStatistic'] == "all" || empty($_POST['incomeStatistic'])) {
          echo "<p><b>Total Income</b></p>";
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
        }
      ?>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY TOTAL PROFITS ~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~ START: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Displays all yardsales in the db -->
    <div class="">
      <?php
        if ($_POST['incomeStatistic'] == "all" || empty($_POST['incomeStatistic'])) {
          echo "<br><p><b>Yardsale Incomes</b></p>";
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
            echo "<br>There are no yardsales";
          }
        }
      ?>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~ -->

  </body>
</html>
