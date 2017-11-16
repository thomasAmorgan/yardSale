<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Yardsale</title>

  <?php


    if ($_SESSION['loggedIn'] == false) {
      $_SESSION['status'] = "failed";
      header("location: loginPage.php");
    }

    //$Host = '128.163.141.169';
    $host = 'localhost';
    $username = 'root';
    $password = 'Muffin380!'; //enter password
    $database = 'yardSaleDatabase'; //Enter database name
    $mysqli = new mysqli($host, $username, $password, $database);

    $yardSaleName = $_POST['yardSaleName'];
    $yardSaleAddress = $_POST['yardSaleAddress'];
    $yardSaleMonth = $_POST['yardSaleMonth'];
    $yardSaleDay = $_POST['yardSaleDay'];
    $yardSaleYear = $_POST['yardSaleYear'];
    $yardSaleDescription = $_POST['yardSaleDescription'];
    $userID = $_SESSION['userName'];
    $yardSaleID;
    $idOK = false;

    $yardSaleDate = "$yardSaleMonth" . "$yardSaleDay" . "$yardSaleYear";

    function generateID() {
      $randNumber = rand(0, 999999);
      return $randNumber;
    }

    function checkID() {
      $yardSaleID = generateID();

      echo "before while \n";
      while (!$idOK) {
        echo "in while \n";
        $checkYardSaleID =  "SELECT yardSaleID
                             FROM YardSales
                             WHERE yardSaleID = '$yardSaleID'";
        echo "after string \n";

        // if (!$queryResult  = $mysqli->query($checkYardSaleID)) {
        //   echo "Query failed, loser." . $mysqli->error . "\n";
        //   exit;
        // }
        //
        // else if($queryResult->num_rows === 1) {
        //   echo "id exists \n";
        //   $yardSaleID = generateID();
        // }
        //
        // else {
        //   echo "it worked \n";
          $idOK = true;
        // }
      }
      echo "while finished \n";
    }

    if (!empty($_POST)) {

      if ($mysqli->connect_errno) {
              echo "Could not connect to database \n";
              echo "Error: ". $mysqli->connect_error . "\n";
              exit;
      }

      else {
        checkID();

        $createYardSaleQuery = "INSERT INTO YardSales (yardSaleID, userID, dateTime,
                                address, yardSaleName, yardSaleDescription)
                                VALUES ('ys1234', '$userID', '$yardSaleDate',
                                '$yardSaleAddress', '$yardSaleName', '$yardSaleDescription')";

        if (!$queryResult  = $mysqli->query($createYardSaleQuery)) {
          echo "Query failed, loser." . $mysqli->error . "\n";
          exit;
        }

        else {
          // echo "<a href='/yardSale/homePageLogin.php'>Home</a>";
          // header("Location: /yardSale/homePageLogin.php");
          exit;
        }
      }
    }
  ?>

</head>

<body>

	<h1>Create a Yardsale</h1>

	<div>
		<form action="<?php echo $PHP_SELF;?>" method="post">
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
		<a href='/yardSale/loginPage.php'>Logout</a>
		<a href='/yardSale/homePageLogin.php'>Home</a>
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
