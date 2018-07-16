
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
				
        <title> NSDP </title>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#startDate").datepicker({dateFormat: 'yy-mm-dd'});
				$("#Date").datepicker({dateFormat: 'yy-mm-dd'});
			});
        </script>
</head>
<body>
<?php require_once("includes/session.php"); ?>
<?php 
	if(!isset($_SESSION['userID'])){
			header("Location: index.php");
			}
	?>
<?php
		if($_SESSION['role']==1){
				include("toolbar1.php");
		} elseif($_SESSION['user']=='nsdp') {
				include("toolbar1-certificate.php");
			}else{
			     include("Non-toolbar1.php");
			}
	//include("toolbar.php");
?>  <div id="main">
	<div style="width: 40%; margin-TOP: 165px; margin-left: auto; margin-right: auto;">
		<h3>NSDP - Certificate - Edit</h3>
	</div>	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
		$mysqli = new mysqli("localhost", "root", "password", "medatabase");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		$traineeCertificateID = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
		$name = null;
		$fatherName = null;	
        $organization=null;
        $certificatefor=null;
		$CertificateCode = null;
		$FileName = null;	
		$Path = null;
		$DepatmentID = null;
		$CertificateTypeID = null;
		$date = null;
        $FileName=null;
        $Path=null;
		//$FatherName = null;
		//$enddate =  null;
		//$remarks =  null;
		
		//$query = "SELECT project_name, description, province, district, start_date, end_date, donor, status from project where id = " . $projectId;
		$query = "SELECT  Certificate_ID, Name, FatherName, Certificatefor, Organization, RegNum,  Department_id, certificatetype_id, PrintDate, fileName,Path FROM nsdpcertificatesview where Certificate_ID = " . $traineeCertificateID;
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$traineeCertificateID = $row[0];
			$name = $row[1];
			$fatherName = $row[2];
			$certificatefor = $row[3];
			$organization= $row[4];
			$CertificateCode= $row[5];
			$DepatmentID= $row[6];
			$CertificateTypeID= $row[7];
            $date=$row[8];
            $FileName=$row[9];
            $Path=$row[10];
            
            //echo $path;
			//$FatherName = $row[8];
			//$startdate = $row[9];
		//	$enddate = $row[10];
			//$remarks = $row[11];
		} 
	?>	
	<form id="edit-project" action="update-NSDP-certificate.php" method="POST">
		<input type="hidden" value="<?php echo $traineeCertificateID; ?>" id="certificateId" name="certificateId" />	
		<table>	
 	          <tr>			
				<td>Name</td>
				<td>
					<input type="text" id="name" name="name" value="<?php echo $name; ?>" />
				</td>			
			</tr>	
            <tr>			
				<td>Father Name</td>
				<td>
					<input type="text" id="fatherName" name="fatherName" value="<?php echo $fatherName; ?>" />
				</td>			
			</tr>	
            <tr>			
				<td>Oganization</td>
				<td>
					<input type="text" id="organiztion" name="organiztion" value="<?php echo $organization; ?>" />
				</td>			
			</tr>
            <tr>			
				<td>Certificate For</td>
				<td>
					<input type="text" id="cFor" name="cFor" value="<?php echo $certificatefor; ?>" />
				</td>			
			</tr>			
			<tr>
				<td>Department</td>
				<td>
					<select id="department" name="department">
						<?php
						$query = "SELECT Department_id, Department from zdepartment";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $DepatmentID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>	
			<tr>
				<td>Certificate Type</td>
				<td>
					<select id="cType" name="cType">
						<?php
						$query = "SELECT distinct CertificateType_ID from nsdptraineecertificate";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $CertificateTypeID) ? "selected" : ""; ?>> <?php echo $row[0]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>		
			
			<tr>			
				<td>Path</td>
				<td>
					<input type="file" name="file" id="file" /> <a href='uploads/<?php echo $FileName; ?>' download> <?php echo $FileName; ?> 
				</td>			
			</tr>
			
			<tr>			
				<td>Date</td>
				<td>
					<input type="text" id="Date" name="Date" value="<?php echo $date; ?>" readonly="true"/>
				</td>			
			</tr>
						
			<tr>			
				<td colspan="2">
					<input type="submit" value="Update Project" class="btn primary"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
</body>
</html>
