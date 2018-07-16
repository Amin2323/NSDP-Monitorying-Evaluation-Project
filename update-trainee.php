<?php
	header("Location: list-trainees.php");
?>
	
<?php
	$traineeId 				= (isset($_POST['traineeId'])) ? $_POST['traineeId'] : "";
	$name 	 				= (isset($_POST['name'])) ? $_POST['name'] : "";
	$fname  			   	= (isset($_POST['fname'])) ? $_POST['fname'] : "";	
	$gender              	= (isset($_POST['gender'])) ? $_POST['gender'] : "";
	$language              	= (isset($_POST['language'])) ? $_POST['language'] : "";
	$status     			= (isset($_POST['status'])) ? $_POST['status'] : "";	
	$Physicalstatus 		= (isset($_POST['Pstatus'])) ? $_POST['Pstatus'] : "";
	$district  				= (isset($_POST['district'])) ? $_POST['district'] : "";	
	$village  				= (isset($_POST['village'])) ? $_POST['village'] : "";	
	$trade  				= (isset($_POST['trade'])) ? $_POST['trade'] : "";	
	$Add  					= (isset($_POST['Add'])) ? $_POST['Add'] : "";	
	$phone  				= (isset($_POST['phone'])) ? $_POST['phone'] : "";
	$email  				= (isset($_POST['email'])) ? $_POST['email'] : "";
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
//	$query = "INSERT INTO trainee (name, tazkira, position, organization, mobile_no) VALUES (
		//	'$name', '$tazkira', '$position', '$organization', '$mobile'
	$query = "update trainee set traineeNameEng = '$name', fatherNameEng = '$fname', genderID = '$gender', languageID = '$language',
	maritalStatusID = '$status', disabilityID = '$Physicalstatus', districtID = '$district', villageID = '$village',
	tradeID = '$trade', contactAddressEng = '$Add', contactPhoneNumber = '$phone', contactEmail = '$email'   where  traineeID = " . $traineeId;
	echo $query;
		
	$result = $mysqli->query($query);
	

if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
?> 