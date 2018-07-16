
<?php require_once("includes/session.php"); ?>
<?php
	header("Location: list-user1-projects.php");
?>
	
<?php
	$projectID = (isset($_POST['project'])) ? $_POST['project'] : "";
	$userID = (isset($_POST['User'])) ? $_POST['User'] : "";
	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "INSERT INTO projectuser (ProjectID, UserID) VALUES (
			'$projectID', '$userID')";
	$result = $mysqli->query($query);
	echo $query;
	if (!$result)
		{
			die('Error: ' . mysql_error());
		}
	// Selecting of Last Record for the Trainee Detail for inserting in Audit table (timuserroutine table)
		// $query = "select MAX(idProjectUser) as UserProjectID from projectuser";
						// $result = $mysqli->query($query);	
						// while($row = $result->fetch_array(MYSQLI_NUM))
						// {
							 // $proUserID= $row[0]; 
							// $_SESSION['prouser']= $proUserID;
							// //echo $_SESSION['traineeID'];
						// }
	// Inserting record into the Audit table (timuserroutine table)	
	// if(!isset($_SESSION['userID'])){
			// header("Location: index.php");
			// } else {
				// $userId= $_SESSION['userID'];
				// $query = "INSERT INTO timsusersroutine (userID, traineeID, routineTypeID) VALUES ('$userId', '$proUserID', 1 )";
					// $result = $mysqli->query($query);
					// //echo $query;
			// }
		// if (!$result)
		// {
			// die('Error: ' . mysql_error());
		// }
?> 