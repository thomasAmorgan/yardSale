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
                required>
      </textarea>

			<br>
			<br>
			<button type="submit" formmethod="post" name="button">Create</button>
		</form>
	</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ END: CREATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~~ -->

  <div class="">
    <?php
      $yardSaleID = $_SESSION['yardSaleID'];

      $displayItems = "SELECT * FROM Merchandise
                       WHERE yardSaleID = '$yardSaleID'";

      $displayResult = $mysqli->query($displayItems);

      if ($displayResult->num_rows > 0) {
        while ($row = $displayResult->fetch_assoc()) {
          echo "<b> Merch ID: " . $row["merchID"] . "</b> <br>" .
               "Name: " . $row["itemName"] . "<br>" .
               "Price: $" . $row["price"] .  "<br>" .
               "Description: " . $row["description"] . "<br>";
        }
      }

      else {
        echo "There are no items";
      }
     ?>
  </div>

</body>
</html>
