<?php require_once("includes/session.php"); ?>
<?php
	//header("Location: list-trainees-detail.php");
?>
	
<?php
	$traineeId = $_SESSION['traineesId'];
	echo $traineeId;
	if($traineeId == 0 ){
		header("Location: add-trainee-detail1.php");
	}else {
				$center = (isset($_POST['center'])) ? $_POST['center'] : "";
				$trainer = (isset($_POST['trainer'])) ? $_POST['trainer'] : "";	
				$trainingtype= (isset($_POST['training'])) ? $_POST['training'] : "";
				$tradelevel= (isset($_POST['level'])) ? $_POST['level'] : "";
				$literacy= (isset($_POST['literacy'])) ? $_POST['literacy'] : "";
				$eventStartDate= (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
				$eventEndDate= (isset($_POST['eventEndDate'])) ? $_POST['eventEndDate'] : "";
				$traineetype= (isset($_POST['traineetype'])) ? $_POST['traineetype'] : "";
				$age = (isset($_POST['age'])) ? $_POST['age'] : "";
				$contact = (isset($_POST['contact'])) ? $_POST['contact'] : "";	
				$mysqli = new mysqli("localhost", "root", "password", "medatabase");
				
				mysql_query("BEGIN");
				
				$query = "INSERT INTO traineedetails (centreID, trainerID, traineeID, trainingTypeID, tradeLevelID, literacyID,
				trainingStartDate, trainingEndDate, traineeTypeID, traineeAge, traineeContactPersonID) VALUES (
							'$center', '$trainer', '$traineeId', '$trainingtype', '$tradelevel', '$literacy', 
							'$eventStartDate', '$eventEndDate', '$traineetype', '$age', '$contact')";
				
				$result = $mysqli->query($query);
				echo $query;
					if (!$result)
						{
							die('Error: ' . mysql_error());
						}
		
		//}
		// Selecting of Last Record for the Trainee Detail for inserting in Audit table (timuserroutine table)
		$query1 = "select MAX(cenTrnTraID) as id from traineedetails";
						$result = $mysqli->query($query1);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{
							 $traineedetailID= $row[0]; 
							//echo $traineedetailID;
						}
	// Inserting record into the Audit table (timuserroutine table)	
		if(!isset($_SESSION['userID'])){
			header("Location: index.php");
			} else {
				$userId= $_SESSION['userID'];
				$query2 = "INSERT INTO timsusersroutine (userID, cenTrnTraID, routineTypeID) VALUES ('$userId', '$traineedetailID', 1 )";
					$result = $mysqli->query($query2);
					echo $query;
			}
		if(($query) and ($query2))
			{
				mysql_query("COMMIT");
				echo "data has saved";
			}
			else 
			{
				mysql_query("ROLLBACK");
				echo "queries has been cancelled";
			}	
		if (!$result)
		{
			die('Error: ' . mysql_error());
		}
		header("Location: list-trainees-detail.php");
	}
?> 