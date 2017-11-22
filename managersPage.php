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
      $userID = $_SESSION['userName'];
      $isManager = false;

      $checkManager = "SELECT * FROM UserProfiles
                       WHERE manager = 'true'
                       AND userID = '$userID'";

      $checkManagerResult = $mysqli->query($checkManager);

      if ($checkManagerResult->num_rows > 0) {
        $isManager = true;
      }

      else {
        header("location: homePageLogin.php");
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

<!-- ~~~~~~~~~~~~~~~~~ START: CHANGE PROMOS/PRICE FORM ~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <form class="" action="functions/updatePromoPrice.php" method="post">
        <p>Adjust the promotion percent or the amount per advertisement</p>
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
        include 'functions/databaseConnect.php';

        $currentPromoPrice = "SELECT * FROM Discount";

        $result = $mysqli->query($currentPromoPrice);

        if ($result->num_rows > 0) {

          while ($row = $result->fetch_assoc()) {
            echo "Promotion: " . (100 - ($row["currentPromotion"] * 100)) . "%<br>" .
                 "Advertisement Price: $" . $row["adPrice"] .  "<br>";
          }
        }
       ?>
    </div>


  </body>
</html>
