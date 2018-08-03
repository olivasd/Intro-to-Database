<!DOCTYPE html>
<html>
	<head>
		<title>Menu</title>
		<link rel="stylesheet" href="/css/style.css">
	</head>
	<body>
		<?php
		$diet = '';
		function diet($today, $diet_id, $day) {
			ini_set('display_errors', 'on');
			$mysqli = new mysqli("db738474819.db.1and1.com", "dbo738474819", "Enchilada#1", "db738474819");
			if ($mysqli->connect_errno){
				echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!($stmt = $mysqli->prepare("SELECT m.main_name, s.starch_name, f.fruit_name, d1.drink_name, d2.drink_name, d.diet_name
			FROM breakfast AS b 
			JOIN main_breakfast AS m ON b.main_id = m.main_id
			JOIN starch_breakfast AS s ON b.starch_id = s.starch_id
			JOIN fruit AS f ON b.fruit_id = f.fruit_id
			JOIN drink AS d1 ON b.drink_1 = d1.drink_id
			JOIN drink AS d2 ON b.drink_2 = d2.drink_id
			JOIN diet AS d ON b.diet_id = d.diet_id
			WHERE b.day_id = $today AND b.diet_id = $diet_id"))){
				echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
			}
			if(!($stmt->execute())){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!($stmt->bind_result($main, $starch, $fruit, $drink1, $drink2, $diet))){
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			$stmt->fetch();
			echo "<div><h2>$day</h2></div><div style=\"width: 100%;\">";
			echo "<div style=\"float: left; width: 33%;\"><div><h2>Breakfast</h2></div>$main<br>$starch<br>$fruit<br>$drink1<br>$drink2</div>";

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
			
			echo "<div style=\"float: left; width: 33%;\"><h2>Lunch</h2>$main<br>$starch<br>$vegetable<br>$fruit<br>$drink</div>";

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
			
			echo "<div style=\"float: left; width: 33%;\"><h2>Dinner</h2>$main <br>$starch<br>$vegetable<br>$dessert<br>$drink1<br>$drink2</div><br style=\"clear: left;\" /></div>";

			$stmt->close();
		}
		ini_set('display_errors', 'on');
		$mysqli = new mysqli("db738474819.db.1and1.com", "dbo738474819", "Enchilada#1", "db738474819");
		if ($mysqli->connect_errno){
			echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!($stmt = $mysqli->prepare("SELECT diet_name FROM diet WHERE diet_id = " . $_POST['diet_id']))){
				echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
			}
			if(!($stmt->execute())){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!($stmt->bind_result($diet))){
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			$stmt->fetch();
		echo "<div><h1>$diet Diet</h1></div>";
		diet(1, $_POST['diet_id'], "Monday");
		diet(2, $_POST['diet_id'], "Tuesday");
		diet(3, $_POST['diet_id'], "Wednesday");
		diet(4, $_POST['diet_id'], "Thursday");
		diet(5, $_POST['diet_id'], "Friday");
		?>
		<p><form action="menu.php">
				<button type="submit">Back</button><br>		
			</form></p>
		<p><form action="/">
				<button type="submit">Home Page</button><br>		
			</form></p>
	</body>
</html>