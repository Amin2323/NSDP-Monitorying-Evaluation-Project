	<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$projectId = (isset($_GET['projectId'])) ? $_GET['projectId'] : "";
	$query = "SELECT distinct provinceID, provinceName from proprovince where projectID = '" . $projectId ."'";
	$result = $mysqli->query($query);
	$jsonString = "{\"provinces\": [";
	while($row = $result->fetch_array(MYSQLI_NUM)){ 
		$jsonString = $jsonString . "{\"id\":" . $row[0] . ",\"name\":\"" . $row[1] ."\"},";
	}
	$strLength = strlen($jsonString);
	$jsonString = substr($jsonString, 0, $strLength-1) . "]}";
	echo $jsonString;
?>															
