<!DOCTYPE html>
<html>
<head>
	<title>Patients</title>
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div>
	<h2>Add New Patient</h2>
	<form method="post" action="added.php">
		<fieldset>
			<p>First Name: <input type="text" name="first"/></p>
			<p>Last Name: <input type="text" name="last"/></p>
			<p>Room Number: <input type="text" name="room"/></p>
			<p>Date of Birth: <input type="date" name="dob"/></p>
			<p>Diet: <select name="diet">
				<option value="1">NPO</option> 
				<option value="2">Regular</option>
				<option value="3">Diabetic</option>
				<option value="4">Cardiac</option>
				<option value="5">Pediatric</option>
				</select></p>
				<input type="submit" value="Add Patient">
		</fieldset>
	</form>
</div>
<br>
<div>
	<form action="/" method="post">
    <input type="submit" value="Home Page">
	</form>
</div>

</body>
</html>
