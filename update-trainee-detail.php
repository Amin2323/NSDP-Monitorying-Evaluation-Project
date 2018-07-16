<?php
	header("Location: list-trainees-detail.php");
?>
	
<?php
	$traineedetailId 		= (isset($_POST['traineeId'])) ? $_POST['traineeId'] : "";
	$centername 	 		= (isset($_POST['center'])) ? $_POST['center'] : "";
	$trainer  			   	= (isset($_POST['trainer'])) ? $_POST['trainer'] : "";	
	$ttype              	= (isset($_POST['ttype'])) ? $_POST['ttype'] : "";
	$level              	= (isset($_POST['level'])) ? $_POST['level'] : "";
	$literacy     			= (isset($_POST['literacy'])) ? $_POST['literacy'] : "";	
	$eventStartDate 		= (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
	$eventEndDate  			= (isset($_POST['eventEndDate'])) ? $_POST['eventEndDate'] : "";	
	$traineetype  			= (isset($_POST['traineetype'])) ? $_POST['traineetype'] : "";	
	$age  					= (isset($_POST['age'])) ? $_POST['age'] : "";	
	$cPerson  				= (isset($_POST['cPerson'])) ? $_POST['cPerson'] : "";	
	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
//	$query = "INSERT INTO trainee (name, tazkira, position, organization, mobile_no) VALUES (
		//	'$name', '$tazkira', '$position', '$organization', '$mobile'
	$query = "update traineedetails set centreID = '$centername', trainerID = '$trainer', trainingTypeID = '$ttype', tradeLevelID = '$level',
	literacyID = '$literacy', trainingStartDate = '$eventStartDate', trainingEndDate = '$eventEndDate', traineeTypeID = '$traineetype',
	traineeAge = '$age', traineeContactPersonID = '$cPerson'  where  cenTrnTraID = " . $traineedetailId;
	echo $query;
		
	$result = $mysqli->query($query);
	

if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
?> 