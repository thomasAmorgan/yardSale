<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Register</title>

  <script type="text/javascript">
    function accountExist() {
      alert("Account already exist, please login.");
    }
    function registerSuccess() {
      alert("You successfully registered!");
    }
  </script>

  <?php
    include 'functions/databaseConnect.php';

    $newUserID = $_POST["newUserName"];
    $newUserPassword = $_POST["newUserPassword"];

    $newUserFirstName = $_POST['newUserFirstName'];
    $newUserLastName = $_POST['newUserLastName'];
    $newUserPhone = $_POST['newUserPhone'];
    $newUserStreet = $_POST['newUserStreet'];
    $newUserCity = $_POST['newUserCity'];
    $newUserState = $_POST['newUserState'];
    $newUserZip = $_POST['newUserZip'];

    if (!empty($_POST)) {

      $checkQuery = "SELECT userID
                     FROM logins
                     WHERE userID = '$newUserID'";

      $result = $mysqli->query($checkQuery);

      if ($result->num_rows === 1) {
        echo "<script> accountExist(); </script>";
      }

      else {
    		$registerQuery = "INSERT INTO logins (userID, password)
    					            VALUES ('$newUserID', '$newUserPassword')
                         ";

        $addUser = $mysqli->query($registerQuery);

        $insertUserInfo = "INSERT INTO UserProfiles
                           VALUES ('$newUserID', '$newUserFirstName',
                           '$newUserLastName', '$newUserStreet', '$newUserZip',
                           '$newUserState', '$newUserCity', '$newUserPhone', 0)";

        header("Location: /yardSale/loginPage.php");
      }
    }
  ?>
</head>

<body>

  <h3>Register</h3>

  <div class="">
    <a href='/yardSale/homePageOpen.php'>Home</a>
    <a href="loginPage.php">Login</a>
  </div>

  <hr>

  <div class="">
    <p>After successfully registering, you will be taken to the login page.</p>

    <form action="" method="post">
      <label for="userName">Username: </label>
      <input type="text" name="newUserName" id="newUserName" required>
      <br>
      <label for="newUserPassword">Password: </label>
      <input type="password" name="newUserPassword" id="newUserPassword" required>
      <br>
      <br>

      <p><b>Name</b></p>
      <label for="userName">First Name: </label>
      <input type="text" name="newUserFirstName" id="newUserFirstName" required>
      <br>
      <label for="userName">Last Name: </label>
      <input type="text" name="newUserLastName" id="newUserLastName" required>
      <br>
      <br>

      <label for="newUserPhone">Phone: </label>
      <input type="text" name="newUserPhone" id="newUserPhone" required>
      <br>
      <br>

      <p><b>Address</b></p>
			<label for="newUserStreet">Street: </label>
			<input type="text" name="newUserStreet" id="newUserStreet" required>
      <br>
			<label for="newUserCity">City: </label>
			<input type="text" name="newUserCity" id="newUserCity" required>
			<label for="yardSaleState">State: </label>
			<select id="states" name="newUserState"> </select>
      <br>
      <label for="newUserZip">Zip Code: </label>
			<input type="text" name="newUserZip" id="newUserZip" required>
      <br>
      <br>

      <button type="submit" formmethod="post">Register</button>
    </form>
  </div>

</body>
</html>

<script type="text/javascript">
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
</script>
