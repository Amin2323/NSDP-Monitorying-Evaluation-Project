<?php
	//header("Location: list-certificate.php");
?>
	
<?php
	$certificateId 			= (isset($_POST['certificateId'])) ? $_POST['certificateId'] : "";
	$consultant 	 		= (isset($_POST['consultant'])) ? $_POST['consultant'] : "";
	$project  			   	= (isset($_POST['project'])) ? $_POST['project'] : "";	
	$trainee              	= (isset($_POST['trainee'])) ? $_POST['trainee'] : "";
	$cType              	= (isset($_POST['cType'])) ? $_POST['cType'] : "";
	$file       			= (isset($_FILES['file']['name'])) ? $_FILES['file']['name'] : "";	
	$Date           		= (isset($_POST['Date'])) ? $_POST['Date'] : "";
	$type                   =(isset($_FILES['file']['type'])) ? $_FILES['file']['type'] : "";
    $size                   =(isset($_FILES['file']['size'])) ? $_FILES['file']['size'] : "";
    $tmp                    =(isset($_FILES['file']['tmp_name'])) ? $_FILES['file']['tmp_name'] : "";
    $target_path            = 'image/';
    $current_time           = urlEncode(date("Y-m-d")); 
    $name                   = $current_time." ".$file;
    $target_path            = $target_path." ".basename($file);
	echo $name;
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
//	$query = "INSERT INTO trainee (name, tazkira, position, organization, mobile_no) VALUES (
		//	'$name', '$tazkira', '$position', '$organization', '$mobile'
	 if($type=='application/pdf')
        {
               
                        //move_uploaded_file($name,"/uploads/$name");
                        //move_uploaded_file($_FILES['file']['name'], $target_path);
                        if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path))
                        {
                            $userId= $_SESSION['userID'];
                            $query = "Update traineecertificate set  project_id = '$project', Trainee_Id = '$trainee', date='$Date', certificateType_id='$cType', fileName='$name', Path='$target_path' where  traineeCertificate_id = " . $certificateId;
                     	    $result = $mysqli->query($query);
                    	    echo $query;
                        }
                        else
                        {
                            echo 'error while copying file';
                            //header("Location: add-certificate");
                        }
                    
               
        
        }
    else
        {
            echo "System accept only PDF format!";
            //header("Location: add-certificate");
        }
    
		
	
	

if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
?> 