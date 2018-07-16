<?php
	header("Location: list-trainee-contact-person.php");
?>
	<?php require_once("includes/session.php"); ?>
<?php

	$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";	
	
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "delete from traineeContactPerson where traineeContactPersonID = " .  $id;
		
	$result = $mysqli->query($query);
	echo $query;
	
	if ($result){
	  echo "{'sucess': true}";
	} else {
		echo "{'sucess': false}";
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