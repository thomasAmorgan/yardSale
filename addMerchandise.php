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
    $itemPrice = $_POST['itemPrice'];
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
      $yardSaleID = "$yardSaleID" . "i#" . "$randNum";

      $createYardSaleQuery = "INSERT INTO YardSales (yardSaleID, userID,
                              yardSaleDate, yardSaleTime, streetAddress,
                              yardSaleName, yardSaleDescription, state,
                              zipCode, city)
                              VALUES ('$yardSaleID', '$userID', '$yardSaleDate',
                              '$yardSaleTime', '$yardSaleStreet', '$yardSaleName',
                              '$yardSaleDescription', '$yardSaleState',
                              '$yardSaleZip', '$yardSaleCity')";

      $createYardSaleResult = $mysqli->query($createYardSaleQuery);

      header("Location: /yardSale/homePageLogin.php");
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
</body>
</html>
