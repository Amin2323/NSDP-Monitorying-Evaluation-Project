	<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$districtId = (isset($_GET['Id'])) ? $_GET['Id'] : "";
	$query = "SELECT distinct centreID, centreName from genralrpt2 where districtID = '" . $districtId ."'";
	$result = $mysqli->query($query);
	$jsonString = "{\"centers\": [";
	while($row = $result->fetch_array(MYSQLI_NUM)){ 
		$jsonString = $jsonString . "{\"id\":" . $row[0] . ",\"name\":\"" . $row[1] ."\"},";
	}
	$strLength = strlen($jsonString);
	$jsonString = substr($jsonString, 0, $strLength-1) . "]}";
	echo $jsonString;
?>															
