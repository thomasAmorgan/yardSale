<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
    <?php
      include 'databaseConnect.php';

      if ($_SESSION['loggedIn'] == false) {
        $_SESSION['status'] = "failed";
        header("location: loginPage.php");
      }

      $userName = $_SESSION['userName'];
      $merchID = $_POST['editMerch'];
      $yardSaleID = $_SESSION['yardSaleID'];

      $_SESSION['merchID'] = $merchID;

      $itemName;
      $description;
      $price;
      $userID;
      $sold;
    ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~~ -->
  </head>

  <body>
    <h3>Edit Item</h3>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <a href="/yardSale/homePageLogin.php">Home</a>
      <a href='/yardSale/newYardSalePage.php'>Create Yardsale</a>
      <a href='/yardSale/functions/logout.php'>Logout</a>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <hr>

    <div class="">
      <?php
//~~~~~~~~~~~~~~~~~~~~~~~~ START: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~
// also saves all the values from the yardsale being edited
        if (!empty($_POST)) {
          $findYardSaleMatch = "SELECT * FROM Merchandise
                                WHERE merchID = '$merchID'
                                AND yardSaleID = '$yardSaleID'";

          $matchResult = $mysqli->query($findYardSaleMatch);

          if ($matchResult->num_rows > 0) {
            while ($row = $matchResult->fetch_assoc()) {
              $itemName = $row['itemName'];
              $description = $row['description'];
              $price = $row['price'];
              $userID = $row['userID'];
              $sold = $row['sold'];

              echo "<b> Merch ID: " . $row["merchID"] . "</b> <br>" .
                   "Name: " . $row["itemName"] . "<br>" .
                   "Price: $" . $row["price"] .  "<br>" .
                   "Sold: " . $row["sold"] . "<br>" .
                   "Description: " . $row["description"] . "<br>";

              echo "<p><b>Edit Info Below</b></p>";
            }

// ~~~~~~~~~~~~~~~~~~~~~~~~~ START: UPDATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            if ($userName == $userID) {
              echo "	<div>
                  <!-- should call another file that will insert the item -->
              		<form action='updateMerch.php' method='post'>
                    <p><b>Add an Item</b></p>
              			<label for='itemName'>Name: </label>
              			<input type='text' name='itemName' id='itemName'
                     value='$itemName' required>
                    <br>

              			<label for='itemPrice'>Price: </label>
              			<input type='number' name='itemPrice' id='itemPrice'
                     value='$price' required>
                    <br>

                    <label for='itemSold'>Price: </label>
                    <select id='itemSold' name='itemSold'>
                      <option selected>$sold</option>
                      <option>true</option>
                      <option>false</option>
                    </select>

                    <p>Description</p>
              			<textarea id='description' name='itemDescription' rows='10' cols='50'
                              required>$description
                    </textarea>

              			<br>
              			<br>
              			<button type='submit' formmethod='post' name='button'>Create</button>
                    <br>
              		</form>
              	</div>";
            }

            elseif ($userName != $userID) {
              echo "<p><b>User ID does not match! You can only edit your own
                    items.</b></p>";
            }
// ~~~~~~~~~~~~~~~~~~~~~~~~~~ END: UPDATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          }

          else {
            echo "Invalid Item ID";
          }
        }
//~~~~~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~
       ?>
    </div>
  </body>
</html>
