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
      $_SESSION['yardSaleID'] = $yardSaleID;

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

//~~~~~~~~~~~~~~~~~~~~~~~~ START: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~
// also saves all the values from the yardsale being edited
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

              echo "<h3>" . $row["yardSaleName"] . "</h3>" .
                   "<b> Yardsale ID: " . $row["yardSaleID"] . "</b> <br>" .
                   "Host: " . $row["userID"] . "<br>" .
                   "Address: " . $row["streetAddress"] . ", " . $row["city"] . " "
                   . $row["state"] . " " . $row["zipCode"] .  "<br>" .
                   "Date: " . $row["yardSaleDate"] . "<br>" .
                   "Time: " . $row["yardSaleTime"] . "<br>" .
                   "Description: " . $row["yardSaleDescription"] . "<br><br>";

              echo "<p><b>Edit Info Below</b></p>";
            }
          }
          else {
            echo "Invalid Yardsale ID";
          }
//~~~~~~~~~~~~~~~~~~~~~~~~~ END: DISPLAY YS FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~~~~~~~~ START: SPLICE DATE & TIME ~~~~~~~~~~~~~~~~~~~~~~~~~~~
          // 01/01/2017
          $month = substr($yardSaleDate, 0, 2);
          $day = substr($yardSaleDate, 3, 2);
          $year = substr($yardSaleDate, 6, 4);

          // 01AM
          $hours = substr($yardSaleTime, 0, 2);
          $amPM = substr($yardSaleTime, 2, 2);
//~~~~~~~~~~~~~~~~~~~~~~~~~ END: SPLICE DATE & TIME ~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// ~~~~~~~~~~~~~~~~~~~~~~~~~ START: UPDATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          if ($userName == $userID) {
            echo "	<div>
                <form action='deleteUpdateYardSale.php' method='post'>
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
                  <select id='states' name='yardSaleState'>
                    <option selected>$state</option>
                  </select>
                  <br>
                  <label for='yardSaleZip'>Zip Code: </label>
                  <input type='text' name='yardSaleZip' id='yardSaleZip'
                   value='$zipCode' required>
                  <br>

                  <p><b>Date of Yardsale</b></p>
                  <label for='months'>Month: </label>
                  <select id='months' name='yardSaleMonth'>
                   <option selected>$month</option>
                  </select>
                  <label for='days'>Day: </label>
                  <select id='days' name='yardSaleDay' value='$day'>
                    <option selected>$day</option>
                  </select>
                  <label for='years'>Year: </label>
                  <select id='years' name='yardSaleYear' value='$year'>
                    <option selected>$year</option>
                  </select>
                  <br>
                  <label for='yardSaleHour'>Time: </label>
                  <select id='hours' name='yardSaleHour' value='$hours'>
                    <option selected>$hours</option>
                  </select>
                  <select id='ampm' name='yardSaleAMPM' value='$amPM'>
                    <option selected>$amPM</option>
                  </select>

                  <br>
                  <!-- <label for='description'>Description: </label> -->
                  <p><b>Description</b></p>
                  <textarea id='description' name='yardSaleDescription' rows='10' cols='50' required>$yardSaleDescription</textarea>

                  <br>
                  <br>
                  <button type='submit' formmethod='post' name='button'>Create</button>
                </form>
              </div>";
          }

          else {
            echo "<p><b>User ID does not match! You can only edit your own
                  yardsales.</b></p>";
          }

        }
// ~~~~~~~~~~~~~~~~~~~~~~~~~~ END: UPDATE YS FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
       ?>
    </div>
  </body>
</html>
