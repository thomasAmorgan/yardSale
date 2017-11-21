<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Yardsale</title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
  <?php
    if ($_SESSION['loggedIn'] == false) {
      $_SESSION['status'] = "failed";
      header("location: loginPage.php");
    }
  ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~~ -->

  <?php
    include 'functions/databaseConnect.php';

    $itemName = $_POST['itemName'];
    $itemPrice = (int) $_POST['itemPrice'];
    $itemDescription = $_POST['itemDescription'];

    $userID = $_SESSION['userName'];
    $yardSaleID = $_SESSION['yardSaleID'];

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~ START: GENERATE ID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    function generateID() {
      $randNumber = rand(0, 99999);
      return $randNumber;
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: GENERATE ID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~~~~~~~~~ START: CREATE YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~
    if (!empty($_POST)) {

      $randNum = generateID();
      $merchID = "$yardSaleID" . "i#" . "$randNum";

      $createYardSaleQuery = "INSERT INTO Merchandise (merchID, itemName,
                              description, price, userID, yardSaleID)
                              VALUES ('$merchID', '$itemName', '$itemDescription',
                              '$itemPrice', '$userID', '$yardSaleID')";

      $createYardSaleResult = $mysqli->query($createYardSaleQuery);

      header("Location: /yardSale/addMerchandise.php");
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~ END: CREATE YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~
  ?>
</head>

<body>
	<h3>Add Items</h3>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div class="">
    <a href='/yardSale/homePageLogin.php'>Home</a>
    <a href="/yardSale/userPage.php">User Page</a>
    <a href='/yardSale/loginPage.php'>Logout</a>
  </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

  <hr>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ START: CREATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div>
    <!-- should call another file that will insert the item -->
		<form action="" method="post">
      <p><b>Item Name</b></p>
			<label for="itemName">Name: </label>
			<input type="text" name="itemName" id="itemName" required>
      <br>

      <p><b>Price</b></p>
			<label for="itemPrice">Price: </label>
			<input type="text" name="itemPrice" id="itemPrice" required>
      <br>

			<!-- <label for="description">Description: </label> -->
      <p><b>Description</b></p>
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
      $displayItems = "SELECT * FROM Merchandise
                       WHERE yardSaleID = '$yardSaleID'";

      $displayResult = $mysqli->query($displayItems);

      if ($displayResult->num_rows > 0) {
        while ($row = $displayResult->fetch_assoc()) {
          echo "<h3>Items for: " . $row["yardSaleName"] . "</h3>" .
               "<b> Merch ID: " . $row["merchID"] . "</b> <br>" .
               "Name: " . $row["itemName"] . "<br>" .
               "Price: $" . $row["itemPrice"] .  "<br>" .
               "Description: " . $row["itemDescription"] . "<br>";
        }
      }

      else {
        echo "There are no items";
      }
     ?>
  </div>

</body>
</html>
