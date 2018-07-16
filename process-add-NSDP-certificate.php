
<?php require_once("includes/session.php"); ?>
<?php
	header("Location: list-NSDP-certificate.php");
?>
	
<?php
	$tName 			= (isset($_POST['trainee'])) ? $_POST['trainee'] : "";
	$traineeFather 	= (isset($_POST['traineeFather'])) ? $_POST['traineeFather'] : "";
	$organization 	= (isset($_POST['organization'])) ? $_POST['organization'] : "";

	//$tazkira = (isset($_POST['tazkira'])) ? $_POST['tazkira'] : "";	
	$cType			= (isset($_POST['ctype1'])) ? $_POST['ctype1'] : "";
	$cCode			= (isset($_POST['ccode'])) ? $_POST['ccode'] : "";
    //$cFor=(isset($_POST['certificateFor'])) ? $_POST['certificateFor']:"";
	$eventStartDate	= (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
	$department= (isset($_POST['department'])) ? $_POST['department'] : "";
    //$name=$_FILES['file']['name'];
    $type=$_FILES['file']['type'];
    $size=$_FILES['file']['size'];
    $tmp=$_FILES['file']['tmp_name'];
    $target_path = 'uploads/';
    $current_time = urlEncode(date("Y-m-d")); 
    $name= $current_time." ".$_FILES['file']['name'];
    $target_path = $target_path." ".basename($_FILES['file']['name']);
    echo $cCode;
    
    // echo $tmp;
    //if($name=='')
    //{
      
        //header("Location: add-certificate.php");
        //  echo "<script>alert('Please select a file from computer!')</script>";
        //  exit();
   // }//
    
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
    $query1 ="select RegNum from nsdptraineecertificate where RegNum = '$cCode'";  
	$result1 = $mysqli->query($query1);
	//$rowcount= $result1->rowCount();
	$rowcount=mysqli_num_rows($result1);
	if($rowcount !=1)
	{
		if($type=='application/pdf')
        {
                        if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$name))
                        {
                            $userId= $_SESSION['userID'];
                            $query = "INSERT INTO nsdptraineecertificate (Name, FatherName, Organization, Department_ID, PrintDate, CertificateType_ID, RegNum, fileName, Path) VALUES (
			                 '$tName', '$traineeFather', '$organization', '$department', '$eventStartDate', '$cType', '$cCode', '$name', '$target_path')";
                    	   $result = $mysqli->query($query);
                    	   //echo $query;
                        }
                        else
                        {
                            echo 'error while copying file';
                            header("Location: add-certificate");
                        }
        
        }
		
		else
			{
				echo "System Does accept only PDF format!";
				header("Location: add-certificate");
			}
	}
	else 
	{
		$error = "Registertion Number Already Exist";
		$_SESSION['erorr'] = 'Code Number:'.$cCode.' '.$error;
		//$_SESSION['role'] =
		header("Location: add-NSDP-certificate.php");
		//echo $error;

	}

    /*
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
        */
        
?> 