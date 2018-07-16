
<?php require_once("includes/session.php"); ?>
<?php
	header("Location: list-certificate.php");
?>
	
<?php
	$consultant = (isset($_POST['consultant'])) ? $_POST['consultant'] : "";
	$project = (isset($_POST['project'])) ? $_POST['project'] : "";
	$trainee = (isset($_POST['Trainee'])) ? $_POST['Trainee'] : "";

	//$tazkira = (isset($_POST['tazkira'])) ? $_POST['tazkira'] : "";	
	$cType= (isset($_POST['ctype'])) ? $_POST['ctype'] : "";
	$cCode= (isset($_POST['ccode'])) ? $_POST['ccode'] : "";
	$eventStartDate= (isset($_POST['eventStartDate'])) ? $_POST['eventStartDate'] : "";
	//$department= (isset($_POST['department'])) ? $_POST['department'] : "";
    //$name=$_FILES['file']['name'];
    $type=$_FILES['file']['type'];
    $size=$_FILES['file']['size'];
    $tmp=$_FILES['file']['tmp_name'];
    $target_path = 'image/';
    $current_time = urlEncode(date("Y-m-d")); 
    $name=$current_time." ".$_FILES['file']['name'];
    $target_path = $target_path." ".basename($_FILES['file']['name']);
    //echo $current_time;
    
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
      
    
    if($type=='application/pdf')
        {
                        //move_uploaded_file($name,"/uploads/$name");
                        //move_uploaded_file($_FILES['file']['name'], $target_path);
                        if(move_uploaded_file($tmp, 'image/'.$name))
                        {
                            $userId= $_SESSION['userID'];
                            $query = "INSERT INTO traineecertificate (project_id, Trainee_Id, certificateCode, date, certificateType_id, fileName, Path) VALUES (
			                 '$project', '$trainee', '$cCode', '$eventStartDate', '$cType', '$name', '$target_path')";
                    	   $result = $mysqli->query($query);
                    	   //echo $query;
                        }
                        else
                        {
                            echo 'error while copying file';
                            //header("Location: add-certificate");
                        }
                    
                }
                
        
        
    else
        {
            echo "System Does accept only PDF format!";
           // header("Location: add-certificate");
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