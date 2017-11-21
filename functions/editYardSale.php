<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~ START: CHECK IF LOGGED IN ~~~~~~~~~~~~~~~~~~~~~~ -->
    <?php
      // include 'databaseConnect.php';

      if ($_SESSION['loggedIn'] == false) {
        $_SESSION['status'] = "failed";
        header("location: loginPage.php");
      }

      $userName = $_SESSION['userName'];
      $yardSaleID = $_POST['editYardSale'];
      echo "$yardSaleID";

      $userID;
      $yardSaleDate;
      $yardSaleTime;
      $streetAddress;
      $yardSaleName;
      $yardSaleDescription;
      $state;
      $zipCode;
      $city;
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
        include 'databaseConnect.php';
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

          // 01/01/2017
          $month = substr($yardSaleDate, 0, 2);
          $day = substr($yardSaleDate,2, 2);
          $year = substr($yardSaleDate,5 , 4);

          echo "$month" . " " . "$day" . " " . "$year";

          echo "	<div>
          		<form action='' method='post'>
                <p><b>Yardsale Name</b></p>
          			<label for='yardSaleName'>Name: </label>
          			<input type='text' name='yardSaleName' id='yardSaleName'
                 value='$yardSaleName' required>
                <br>

                <p><b>Yardsale Address</b></p>
          			<label for='yardSaleStreet'>Street: </label>
          			<input type='text' name='yardSaleStreet' id='yardSaleStreet'
                 value='$streetAddress' required>
                <br>
          			<label for='yardSaleCity'>City: </label>
          			<input type='text' name='yardSaleCity' id='yardSaleCity'
                 value='$city' required>
          			<label for='yardSaleState'>State: </label>
          			<select id='states' name='yardSaleState'> </select>
                <br>
                <label for='yardSaleZip'>Zip Code: </label>
          			<input type='text' name='yardSaleZip' id='yardSaleZip'
                 value='$zipCode' required>
          			<br>

                <p><b>Date of Yardsale</b></p>
          			<label for='months'>Month: </label>
          			<select id='months' name='yardSaleMonth' value='$'> </select>
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
          			<textarea id='description' name='yardSaleDescription' rows='10' cols='50' value='$yardSaleDescription' required></textarea>

          			<br>
          			<br>
          			<button type='submit' formmethod='post' name='button'>Create</button>
          		</form>
          	</div>";
        }
       ?>
    </div>

    <?php echo "<script>
    	window.onload = function() {
    		var monthArray = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

    		var months = document.getElementById('months');

    		for (var i = 0; i < monthArray.length; i++) {
    			var opt = document.createElement('option');
    			opt.value = monthArray[i];
    			opt.innerHTML = monthArray[i];
    			months.appendChild(opt);
    		}

    		var days = document.getElementById('days');

    		for (var i = 1; i <= 31; i++) {
                            var opt = document.createElement('option');
                            opt.value = i;
                            opt.innerHTML = i;
                            days.appendChild(opt);
        }

    		var year = document.getElementById('years');

    		for (var i = 2017; i <= 2025; i++) {
                            var opt = document.createElement('option');
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

    		var states = document.getElementById('states');

        for (var i = 0; i < statesArray.length; i++) {
    			var opt = document.createElement('option');
    			opt.value = statesArray[i];
    			opt.innerHTML = statesArray[i];
    			states.appendChild(opt);
    		}

        var hoursArray = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        var mornAfterArray = ['AM', 'PM'];

        var hours = document.getElementById('hours');
        var amPM = document.getElementById('ampm');

        for (var i = 0; i < hoursArray.length; i++) {
    			var opt = document.createElement('option');
    			opt.value = hoursArray[i];
    			opt.innerHTML = hoursArray[i];
    			hours.appendChild(opt);
    		}

        for (var i = 0; i < mornAfterArray.length; i++) {
    			var opt = document.createElement('option');
    			opt.value = mornAfterArray[i];
    			opt.innerHTML = mornAfterArray[i];
    			amPM.appendChild(opt);
    		}
    	}
    </script>"; ?>


  </body>
</html>