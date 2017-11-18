<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <?php
    include 'functions/databaseConnect.php';

    // $searchString = $_POST["searchBar"];
    // $searchOption = $_POST["searchOptions"];

    $searchString = "";
    $searchOption = "";

    // will display all the yardsales in the database when nothing is searched
      if (empty($searchString) || empty($_POST["searchBar"])) {

          $allYardSales = "SELECT * FROM YardSales";
          $result = $mysqli->query($allYardSales);

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
      }
    ?>

  <body>
    <div class="">
      <a href="#">View Yardsales</a>
      <a href='/yardSale/loginPage.php'>Login</a>
      <a href='/yardSale/registerPage.php'>Register</a>
    </div>

    <hr>

    <div class="">
      <?php  ?>
    </div>


  </body>

</html>
