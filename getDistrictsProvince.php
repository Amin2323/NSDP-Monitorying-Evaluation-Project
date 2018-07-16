	<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$provinceId = (isset($_GET['Id'])) ? $_GET['Id'] : "";
	$query = "SELECT distinct districtID, districtName from proprovince where provinceID = '" . $provinceId ."'";
	$result = $mysqli->query($query);
	$jsonString = "{\"districts\": [";
	while($row = $result->fetch_array(MYSQLI_NUM)){ 
		$jsonString = $jsonString . "{\"id\":" . $row[0] . ",\"name\":\"" . $row[1] ."\"},";
	}
	$strLength = strlen($jsonString);
	$jsonString = substr($jsonString, 0, $strLength-1) . "]}";
	echo $jsonString;
?>															
