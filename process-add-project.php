<?php
	//header("Location: list-projects.php");
?>
	
<?php
	$donor = (isset($_POST['donor'])) ? $_POST['donor'] : "";
	$ip = (isset($_POST['ip'])) ? $_POST['ip'] : "";	
	$num = (isset($_POST['num'])) ? $_POST['num'] : "";
	$name = (isset($_POST['name'])) ? $_POST['name'] : "";	
	$amount = (isset($_POST['amount'])) ? $_POST['amount'] : "";
	$currancy = (isset($_POST['currancy'])) ? $_POST['currancy'] : "";
	$status = (isset($_POST['status'])) ? $_POST['status'] : "";
	$type = (isset($_POST['type'])) ? $_POST['type'] : "";
	$startDate = (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
	$endDate = (isset($_POST['eventEndDate'])) ? $_POST['eventEndDate'] : "";
	$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] : "";
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "INSERT INTO project(donorID, consultantID, projectStatusID, projectNo, projectName, projectTypeID, projectAmount, currencyID,contractDate, endOfContract, remarks) VALUES (
									'$donor', '$ip', '$status','$num', '$name', '$type', '$amount', '$currancy', '$startDate', '$endDate', '$remarks')";
	$result = $mysqli->query($query);
	echo $query;
	if (!$result)
		{
			die('Error: ' . mysql_error());
		}	

?> 