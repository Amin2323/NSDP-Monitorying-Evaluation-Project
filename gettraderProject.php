	<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$centerId = (isset($_GET['Id'])) ? $_GET['Id'] : "";
	$query = "SELECT distinct tradeID, tradeName from Trainerpage where centreID = '" . $centerId ."'";
	$result = $mysqli->query($query);
	$jsonString = "{\"trades\": [";
	while($row = $result->fetch_array(MYSQLI_NUM)){ 
		$jsonString = $jsonString . "{\"id\":" . $row[0] . ",\"name\":\"" . $row[1] ."\"},";
	}
	$strLength = strlen($jsonString);
	$jsonString = substr($jsonString, 0, $strLength-1) . "]}";
	echo $jsonString;
?>															
