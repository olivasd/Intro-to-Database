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
	<title>Patients</title>
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<h1>Patient List</h1>
	<table class="minimalistBlack">
	<thead>
		<tr>
			<th>Patient Number</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Room Number</th>
			<th>Date of Birth</th>
			<th>Diet</th>
		</tr>
	</thead>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT p.patient_id, p.first_name, p.last_name, p.room_number, p.DOB, d.diet_name FROM patient p 
		JOIN diet AS d ON p.diet_id = d.diet_id
		GROUP BY p.room_number"))){
		echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	}
	if(!($stmt->execute())){
		echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!($stmt->bind_result($pid, $fn, $ln, $rm, $dob, $did))){
		echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while ($stmt->fetch()){
		echo "<tr>" . 
		"<td><form action=\"patient.php\" method=\"post\"><button type=\"submit\" name=\"pid\" value=\"" . $pid . "\">" . $pid . "</form></td>" .
		"<td>" . $fn . "</td>" .
		"<td>" . $ln . "</td>" .
		"<td>" . $rm . "</td>" .
		"<td>" . $dob . "</td>" .
		"<td>" . $did . "</td>" .
		"</tr>";
	}
	?>
</table>

<br>
		
			<form action="addPatient.php" method="post">
				<button type="submit">Add New Patient</button><br>		
			</form>
		

		<p><form action="/">
				<button type="submit">Home Page</button><br>		
			</form></p>

</body>
</html>
