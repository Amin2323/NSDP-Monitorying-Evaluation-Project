<?php
	//header("Location: list-certificate.php");
?>
	
<?php
	$certificateId 			= (isset($_POST['certificateId'])) ? $_POST['certificateId'] : "";
	$name       	 		= (isset($_POST['name'])) ? $_POST['name'] : "";
	$fatherName  		  	= (isset($_POST['fatherName'])) ? $_POST['fatherName'] : "";	
	$organization          	= (isset($_POST['organiztion'])) ? $_POST['organiztion'] : "";
    //$cfor                   = (isset($_POST['cFor'])) ? $_POST['cFor'] : "";
	$cType              	= (isset($_POST['cType'])) ? $_POST['cType'] : "";
    $department            	= (isset($_POST['department'])) ? $_POST['department'] : "";
    $file       			= (isset($_FILES['file']['name'])) ? $_FILES['file']['name'] : "";
	//$file       			=$_FILES['file']['name'];	
	$Date           		=(isset($_POST['Date'])) ? $_POST['Date'] : "";
    $type                   =(isset($_FILES['file']['type'])) ? $_FILES['file']['type'] : "";
    $size                   =(isset($_FILES['file']['size'])) ? $_FILES['file']['size'] : "";
    $tmp                    =(isset($_FILES['file']['tmp_name'])) ? $_FILES['file']['tmp_name'] : "";
//	$type                   =$_FILES['file']['type'];
   // $size                   =$_FILES['file']['size'];
   // $tmp                    =$_FILES['file']['tmp_name'];
    $target_path            = 'uploads/';
    $current_time           = urlEncode(date("Y-m-d")); 
    $name1                   = $file;
    $target_path            = $target_path." ".basename($file);
	echo $file;
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
//	$query = "INSERT INTO trainee (name, tazkira, position, organization, mobile_no) VALUES (
		//	'$name', '$tazkira', '$position', '$organization', '$mobile'
     //   if(!empty($file)){
       //     echo "there is no file to uploads";
       // }
	       //else
		 //  if($type=='application/pdf')
         //   {
					//if(empty($file)){
                        if(file_exists('uploads/'.$name1))
                        {
							//$userId= $_SESSION['userID'];
						   // echo('file is exist in the server');
                            $query = "Update nsdptraineecertificate set  Name = '$name', FatherName = '$fatherName', Organization='$organization',Department_ID='$department',  PrintDate='$Date', certificateType_id='$cType' where  Certificate_ID = " . $certificateId;
                     	    $result = $mysqli->query($query);
                    	    echo $query;    
							header("Location: list-NSDP-certificate.php");							
                        }                        
                        //move_uploaded_file($name,"/uploads/$name");
                    // else//move_uploaded_file($_FILES['file']['name'], $target_path);
					//}
						elseif(move_uploaded_file($_FILES['file']['tmp_name'],'uploads/'.$name1))
                        {
                           // $userId= $_SESSION['userID'];
                            $query = "Update nsdptraineecertificate set  Name = '$name', FatherName = '$fatherName', Organization='$organization',Department_ID='$department', PrintDate='$Date', certificateType_id='$cType', fileName='$name', Path='$target_path' where  Certificate_ID = " . $certificateId;
                     	    $result = $mysqli->query($query);
                    	    echo $query;
							header("Location: list-NSDP-certificate.php");
                        }
                        else
                        {
                            echo 'error while copying file';
                            //header("Location: add-certificate");
                        }
                    
               
        
       //     }
      //  else
       //     {
         //       echo "System accept only PDF format!";
                //header("Location: add-certificate");
         //   }

if (!$result)
	{
	  die('Error: ' . mysql_error());
	}
?> 