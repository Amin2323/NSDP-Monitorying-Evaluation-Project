<?php
	header("Location: list-trainers.php");
	
	$trainerId = (isset($_POST['trainerId'])) ? $_POST['trainerId'] : "";
	$projectID = (isset($_POST['project'])) ? $_POST['project'] : "";
	$districtID = (isset($_POST['district'])) ? $_POST['district'] : "";
	$centerID = (isset($_POST['center'])) ? $_POST['center'] : "";
	$tradeID = (isset($_POST['trade'])) ? $_POST['trade'] : "";
	$name = (isset($_POST['name'])) ? $_POST['name'] : "";
	$fatherName = (isset($_POST['fathername'])) ? $_POST['fathername'] : "";
	$genderID = (isset($_POST['gender'])) ? $_POST['gender'] : "";
	$age = (isset($_POST['age'])) ? $_POST['age'] : "";
	$experiance = (isset($_POST['experiance'])) ? $_POST['experiance'] : "";
	$educationID = (isset($_POST['education'])) ? $_POST['education'] : "";
	$phone = (isset($_POST['phone'])) ? $_POST['phone'] : "";
	$email = (isset($_POST['email'])) ? $_POST['email'] : "";
	$capacity = (isset($_POST['capacity'])) ? $_POST['capacity'] : "";
	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	//$query = "update trainer set name = '$name' where id = " . $trainerId;
	$query = "update trainer set projectID= $projectID, districtID = $districtID, centreID = $centerID, tradeID = $tradeID, trainerName='$name', fatherName = '$fatherName', genderID = $genderID, age = '$age',yearOfExperience = '$experiance',educationLevelID = $educationID, phone = '$phone', email = '$email', trainerCapacity = '$capacity'  where trainerID = " . $trainerId;
	echo $query;
	
	$result = $mysqli->query($query);
	
	if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
	
?> 