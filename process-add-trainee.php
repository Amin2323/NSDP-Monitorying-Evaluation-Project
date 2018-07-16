
<?php require_once("includes/session.php"); ?>
<?php
	header("Location: add-trainee-detail1.php");
?>
	
<?php
	$tName = (isset($_POST['name'])) ? $_POST['name'] : "";
	$fName = (isset($_POST['fname'])) ? $_POST['fname'] : "";
	$gender = (isset($_POST['gender'])) ? $_POST['gender'] : "";

	//$tazkira = (isset($_POST['tazkira'])) ? $_POST['tazkira'] : "";	
	$language= (isset($_POST['language'])) ? $_POST['language'] : "";
	$status= (isset($_POST['status'])) ? $_POST['status'] : "";
	$disability= (isset($_POST['distability'])) ? $_POST['distability'] : "";
	$district= (isset($_POST['district'])) ? $_POST['district'] : "";
	$village= (isset($_POST['village'])) ? $_POST['village'] : "";
	$trade= (isset($_POST['trade'])) ? $_POST['trade'] : "";
	$contactadd = (isset($_POST['contact'])) ? $_POST['contact'] : "";
	$phone = (isset($_POST['phone'])) ? $_POST['phone'] : "";	
	$email = (isset($_POST['email'])) ? $_POST['email'] : "";	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	$userId= $_SESSION['userID'];
	$query = "INSERT INTO trainee (traineeNameEng, fatherNameEng, genderID, contactAddressEng, languageID, maritalStatusID, disabilityID, districtID, villageID, tradeID, contactPhoneNumber, contactEmail, UserID) VALUES (
			'$tName', '$fName', '$gender', '$contactadd' , '$language', '$status', '$disability', '$district', '$village', '$trade',  '$phone', '$email', '$userId')";
	$result = $mysqli->query($query);
	echo $query;
	if (!$result)
		{
			die('Error: ' . mysql_error());
		}
	// Selecting of Last Record for the Trainee Detail for inserting in Audit table (timuserroutine table)
		$query = "select MAX(traineeID) as traineeID from trainee";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{
							 $traineeID= $row[0]; 
							$_SESSION['traineeID']= $traineeID;
							//echo $_SESSION['traineeID'];
						}
	// Inserting record into the Audit table (timuserroutine table)	
	if(!isset($_SESSION['userID'])){
			header("Location: index.php");
			} else {
				$userId= $_SESSION['userID'];
				$query = "INSERT INTO timsusersroutine (userID, traineeID, routineTypeID) VALUES ('$userId', '$traineeID', 1 )";
					$result = $mysqli->query($query);
					//echo $query;
			}
		if (!$result)
		{
			die('Error: ' . mysql_error());
		}
?> 