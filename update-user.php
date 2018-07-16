<?php
	header("Location: list-user1.php");
?>
	
<?php
	$userId 				= (isset($_POST['userId'])) ? $_POST['userId'] : "";
	$role 	 				= (isset($_POST['role'])) ? $_POST['role'] : "";
	$username  			   	= (isset($_POST['uname'])) ? $_POST['uname'] : "";	
	$password 			   	= (isset($_POST['pass'])) ? $_POST['pass'] : "";
	$hashed_password 		= sha1($password);
	$projectID              = (isset($_POST['project'])) ? $_POST['project'] : "";
	//$checkStatus     		= (isset($_POST['cstatus'])) ? $_POST['cstatus'] : "";	
	$Status     			= (isset($_POST['status'])) ? $_POST['status'] : "";
	$value1					='1';
	$value2					='0';
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
//	$query = "INSERT INTO trainee (name, tazkira, position, organization, mobile_no) VALUES (
		//	'$name', '$tazkira', '$position', '$organization', '$mobile'
	echo $Status;
	if((isset($_POST['status']))){
	
	$query = "update timsuser set userName = '$username', pass = '{$hashed_password}', roleID = '$role', status = '1' where  userID = " . $userId;
	} else {
	$query = "update timsuser set userName = '$username', pass = '{$hashed_password}', roleID = '$role', status = '0' where  userID = " . $userId;
	}
	echo $query;
		
	$result = $mysqli->query($query);
	
	
	$query = "update projectuser set ProjectID = '$projectID', UserID = '{$userId}' where userID = " . $userId;
	
	//echo $query;
		
	$result = $mysqli->query($query);
if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
?> 