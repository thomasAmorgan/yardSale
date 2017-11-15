<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <body>
    <div class="">
      <a href="#">View Yardsales</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/loginPage.php'>Logout</a>
    </div>

    <hr>

    <div class="">
      <?php
      $host = 'localhost';
      $username = 'root';
      $password = 'Muffin380!'; //enter password
      $database = 'yardSaleDatabase'; //Enter database name
      $mysqli = new mysqli($host, $username, $password, $database);

      if ($mysqli->connect_errno) {
        echo "Could not connect to database \n";
        echo "Error: ". $mysqli->connect_error . "\n";
        exit;
      }

      else {
        $allYardSales = "SELECT * FROM YardSales";

        if (!$queryResult  = $mysqli->query($allYardSales)) {
          echo "Query failed, loser." . $mysqli->error . "\n";
          exit;
        }

        else {
          echo $queryResult;
        }
      }
      ?>
    </div>


  </body>

</html>
