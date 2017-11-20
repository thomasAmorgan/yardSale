<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <?php
      include 'databaseConnect.php';
    ?>
  </head>

  <body>

    <h3>Search Results</h3>

    <div class="">
      <a href="/yardSale/homePageLogin.php">Home</a>
      <a href="/yardSale/userPage.php">User Page</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>

    <hr>

    <?php
      $searchString = $_POST["searchBar"];
      $searchOption = $_POST["searchOptions"];

      // will display all the yardsales in the database when nothing is searched
        if (isset($_POST['searchBar'])) {
          // echo "$searchOption";
          // echo "%$searchString%";

          $searchQuery = "SELECT * FROM YardSales
                          WHERE '$searchOption'
                          LIKE '%$searchString%'";

          $searchResult = $mysqli->query($searchQuery);
          echo "$searchResult->num_rows";

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
          if ($_SESSION['loggedIn'] == false) {
            $_SESSION['status'] = "failed";
            header("Location: /yardSale/homePageOpen.php");
          }

          else {
            header("Location: /yardSale/homePageLogin.php");
          }
        }
     ?>


  </body>
</html>
