<?php
	header("Location: list-trainers.php");
?>
	
<?php
	$projectId = (isset($_POST['project'])) ? $_POST['project'] : "";
	$districtId = (isset($_POST['district'])) ? $_POST['district'] : "";
	$centerId = (isset($_POST['center'])) ? $_POST['center'] : "";
	$tradeId = (isset($_POST['trade'])) ? $_POST['trade'] : "";	
	$tName=(isset($_POST['Tname']))? $_POST['Tname']:"";
	$tFName=(isset($_POST['Tfathername']))? $_POST['Tfathername']:"";
	$genderId = (isset($_POST['gender'])) ? $_POST['gender'] : "";	
	$age=(isset($_POST['age']))? $_POST['age']:"";
	$experiance=(isset($_POST['experiance']))? $_POST['experiance']:"";
	$elevel=(isset($_POST['elevel']))? $_POST['elevel']:"";
	$mail=(isset($_POST['mail']))? $_POST['mail']:"";
	$phone=(isset($_POST['phone']))? $_POST['phone']:"";
	$capacity=(isset($_POST['capacity']))? $_POST['capacity']:"";
	
	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "INSERT INTO trainer (projectID, districtID, centreID, tradeID, trainerName, fatherName, genderID, age, yearOfExperience, educationLevelID, Phone, email, trainerCapacity) VALUES ('$projectId', '$districtId', '$centerId', '$tradeId', '$tName', '$tFName','$genderId', '$age', '$experiance', '$elevel', '$mail', '$phone','$capacity')";
	$result = $mysqli->query($query);
	
	if (!$result)
	{
	  die('Error: ' . mysql_error());
	}	
/*
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con);
*/
?> 