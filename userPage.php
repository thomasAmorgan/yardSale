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


  </body>
</html>
