<?php
ini_set('display_errors', 'on');
$mysqli = new mysqli("db738474819.db.1and1.com", "dbo738474819", "Enchilada#1", "db738474819");
if ($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Patient Added</title>
	<link rel="stylesheet" href="/css/style.css">
</head>
	<body>
		<?php
		if(!($stmt = $mysqli->prepare("INSERT INTO patient (first_name, last_name, room_number, DOB, diet_id) 
			VALUES (?, ?, ?, ?, ?)"))) {
			echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
		}
		if(!($stmt->bind_param("ssisi", $_POST['first'], $_POST['last'], $_POST['room'], $_POST['dob'], $_POST['diet']))) {
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute())
		{
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} 
		else 
		{
			echo "<div>" . $_POST['first'] . " " . $_POST['last'] . " has been added</div>";
		}

		?>

		<p><form action="/">
				<div><button type="submit">Home Page</button></div><br>		
			</form></p>

	</body>
</html>