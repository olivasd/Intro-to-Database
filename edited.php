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
	<title>Edited</title>
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT first_name, last_name FROM patient WHERE patient_id = "  . $_POST["pid"]))){
		echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	}
	if(!($stmt->execute())){
		echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!($stmt->bind_result($first_name, $last_name))){
		echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	$stmt->fetch();
	
	echo "<h1>" . $first_name . " " . $last_name . " has been edited</h1>";

	$stmt->close()
	?>

	<?php
	if(!($stm = $mysqli->prepare("UPDATE patient SET room_number = ?, diet_id = ? WHERE patient_id = ?"))){
		echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
	}
	if(!($stm->bind_param("iii", $_POST["room_number"], $_POST["diet_id"], $_POST["pid"])))
	{
		echo "Bind failed: " . $mysqli->errno . " " . $mysqli->error;
	}
	if(!$stm->execute()) {
			echo "Execute failed: " . $mysqli->errno . " " . $mysqli->error;
	}
	$stm->close()
	?>

	<p><form action="/">
				<button type="submit">Home Page</button><br>		
			</form></p>

	<p><form action="patients.php">
				<button type="submit">Patient Page</button><br>		
			</form></p>
	
</body>
</html>