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

     <?php
       include 'functions/databaseConnect.php';

       $searchString = $_POST["searchBar"];
       $searchOption = $_POST["searchOptions"];

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

         else {
           $searchQuery = "SELECT * FROM YardSales
                           WHERE '$searchOption'
                           LIKE '$searchString%'";
           echo "<script> log(); </script>";

           $searchResult = $mysqli->query($searchQuery);

             if ($searchResult->num_rows > 0) {

               while ($row = $searchResult->fetch_assoc()) {
                 echo "<br> <h3>" . $row["yardSaleName"] . "</h3>" .
                      "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
                      "Host: " . $row["userID"] . "<br>" .
                      "Address: " . $row["address"] . "<br>" .
                      "Date: " . $row["yardSaleDate"] .
                      "Time: " . $row["yardSaleTime"] . "<br>" .
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
      ?>
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
