<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <script type="text/javascript">
      function log() {
        console.log("search results");
      }
    </script>

    <?php
      include 'functions/databaseConnect.php';
      // $host = 'localhost';
      // $username = 'root';
      // $password = 'Muffin380!'; //enter password
      // $database = 'yardSaleDatabase'; //Enter database name
      // $mysqli = new mysqli($host, $username, $password, $database);

      $searchString = $_POST["searchBar"];
      $searchOption = $_POST["searchOptions"];

      // will display all the yardsales in the database when nothing is searched
        if (empty($searchString) || empty($_POST["searchBar"])) {
          // if ($mysqli->connect_errno) {
          //   echo "Could not connect to database \n";
          //   echo "Error: ". $mysqli->connect_error . "\n";
          //   exit;
          // }

          // else {
            $allYardSales = "SELECT * FROM YardSales";
            $result = $mysqli->query($allYardSales);

            // if (!$queryResult  = $mysqli->query($allYardSales)) {
            //   echo "Query failed, loser." . $mysqli->error . "\n";
            //   exit;
            // }

            // https://www.w3schools.com/php/php_mysql_select.asp
            else {
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<br> <h3>" . $row["yardSaleName"] . "</h3>" .
                       "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
                       "Host: " . $row["userID"] . "<br>" .
                       "Address: " . $row["address"] . "<br>" .
                       "Date: " . $row["dateTime"] . "<br>" .
                       "Description: " . $row["yardSaleDescription"] . "<br>";
                }
              }

              else {
                echo "There are no yardsales";
              }
            }
          // }
          }

        else {
          $searchQuery = "SELECT * FROM YardSales
                          WHERE '$searchOption'
                          LIKE '$searchBar'";
          echo "<script> log(); </script>";

          $searchResult = $mysqli->query($searchQuery);

          // if (!$queryResult  = $mysqli->query($searchQuery)) {
          //   echo "Query failed, loser." . $mysqli->error . "\n";
          //   exit;
          // }

          // https://www.w3schools.com/php/php_mysql_select.asp
          // else {
            if ($searchResult->num_rows > 0) {

              while ($row = $searchResult->fetch_assoc()) {
                echo "<br> <h3>" . $row["yardSaleName"] . "</h3>" .
                     "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
                     "Host: " . $row["userID"] . "<br>" .
                     "Address: " . $row["address"] . "<br>" .
                     "Date: " . $row["dateTime"] . "<br>" .
                     "Description: " . $row["yardSaleDescription"] . "<br>";
              }
              $searchString = "";
              $searchOption = "";
            }

            else {
              echo "<br>";
              echo "There are no yardsales that match the search";
            }
          }
        }
     ?>

  </head>



  <body>
    <div class="">
      <a href="#">View Yardsales</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>

    <hr>

     <div class="">
       <form class="" action="" method="post">
         <label for="searchBar">Search: </label>
         <input type="text" name="searchBar" id="searchBar">
         <select name="searchOptions" id="searchOptions"></select>
         <button type="submit" formmethod="post">Search</button>
       </form>
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
