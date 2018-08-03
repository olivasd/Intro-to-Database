<!DOCTYPE html>
<html>
	<head>
		<title>Prep List</title>
		<link rel="stylesheet" href="/css/style.css">
	</head>
	<body style="background: white">
		<?php

			function connection_setup(){
				ini_set('display_errors', 'on');
				$mysqli = new mysqli("db738474819.db.1and1.com", "dbo738474819", "Enchilada#1", "db738474819");
				if ($mysqli->connect_errno){
					echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				return $mysqli;
			}

			function day_name($day_number){

				$mysqli = connection_setup();

				if(!($stmt = $mysqli->prepare("
					SELECT day_name FROM day
					WHERE day_id = $day_number			
				"))){
					echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
				}
				if(!($stmt->execute())){
					echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!($stmt->bind_result($day))){
					echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				$stmt->fetch();

				Echo "<div><h1>$day's Prep List</h1></div>";
			}

			function table_setup($meal){
				echo "<div style=\"float: left; width: 33%;\">
						<h2>$meal</h2>
						<table class=\"minimalistBlack\">
						<thead>
							<tr>
								<th>Item</th>
								<th>Quantity</th>
							</tr>
						</thead>";
			}

			function breakfast($day){
				table_setup('Breakfast');
				stuff('breakfast', 'main_breakfast', 'main_name', 'main_id', 'main_id', $day);
				stuff('breakfast', 'starch_breakfast', 'starch_name', 'starch_id', 'starch_id', $day);
				stuff('breakfast', 'cereal', 'cereal_name', 'cereal_id', 'cereal_id', $day);
				stuff('breakfast', 'fruit', 'fruit_name', 'fruit_id', 'fruit_id', $day);
				stuff('breakfast', 'drink', 'drink_name', 'drink_1', 'drink_id', $day);
				stuff('breakfast', 'drink', 'drink_name', 'drink_2', 'drink_id', $day);
				echo "</table></div>";
			}

			function lunch($day){
				table_setup('Lunch');
				stuff('lunch', 'main_course', 'main_name', 'main_id', 'main_id', $day);
				stuff('lunch', 'starch', 'starch_name', 'starch_id', 'starch_id', $day);
				stuff('lunch', 'vegetable', 'vegetable_name', 'vegetable_id', 'vegetable_id', $day);
				stuff('lunch', 'fruit', 'fruit_name', 'fruit_id', 'fruit_id', $day);
				stuff('lunch', 'drink', 'drink_name', 'drink_id', 'drink_id', $day);
				echo "</table></div>";
			}

			function dinner($day){
				table_setup('Dinner');
				stuff('dinner', 'main_course', 'main_name', 'main_id', 'main_id', $day);
				stuff('dinner', 'starch', 'starch_name', 'starch_id', 'starch_id', $day);
				stuff('dinner', 'vegetable', 'vegetable_name', 'vegetable_id', 'vegetable_id', $day);
				stuff('dinner', 'dessert', 'dessert_name', 'dessert_id', 'dessert_id', $day);
				stuff('dinner', 'drink', 'drink_name', 'drink_1', 'drink_id', $day);
				stuff('dinner', 'drink', 'drink_name', 'drink_2', 'drink_id', $day);
				echo "</table></div>";
			}

			function stuff($meal, $course, $item_name, $meal_id, $course_id, $day_number){
				$mysqli = connection_setup();

				if(!($stmt = $mysqli->prepare("
					SELECT $course.$item_name, COUNT(p.diet_id) FROM $meal
					JOIN $course ON $course.$course_id = $meal.$meal_id
					JOIN patient AS p ON p.diet_id = $meal.diet_id
					WHERE $meal.day_id = \"$day_number\" AND $course.$item_name != \"N/A\"
					GROUP BY $item_name
				"))){
					echo "Prepare failed: " . $mysqli->errno . " " . $mysqli->error;
				}
				if(!($stmt->execute())){
					echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!($stmt->bind_result($diet_id, $count))){
					echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				while($stmt->fetch())
					echo "<tr>" . 		
					"<td>$diet_id</td>" .
					"<td>$count</td>" .
					"</tr>";
				}

			function getDay(){
					
				$mysqli = connection_setup();

				if(!($stmt = $mysqli->prepare("SELECT WEEKDAY(NOW()) + 1"))){
					echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
				}
				if(!($stmt->execute())){
					echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!($stmt->bind_result($day))){
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				$stmt->fetch();
				return $day;

			}
			$today = getDay();
			day_name($today);
			breakfast($today);
			lunch($today);
			dinner($today);

			echo "<br style=\"clear: left;\">";

			day_name(($today + 1));
			breakfast($today + 1);
			lunch($today + 1);
			dinner($today + 1);
		?>
		<br style="clear: left;">
		<p><form action="/">
			<button type="submit">Home Page</button><br>		
		</form></p>
	</body>
</html>