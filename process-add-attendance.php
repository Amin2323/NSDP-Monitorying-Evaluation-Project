<?php
	header("Location: index.php");
?>
	
<?php
	$trainingId = (isset($_POST['trainingId'])) ? $_POST['trainingId'] : "";
	$trainerId = (isset($_POST['trainerId'])) ? $_POST['trainerId'] : "";
	$traineeId = (isset($_POST['traineeId'])) ? $_POST['traineeId'] : "";
	$projectId = (isset($_POST['projectId'])) ? $_POST['projectId'] : "";	
	
	$mysqli = new mysqli("localhost", "root", "password", "trainee");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "INSERT INTO attendance (training_id, trainer_id, trainee_id, project_id) VALUES ('$trainingId', '$trainerId', '$traineeId', '$projectId')";
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