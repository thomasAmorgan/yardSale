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
        <input type="text" name="amount" id="amount">
        <select name="promoPrice" id="promoPrice"></select>
        <button type="submit" formmethod="post">View Items</button>
      </form>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~ END: CHANGE PROMOS/PRICE FORM ~~~~~~~~~~~~~~~~~~~~~~ -->


  </body>
</html>
