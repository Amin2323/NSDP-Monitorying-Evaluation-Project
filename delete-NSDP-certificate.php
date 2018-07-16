<?php
	header("Location: list-NSDP-certificate.php");
?>
	<?php require_once("includes/session.php"); ?>
<?php

	$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";	
	//$FileName1=(isset($_REQUEST['filename'])) ? $_REQUEST['filename'] : "";
   // echo $FileName1
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	$query = "delete from nsdptraineecertificate where Certificate_ID = " .  $id;
		
	$result = $mysqli->query($query);
    //echo $FileName1;
   // unlink('uploads/'.$FileName1);
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