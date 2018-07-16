<?php require_once("includes/session.php"); ?>
<?php
	//header("Location: list-trainees.php");
?>
	
<?php
	$traineeId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
	echo $traineeId;
if (!isset($traineeId)){
			
			$center = (isset($_POST['center'])) ? $_POST['center'] : "";
	
				$trainer = (isset($_POST['trainer'])) ? $_POST['trainer'] : "";

			//$tazkira = (isset($_POST['tazkira'])) ? $_POST['tazkira'] : "";	
			$trainingtype= (isset($_POST['training'])) ? $_POST['training'] : "";
			$tradelevel= (isset($_POST['level'])) ? $_POST['level'] : "";
			$literacy= (isset($_POST['literacy'])) ? $_POST['literacy'] : "";
			$eventStartDate= (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
			$eventEndDate= (isset($_POST['eventEndDate'])) ? $_POST['eventEndDate'] : "";
			$traineetype= (isset($_POST['traineetype'])) ? $_POST['traineetype'] : "";
			$age = (isset($_POST['age'])) ? $_POST['age'] : "";
			$contact = (isset($_POST['contact'])) ? $_POST['contact'] : "";	
			
			$mysqli = new mysqli("localhost", "root", "password", "medatabase");
				/* check connection */
						if (mysqli_connect_errno()) {
								printf("Connect failed: %s\n", mysqli_connect_error());
								exit();
							}	
						//Selecting Last record of trainee for trainee detail Entry";
						$query = "select MAX(traineeID) as id from trainee";
								$result = $mysqli->query($query);	
								while($row = $result->fetch_array(MYSQLI_NUM))
									{
										$traineeID= $row[0]; 
									//echo $traineeID;
									}
					$query = "INSERT INTO traineedetails (centreID, trainerID, traineeID,trainingTypeID, tradeLevelID, literacyID, trainingStartDate, trainingEndDate, traineeTypeID, traineeAge, traineeContactPersonID) VALUES (
						'$center', '$trainer', '$traineeID', '$trainingtype', '$tradelevel', '$literacy', '$eventStartDate', '$eventEndDate', '$traineetype', '$age', '$contact' )";
						$result = $mysqli->query($query);
				//echo $query;
				if (!$result)
						{
						die('Error: ' . mysql_error());
						}					
							
	} else {
	
	
				$traineeId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
				$center = (isset($_POST['center'])) ? $_POST['center'] : "";
	
				$trainer = (isset($_POST['trainer'])) ? $_POST['trainer'] : "";

				//$tazkira = (isset($_POST['tazkira'])) ? $_POST['tazkira'] : "";	
				$trainingtype= (isset($_POST['training'])) ? $_POST['training'] : "";
				$tradelevel= (isset($_POST['level'])) ? $_POST['level'] : "";
				$literacy= (isset($_POST['literacy'])) ? $_POST['literacy'] : "";
				$eventStartDate= (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
				$eventEndDate= (isset($_POST['eventEndDate'])) ? $_POST['eventEndDate'] : "";
				$traineetype= (isset($_POST['traineetype'])) ? $_POST['traineetype'] : "";
				$age = (isset($_POST['age'])) ? $_POST['age'] : "";
				$contact = (isset($_POST['contact'])) ? $_POST['contact'] : "";	
				
				$query = "INSERT INTO traineedetails (centreID, trainerID, traineeID, trainingTypeID, tradeLevelID, literacyID, trainingStartDate, trainingEndDate, traineeTypeID, traineeAge, traineeContactPersonID) VALUES (
						'$center', '$trainer', '$traineeId', '$trainingtype', '$tradelevel', '$literacy', '$eventStartDate', '$eventEndDate', '$traineetype', '$age', '$contact' )";
				$result = $mysqli->query($query);
				//echo $query;
				if (!$result)
						{
						die('Error: ' . mysql_error());
						}
			}
	
	
	
	
	
	
		// Selecting of Last Record for the Trainee Detail for inserting in Audit table (timuserroutine table)
		$query = "select MAX(cenTrnTraID) as id from traineedetails";
						$result = $mysqli->query($query);	
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
				$query = "INSERT INTO timsusersroutine (userID, cenTrnTraID, routineTypeID) VALUES ('$userId', '$traineedetailID', 1 )";
					$result = $mysqli->query($query);
					//echo $query;
			}
		if (!$result)
		{
			die('Error: ' . mysql_error());
		}
?> 