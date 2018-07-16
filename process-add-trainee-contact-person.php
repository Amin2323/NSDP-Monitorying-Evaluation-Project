<?php
	header("Location: list-trainee-contact-person.php");
?>
	
<?php
	$tcName = (isset($_POST['name'])) ? $_POST['name'] : "";
	$fName = (isset($_POST['fname'])) ? $_POST['fname'] : "";
	$project = (isset($_POST['project'])) ? $_POST['project'] : "";

	//$tazkira = (isset($_POST['tazkira'])) ? $_POST['tazkira'] : "";	
	$job= (isset($_POST['job'])) ? $_POST['job'] : "";
	$phone= (isset($_POST['phone'])) ? $_POST['phone'] : "";
	$email= (isset($_POST['email'])) ? $_POST['email'] : "";
	$add= (isset($_POST['add'])) ? $_POST['add'] : "";
	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "INSERT INTO traineecontactperson (tCName, tCFatherName, job, phone, email, address, projectID) VALUES ('$tcName', '$fName', '$job', '$phone', '$email',  '$add', '$project')";
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