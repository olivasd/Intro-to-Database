<!DOCTYPE html>
<html>
	<head>
		<title>Patient</title>
		<link rel="stylesheet" href="/css/style.css">
	</head>
	<body>

		<?php

		function connection(){
			ini_set('display_errors', 'on');
			$mysqli = new mysqli("db738474819.db.1and1.com", "dbo738474819", "Enchilada#1", "db738474819");
			if ($mysqli->connect_errno){
				echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			return $mysqli;
		}

		function getDay(){
			$mysqli = connection();
			if(!($stmt = $mysqli->prepare("SELECT WEEKDAY(NOW()) + 1"))){
				echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
			}
			if(!($stmt->execute())){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!($stmt->bind_result($today))){
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			$stmt->fetch();
			$stmt->close();
			return $today;
		}

		$diet_id = '';
		$today = getDay();
		
		$mysqli = connection();
		if(!($stmt = $mysqli->prepare("SELECT first_name, last_name, diet_id FROM patient WHERE patient_id = "  . $_POST["pid"]))){
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute())){
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($first_name, $last_name, $diet_id))){
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		
		echo "<h1>" . $first_name . " " . $last_name . "</h1>";

		$stmt->close();

		if(!($stmt = $mysqli->prepare("SELECT m.main_name, s.starch_name, f.fruit_name, d1.drink_name, d2.drink_name
				FROM breakfast AS b 
				JOIN main_breakfast AS m ON b.main_id = m.main_id
				JOIN starch_breakfast AS s ON b.starch_id = s.starch_id
				JOIN fruit AS f ON b.fruit_id = f.fruit_id
				JOIN drink AS d1 ON b.drink_1 = d1.drink_id
				JOIN drink AS d2 ON b.drink_2 = d2.drink_id
				WHERE b.day_id = $today AND b.diet_id = $diet_id"))){
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute())){
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($main, $starch, $fruit, $drink1, $drink2))){
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		echo "<div style=\"width: 100%;\">";
		echo "<div style=\"float: left; width: 33%;\"><h2>Today's Breakfast</h2>$main<br>$starch<br>$fruit<br>$drink1<br>$drink2</div>";

		$stmt->close();

		if(!($stmt = $mysqli->prepare("SELECT m.main_name, s.starch_name, v.vegetable_name, f.fruit_name, d.drink_name
				FROM lunch AS l
				JOIN main_course AS m ON l.main_id = m.main_id
				JOIN starch AS s ON l.starch_id = s.starch_id
				JOIN vegetable AS v ON l.vegetable_id = v.vegetable_id
				JOIN fruit AS f ON l.fruit_id = f.fruit_id
				JOIN drink AS d ON l.drink_id = d.drink_id
				WHERE l.day_id = " . $today . " AND l.diet_id = " . $diet_id))){
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute())){
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($main, $starch, $vegetable, $fruit, $drink))){
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		
		echo "<div style=\"float: left; width: 33%;\"><h2>Today's Lunch</h2>$main<br>$starch<br>$vegetable<br>$fruit<br>$drink</div>";

		$stmt->close();

		if(!($stmt = $mysqli->prepare("SELECT m.main_name, s.starch_name, v.vegetable_name, de.dessert_name, d1.drink_name, d2.drink_name
				FROM dinner AS d
				JOIN main_course AS m ON d.main_id = m.main_id
				JOIN starch AS s ON d.starch_id = s.starch_id
				JOIN vegetable AS v ON d.vegetable_id = v.vegetable_id
				JOIN dessert AS de ON d.dessert_id = de.dessert_id
				JOIN drink AS d1 ON d.drink_1 = d1.drink_id
				JOIN drink AS d2 ON d.drink_2 = d2.drink_id
				WHERE d.day_id = " . $today . " AND d.diet_id = " . $diet_id))){
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute())){
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($main, $starch, $vegetable, $dessert, $drink1, $drink2))){
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		
		echo "<div style=\"float: left; width: 33%;\"><h2>Today's Lunch</h2>$main <br>$starch<br>$vegetable<br>$dessert<br>$drink1<br>$drink2</div><br style=\"clear: left;\" /></div>";

		$stmt->close();

		if(!($stmt = $mysqli->prepare("SELECT m.main_name, s.starch_name, f.fruit_name, d1.drink_name, d2.drink_name
				FROM breakfast AS b 
				JOIN main_breakfast AS m ON b.main_id = m.main_id
				JOIN starch_breakfast AS s ON b.starch_id = s.starch_id
				JOIN fruit AS f ON b.fruit_id = f.fruit_id
				JOIN drink AS d1 ON b.drink_1 = d1.drink_id
				JOIN drink AS d2 ON b.drink_2 = d2.drink_id
				WHERE b.day_id = " . ($today + 1) . " AND b.diet_id = " . $diet_id))){
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute())){
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($main, $starch, $fruit, $drink1, $drink2))){
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		echo "<div style=\"width: 100%;\">";
		echo "<div style=\"float: left; width: 33%;\"><h2>Tomorrow's Breakfast</h2>$main<br>$starch<br>$fruit<br>$drink1<br>$drink2</div>";

		$stmt->close();

		if(!($stmt = $mysqli->prepare("SELECT m.main_name, s.starch_name, v.vegetable_name, f.fruit_name, d.drink_name
				FROM lunch AS l
				JOIN main_course AS m ON l.main_id = m.main_id
				JOIN starch AS s ON l.starch_id = s.starch_id
				JOIN vegetable AS v ON l.vegetable_id = v.vegetable_id
				JOIN fruit AS f ON l.fruit_id = f.fruit_id
				JOIN drink AS d ON l.drink_id = d.drink_id
				WHERE l.day_id = " . ($today + 1) . " AND l.diet_id = " . $diet_id))){
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute())){
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($main, $starch, $vegetable, $fruit, $drink))){
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		
		echo "<div style=\"float: left; width: 33%;\"><h2>Tomorrow's Lunch</h2>$main<br>$starch<br>$vegetable<br>$fruit<br>$drink</div>";

		$stmt->close();

		if(!($stmt = $mysqli->prepare("SELECT m.main_name, s.starch_name, v.vegetable_name, de.dessert_name, d1.drink_name, d2.drink_name
				FROM dinner AS d
				JOIN main_course AS m ON d.main_id = m.main_id
				JOIN starch AS s ON d.starch_id = s.starch_id
				JOIN vegetable AS v ON d.vegetable_id = v.vegetable_id
				JOIN dessert AS de ON d.dessert_id = de.dessert_id
				JOIN drink AS d1 ON d.drink_1 = d1.drink_id
				JOIN drink AS d2 ON d.drink_2 = d2.drink_id
				WHERE d.day_id = " . ($today + 1) . " AND d.diet_id = " . $diet_id))){
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute())){
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($main, $starch, $vegetable, $dessert, $drink1, $drink2))){
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		
		echo "<div style=\"float: left; width: 33%;\"><h2>Tomorrow's Dinner</h2>$main <br>$starch<br>$vegetable<br>$dessert<br>$drink1<br>$drink2</div><br style=\"clear: left;\" /></div>";

		$stmt->close();
		
		if(!($stmt = $mysqli->prepare("SELECT p.first_name, p.last_name, p.room_number, d.diet_name, p.diet_id 
			FROM patient p JOIN diet AS d ON p.diet_id = d.diet_id 
			WHERE p.patient_id = " . $_POST["pid"])))
		{
			echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
		}
		if(!($stmt->execute()))
		{
			echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt->bind_result($first_name, $last_name, $room_number, $diet, $diet_id)))
		{
			echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		$stmt->fetch();
		echo "<form method=\"post\" action=\"edited.php\">
		<fieldset>
		<legend><h2>Edit Patient</h2></legend>
		<input type=\"hidden\" name=\"pid\" value=\"" . $_POST["pid"] ."\">
		<p>Room Number: <input type=\"text\" name=\"room_number\" value=\"" . $room_number . "\"/></p>" . 
		"<p>Diet: <select name=\"diet_id\">
		<option value=\"" . $diet_id . "\">" . $diet . "</option> 	
		<option value=\"1\">NPO</option> 
		<option value=\"2\">Regular</option>
		<option value=\"3\">Diabetic</option>
		<option value=\"4\">Cardiac</option>
		<option value=\"5\">Pediatric</option>
		</select></p>
		<input type=\"submit\" value=\"Submit Changes\">
		</fieldset>
		</form>
		<form action=\"discharged.php\" method=\"post\"><p><button type=\"submit\" name=\"pid\" value=\"". $_POST["pid"] . "\">Discharge Patient</button></p></form>";
		?>	
		<p><form action="/">
				<button type="submit">Home Page</button><br>		
			</form></p>
	</body>
</html>