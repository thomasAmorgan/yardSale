<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Yardsale</title>
</head>

<body>

	<h1>Create a Yardsale</h1>

	<div>
		<form action="functions/newYardSaleQuery.php" method="post">
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
	</div>

</body>

</html>

<script>
	window.onload = function() {
		var monthArray = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];

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
