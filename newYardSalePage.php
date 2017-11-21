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

    $yardSaleName = $_POST['yardSaleName'];

    $yardSaleStreet = $_POST['yardSaleStreet'];
    $yardSaleCity = $_POST['yardSaleCity'];
    $yardSaleState = $_POST['yardSaleState'];
    $yardSaleZip = $_POST['yardSaleZip'];

    $yardSaleMonth = $_POST['yardSaleMonth'];
    $yardSaleDay = $_POST['yardSaleDay'];
    $yardSaleYear = $_POST['yardSaleYear'];

    $yardSaleHour = $_POST['yardSaleHour'];
    $yardSaleAMPM = $_POST['yardSaleAMPM'];

    $yardSaleDescription = $_POST['yardSaleDescription'];

    $userID = $_SESSION['userName'];
    $yardSaleID;

    $yardSaleDate = "$yardSaleMonth" . '/' . "$yardSaleDay" . '/' . "$yardSaleYear";
    $yardSaleTime = "$yardSaleHour" . "$yardSaleAMPM";

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~ START: GENERATE ID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    function generateID() {
      $randNumber = rand(0, 99999);
      return $randNumber;
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: GENERATE ID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~~~~~~~~~ START: CREATE YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~
    if (!empty($_POST)) {

      $randNum = generateID();
      $yardSaleID = "$userID" . "$randNum";
      // $yardSaleID = checkID();

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
	<h3>Create a Yardsale</h3>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ START: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div class="">
    <a href='/yardSale/homePageLogin.php'>Home</a>
    <a href='/yardSale/loginPage.php'>Logout</a>
  </div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~ END: NAVBAR ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

  <hr>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~ START: CREATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div>
		<form action="" method="post">
      <p><b>Yardsale Name</b></p>
			<label for="yardSaleName">Name: </label>
			<input type="text" name="yardSaleName" id="yardSaleName" required>
      <br>

      <p><b>Yardsale Address</b></p>
			<label for="yardSaleStreet">Street: </label>
			<input type="text" name="yardSaleStreet" id="yardSaleStreet" required>
      <br>
			<label for="yardSaleCity">City: </label>
			<input type="text" name="yardSaleCity" id="yardSaleCity" required>
			<label for="yardSaleState">State: </label>
			<select id="states" name="yardSaleState"> </select>
      <br>
      <label for="yardSaleZip">Zip Code: </label>
			<input type="text" name="yardSaleZip" id="yardSaleZip" required>
			<br>

      <p><b>Date of Yardsale</b></p>
			<label for="months">Month: </label>
			<select id="months" name="yardSaleMonth"> </select>
			<label for="days">Day: </label>
			<select id="days" name="yardSaleDay"> </select>
			<label for="years">Year: </label>
			<select id="years" name="yardSaleYear"> </select>
      <br>
      <label for="yardSaleHour">Time: </label>
			<select id="hours" name="yardSaleHour"> </select>
			<select id="ampm" name="yardSaleAMPM"> </select>

      <br>
			<!-- <label for="description">Description: </label> -->
      <p><b>Description</b></p>
			<textarea id="description" name="yardSaleDescription" rows="10" cols="50" required></textarea>

			<br>
			<br>
			<button type="submit" formmethod="post" name="button">Create</button>
		</form>
	</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~ END: CREATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~~ -->
</body>
</html>

<!-- ~~~~~~~~~~~~~~~~~~~ START: DROPDOWN POP FUNCTIONS ~~~~~~~~~~~~~~~~~~~~~ -->
<script>
	window.onload = function() {
		var monthArray = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

		var months = document.getElementById("months");

		for (var i = 0; i < monthArray.length; i++) {
			var opt = document.createElement("option");
			opt.value = monthArray[i];
			opt.innerHTML = monthArray[i];
			months.appendChild(opt);
		}

		var days = document.getElementById("days");

		for (var i = 1; i <= 31; i++) {
                        var opt = document.createElement("option");
                        if (i < 10) {
                          i = "0" + "i";
                        }
                        opt.value = i;
                        opt.innerHTML = i;
                        days.appendChild(opt);
    }

		var year = document.getElementById("years");

		for (var i = 2017; i <= 2025; i++) {
                        var opt = document.createElement("option");
                        opt.value = i;
                        opt.innerHTML = i;
                        years.appendChild(opt);
    }

    var statesArray = ['AK', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DE', 'FL',
                       'GA', 'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA',
                       'MA', 'MD', 'ME', 'MI', 'MN', 'MO', 'MS', 'MT', 'NC',
                       'ND', 'NE', 'NH', 'NJ', 'NM', 'NV', 'NY', 'OH', 'OK',
                       'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VA',
                       'VT', 'WA', 'WI', 'WV', 'WY'];

		var states = document.getElementById("states");

    for (var i = 0; i < statesArray.length; i++) {
			var opt = document.createElement("option");
			opt.value = statesArray[i];
			opt.innerHTML = statesArray[i];
			states.appendChild(opt);
		}

    var hoursArray = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    var mornAfterArray = ['AM', 'PM'];

    var hours = document.getElementById("hours");
    var amPM = document.getElementById("ampm");

    for (var i = 0; i < hoursArray.length; i++) {
			var opt = document.createElement("option");
			opt.value = hoursArray[i];
			opt.innerHTML = hoursArray[i];
			hours.appendChild(opt);
		}

    for (var i = 0; i < mornAfterArray.length; i++) {
			var opt = document.createElement("option");
			opt.value = mornAfterArray[i];
			opt.innerHTML = mornAfterArray[i];
			amPM.appendChild(opt);
		}
	}
</script>
<!-- ~~~~~~~~~~~~~~~~~~~~ END: DROPDOWN POP FUNCTIONS ~~~~~~~~~~~~~~~~~~~~~~ -->
