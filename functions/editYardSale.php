<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
    <?php
      if ($_SESSION['loggedIn'] == false) {
        $_SESSION['status'] = "failed";
        header("location: loginPage.php");
      }

      $userName = $_SESSION['userName'];
      $yardSaleID = $_POST['editYardSale'];

      $userID;
      $yardSaleDate;
      $yardSaleTime;
      $streetAddress;
      $yardSaleName;
      $yardSaleDescription;
      $state;
      $zipCode;
      $city;
      $
    ?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ END: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~~ -->
  </head>

  <body>
    <h3>Edit Yardsale</h3>

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
        if (!empty($_POST['editYardSale'])) {
          $findYardSaleMatch = "SELECT * FROM YardSales
                                WHERE yardSaleID = '$yardSaleID'";

          $matchResult = $mysqli->query($findYardSaleMatch);

          if ($matchResult->num_rows > 0) {
            while ($row = $matchResult->fetch_assoc()) {
              $userID = $row['userID'];
              $yardSaleDate = $row['yardSaleDate'];
              $yardSaleTime = $row['yardSaleTime'];
              $streetAddress = $row['streetAddress'];
              $yardSaleName = $row['yardSaleName'];
              $yardSaleDescription = $row['yardSaleDescription'];
              $state = $row['state'];
              $zipCode = $row['zipCode'];
              $city = $row['city'];
            }
          }

          echo "	<div>
          		<form action='' method='post'>
                <p><b>Yardsale Name</b></p>
          			<label for='yardSaleName'>Name: </label>
          			<input type='text' name='yardSaleName' id='yardSaleName' required>
                <br>

                <p><b>Yardsale Address</b></p>
          			<label for='yardSaleStreet'>Street: </label>
          			<input type='text' name='yardSaleStreet' id='yardSaleStreet' required>
                <br>
          			<label for='yardSaleCity'>City: </label>
          			<input type='text' name='yardSaleCity' id='yardSaleCity' required>
          			<label for='yardSaleState'>State: </label>
          			<select id='states' name='yardSaleState'> </select>
                <br>
                <label for='yardSaleZip'>Zip Code: </label>
          			<input type='text' name='yardSaleZip' id='yardSaleZip' required>
          			<br>

                <p><b>Date of Yardsale</b></p>
          			<label for='months'>Month: </label>
          			<select id='months' name='yardSaleMonth'> </select>
          			<label for='days'>Day: </label>
          			<select id='days' name='yardSaleDay'> </select>
          			<label for='years'>Year: </label>
          			<select id='years' name='yardSaleYear'> </select>
                <br>
                <label for='yardSaleHour'>Time: </label>
          			<select id='hours' name='yardSaleHour'> </select>
          			<select id='ampm' name='yardSaleAMPM'> </select>

                <br>
          			<!-- <label for='description'>Description: </label> -->
                <p><b>Description</b></p>
          			<textarea id='description' name='yardSaleDescription' rows='10' cols='50' required></textarea>

          			<br>
          			<br>
          			<button type='submit' formmethod='post' name='button'>Create</button>
          		</form>
          	</div>";
        }
       ?>
    </div>


  </body>
</html>
