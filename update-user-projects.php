<?php
	header("Location: list-user1-projects.php");
?>
	
<?php
	$prouserId 				= (isset($_POST['userId'])) ? $_POST['userId'] : "";
	$userID 	 			= (isset($_POST['user'])) ? $_POST['user'] : "";
	
	$projectID              = (isset($_POST['project'])) ? $_POST['project'] : "";
	
	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
//	$query = "INSERT INTO trainee (name, tazkira, position, organization, mobile_no) VALUES (
		//	'$name', '$tazkira', '$position', '$organization', '$mobile'
	//echo $Status;
	
	
	$query = "update projectuser set ProjectID = '$projectID', UserID = '{$userID}' where idProjectUser = " . $prouserId;
	
	echo $query;
		
	$result = $mysqli->query($query);
	
	
	
if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
?> 