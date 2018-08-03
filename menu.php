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
		<title>Menu</title>
		<link rel="stylesheet" href="/css/style.css">
	</head>
	<body>
		<form method="post" action="dietMenu.php">
		<fieldset>
		<legend><h2>Select Diet</h2></legend>
		<p>Diet: <select name="diet_id"> 	
		<option value="2">Regular</option>
		<option value="3">Diabetic</option>
		<option value="4">Cardiac</option>
		<option value="5">Pediatric</option>
		</select></p>
		<input type="submit" value="View Menu">
		</fieldset>
		</form>
		<p><form action="/">
			<button type="submit">Home Page</button><br>		
		</form></p>
	</body>
</html>