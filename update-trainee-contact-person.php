<?php
	header("Location: list-trainee-contact-person.php");
?>
	
<?php
	$traineeContactPersonId = (isset($_POST['traineeId'])) ? $_POST['traineeId'] : "";
	$name 	 				= (isset($_POST['name'])) ? $_POST['name'] : "";
	$fname  			   	= (isset($_POST['fname'])) ? $_POST['fname'] : "";	
	$projectID              = (isset($_POST['project'])) ? $_POST['project'] : "";
	$job     				= (isset($_POST['job'])) ? $_POST['job'] : "";	
	$mobile 				= (isset($_POST['phone'])) ? $_POST['phone'] : "";
	$email  				= (isset($_POST['email'])) ? $_POST['email'] : "";	
	$address  				= (isset($_POST['add'])) ? $_POST['add'] : "";	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
//	$query = "INSERT INTO trainee (name, tazkira, position, organization, mobile_no) VALUES (
		//	'$name', '$tazkira', '$position', '$organization', '$mobile'
	$query = "update traineecontactperson set tCName = '$name', tCFatherName = '$fname', job = '$job', phone = '$mobile', email = '$email', address = '$address', projectID = '$projectID'  where  traineeContactPersonID = " . $traineeContactPersonId;
	echo $query;
		
	$result = $mysqli->query($query);
	

if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
?> 