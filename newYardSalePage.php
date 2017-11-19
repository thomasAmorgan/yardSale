<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Yardsale</title>

  <?php
    include 'functions/databaseConnect.php';
    // include 'functions/generateYardSaleID.php';

    if ($_SESSION['loggedIn'] == false) {
      $_SESSION['status'] = "failed";
      header("location: loginPage.php");
    }

    $yardSaleName = $_POST['yardSaleName'];
    $yardSaleAddress = $_POST['yardSaleAddress'];
    $yardSaleMonth = $_POST['yardSaleMonth'];
    $yardSaleDay = $_POST['yardSaleDay'];
    $yardSaleYear = $_POST['yardSaleYear'];
    $yardSaleTime = "04:20pm";
    $yardSaleDescription = $_POST['yardSaleDescription'];
    $userID = $_SESSION['userName'];
    $yardSaleID;
    $idOK = false;

    $yardSaleDate = "$yardSaleMonth" . "$yardSaleDay" . "$yardSaleYear";

    function generateID() {
      $randNumber = rand(0, 99999);
      return $randNumber;
    }

    // function checkID() {
    //   $yardSaleID = generateID();
    //
    //   while (!$idOK) {
    //     $checkYardSaleID =  "SELECT yardSaleID
    //                          FROM YardSales
    //                          WHERE yardSaleID = '$yardSaleID'";
    //
    //     $result = $mysqli->query($checkYardSaleID);
    //
    //     if($result->num_rows === 1) {
    //       $yardSaleID = generateID();
    //     }
    //
    //     else {
    //       $idOK = true;
    //       return $yardSaleID;
    //     }
    //   }
    // }

    if (!empty($_POST)) {

      $randNum = generateID();
      $yardSaleID = "$userID" . "$randNum";
      // $yardSaleID = checkID();

      $createYardSaleQuery = "INSERT INTO YardSales (yardSaleID, userID, yardSaledate,
                                yardSaleTime, address, yardSaleName, yardSaleDescription)
                                VALUES ('$yardSaleID', '$userID', '$yardSaleDate',
                                '$yardSaleTime', '$yardSaleAddress', '$yardSaleName',
                                '$yardSaleDescription')";

        // echo "$createYardSaleQuery";

        $createYardSaleResult = $mysqli->query($createYardSaleQuery);

        $checkQuery = "SELECT *
  										 FROM YardSales
  										 WHERE yardSaleID = '$yardSaleID'
  										 AND userID = '$userID'";

        $checkQueryResult = $mysqli->query($checkQuery);

        if ($checkQueryResult->num_rows > 0) {

          while ($row = $checkQueryResult->fetch_assoc()) {
            echo "<br> <h3>" . $row["yardSaleName"] . "</h3>"
            ;
          }
        }

          header("Location: /yardSale/homePageLogin.php");
          exit;
    }
  ?>

</head>

<body>

	<h3>Create a Yardsale</h3>

	<div>
		<form action="" method="post">
			<label for="yardSaleName">Yardsale Name: </label>
			<input type="text" name="yardSaleName" id="yardSaleName" required>
			<br>
			<label for="yardSaleAddress">Yardsale Address: </label>
			<input type="text" name="yardSaleAddress" id="yardSaleAddress" required>
			<br>
			<br>

			Date of Yardsale
			<br>
			<label for="months">Month: </label>
			<select id="months" name="yardSaleMonth"> </select>
			<label for="days">Day: </label>
			<select id="days" name="yardSaleDay"> </select>
			<label for="years">Year: </label>
			<select id="years" name="yardSaleYear"> </select>

			<br>
			<label for="description">Description: </label>
			<textarea id="description" name="yardSaleDescription"></textarea>


			<br>
			<br>
			<button type="submit" formmethod="post" name="button">Create</button>
		</form>

		<hr>
    <a href='/yardSale/homePageLogin.php'>Home</a>
		<a href='/yardSale/loginPage.php'>Logout</a>
	</div>

</body>

</html>

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
	}
</script>
