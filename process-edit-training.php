<?php
	header("Location: list-trainings.php");
	
	$trainingId = (isset($_POST['trainingId'])) ? $_POST['trainingId'] : "";
	$name = (isset($_POST['name'])) ? $_POST['name'] : "";
	$start_date = (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
	$end_date = (isset($_POST['eventEndDate'])) ? $_POST['eventEndDate'] : "";
	$event_venue = (isset($_POST['eventVenue'])) ? $_POST['eventVenue'] : "";
	
	$mysqli = new mysqli("localhost", "root", "password", "trainee");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "update training set 
	name = '$name',
	start_date = '$start_date',
	end_date = '$end_date',
	event_venue = '$event_venue'
	where id = " . $trainingId;
	echo $query;
	
	$result = $mysqli->query($query);
	
	if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
	
?> 