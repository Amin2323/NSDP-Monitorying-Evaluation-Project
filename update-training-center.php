<?php
	header("Location: list-trainings-center.php");
	
	$centerID = (isset($_POST['centerId'])) ? $_POST['centerId'] : "";
	$project = (isset($_POST['project'])) ? $_POST['project'] : "";
	$district = (isset($_POST['district'])) ? $_POST['district'] : "";
	$center = (isset($_POST['centerName'])) ? $_POST['centerName'] : "";
	$location = (isset($_POST['location'])) ? $_POST['location'] : "";
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	//$query = "update trainingcentre set projectID = $project, districtID = $district, centreName = $center, location = $location where centreID = " . $centerID;
	$query = "update trainingcentre set projectID= $project, districtID = $district, centreName = '$center', location = '$location' where centreID = " . $centerID;
	echo $query;
	
	$result = $mysqli->query($query);
	
	if (!$result)
	{
	  die('Error: ' . mysql_error());
	}

	
?> 