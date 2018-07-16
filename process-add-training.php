<?php
	header("Location: list-trainings-center.php");
	
	$project = 	(isset($_POST['project'])) ? $_POST['project'] : "";
	$district = (isset($_POST['district'])) ? $_POST['district'] : "";
	$center = 	(isset($_POST['center'])) ? $_POST['center'] : "";	
	$location = (isset($_POST['location'])) ? $_POST['location'] : "";	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "INSERT INTO trainingcentre (projectID, districtID, centreName, location) VALUES ('$project','$district','$center','$location')";
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