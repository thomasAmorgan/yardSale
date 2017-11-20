<!-- Authors: Thomas Morgan d & Grayson Murphy
     Description: Main page, has links for user to login or register. Also
     displays all of the yardsales that are active.
-->

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <body>

    <h1>YardSale!</h1>

    <!-- simple navigation "bar" -->
    <div class="">
      <a href="/yardSale/homePageOpen.php">Home</a>
      <a href='/yardSale/loginPage.php'>Login</a>
      <a href='/yardSale/registerPage.php'>Register</a>
    </div>

    <hr>

    <!-- Displays all the active yardsales; with name, id, host, address,
         date, and description -->
    <div class="">
      <?php
        include 'functions/databaseConnect.php';

        $searchString = $_POST["searchBar"];
        $searchOption = $_POST["searchOptions"];

       //  will display all the yardsales in the database when nothing is searched
          if (!empty($_POST['searchBar'])) {

            $searchQuery = "SELECT * FROM YardSales
                            WHERE $searchOption
                            LIKE '%$searchString%'";

            $searchResult = $mysqli->query($searchQuery);

              if ($searchResult->num_rows > 0) {

                while ($row = $searchResult->fetch_assoc()) {
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
                echo "<br>";
                echo "There are no yardsales that match the search";
              }
          }

          else {
              $allYardSales = "SELECT * FROM YardSales";
              $result = $mysqli->query($allYardSales);

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
                echo "There are no yardsales";
              }
           }
        ?>
    </div>
  </body>
</html>
