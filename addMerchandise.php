<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Yardsale</title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
  <?php
    include 'functions/databaseConnect.php';

    if ($_SESSION['loggedIn'] == false) {
      $_SESSION['status'] = "failed";
      header("location: loginPage.php");
    }
  ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~~ -->
</head>

<body>
	<h3>Edit Items</h3>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div class="">
    <a href='/yardSale/homePageLogin.php'>Home</a>
    <a href="/yardSale/userPage.php">User Page</a>
    <a href='/yardSale/loginPage.php'>Logout</a>
  </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

  <hr>

<!-- ~~~~~~~~~~~~~~~~~~~~~ START: DISPLAY YS INFO ~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <?php
    $yardSaleID = $_SESSION['yardSaleID'];
    $display = true;

    if (!empty($_POST)) {
      $yardSaleID = $_POST['editYardSaleItems'];
    }

    $findYardSaleMatch = "SELECT * FROM YardSales
                          WHERE yardSaleID = '$yardSaleID'";

    $matchResult = $mysqli->query($findYardSaleMatch);

    if ($matchResult->num_rows > 0) {
      while ($row = $matchResult->fetch_assoc()) {
        echo "<h3>" . $row["yardSaleName"] . "</h3>" .
             "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
             "Host: " . $row["userID"] . "<br>" .
             "Address: " . $row["streetAddress"] . ", " . $row["city"] . " "
             . $row["state"] . " " . $row["zipCode"] .  "<br>" .
             "Date: " . $row["yardSaleDate"] . "<br>" .
             "Time: " . $row["yardSaleTime"] . "<br>" .
             "Description: " . $row["yardSaleDescription"] . "<br><br>";

        echo "<p><b>Edit Items Below</b></p>";
      }
    }

    else {
      $display = false;
      echo "Invalid Yardsale ID";
    }
   ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY YS INFO ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

  <div class="">
    <p>If you are done, or don't want to add anything navigate with the options above</p>
  </div>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~ START: DELETE FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div class="">
    <p>To delete an item enter its ID and press delete</p>
      <form class="" action="functions/deleteMerch.php" method="post">
        <label for="deleteItem"></label>
        <input type="text" name="deleteItem" id="deleteItem">
        <button type="submit" formmethod="post">Delete</button>
      </form>
  </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ END: DELETE FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: EDIT FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="">
      <p>To edit an item enter its ID and press edit</p>
      <form class="" action="functions/editMerch.php" method="post">
        <label for="editMerch"></label>
        <input type="text" name="editMerch" id="editMerch">
        <button type="submit" formmethod="post">Edit</button>
      </form>
    </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: EDIT FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ START: CREATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div>
    <!-- should call another file that will insert the item -->
		<form action="functions/insertMerch.php" method="post">
      <p><b>Add an Item</b></p>
			<label for="itemName">Name: </label>
			<input type="text" name="itemName" id="itemName" required>
      <br>

			<label for="itemPrice">Price: </label>
			<input type="number" name="itemPrice" id="itemPrice" required>
      <br>

      <p>Description</p>
			<textarea id="description" name="itemDescription" rows="10" cols="50"
                required></textarea>

			<br>
			<br>
			<button type="submit" formmethod="post" name="button">Create</button>
      <br>
		</form>
	</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ END: CREATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~~ -->

  <div class="">
    <?php
      if ($display == true) {
        // $yardSaleID = $_SESSION['yardSaleID'];

        $displayItems = "SELECT * FROM Merchandise
                         WHERE yardSaleID = '$yardSaleID'";

        $displayResult = $mysqli->query($displayItems);

        if ($displayResult->num_rows > 0) {
          while ($row = $displayResult->fetch_assoc()) {
            echo "<br><b> Merch ID: " . $row["merchID"] . "</b> <br>" .
                 "Name: " . $row["itemName"] . "<br>" .
                 "Price: $" . $row["price"] .  "<br>" .
                 "Sold: " . $row["sold"] . "<br>" .
                 "Description: " . $row["description"] . "<br>";
          }
        }

        else {
          echo "<br>";
          echo "There are no items";
        }
      }
     ?>
  </div>

</body>
</html>
