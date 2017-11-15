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

    <?php
      $searchString = $_POST["searchBar"];
      $searchOption = $_POST["searchOptions"];
    ?>
      <form class="" action="<?php echo $PHP_SELF;?>" method="post">
        <label for="searchBar">Search: </label>
        <input type="text" name="searchBar" id="searchBar">
        <select name="searchOptions" id="searchOptions"></select>
        <button type="submit" formmethod="post">Search</button>
      </form>
    <?php
      echo $searchString . " " . $searchOption;
    ?>

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
          if ($queryResult->num_rows > 0) {
            while ($row = $queryResult->fetch_assoc()) {
              echo "<br> YardSale: " . $row["yardSaleID"] . " - Name: " . $row["yardSaleName"] . "<br>";
            }
          }

          else {
            echo "There are no yardsales";
          }
        }
      }
      ?>
    </div>
  </body>
</html>

<script type="text/javascript">
var optionsArray = ["yardSaleID", "userID", "dateTime", "address", "yardSaleName", "yardSaleDescription"];

var searchOptions = document.getElementById("searchOptions");

for (var i = 0; i < optionsArray.length; i++) {
  var opt = document.createElement("option");
  opt.value = optionsArray[i];
  opt.innerHTML = optionsArray[i];
  searchOptions.appendChild(opt);
}
</script>
