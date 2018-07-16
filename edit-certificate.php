
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
?>  
<div id="main">
	<div style="width: 40%; margin-TOP: 165px; margin-left: auto; margin-right: auto;">
		<h3>Trainee - Certificate - Edit</h3>
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
		$projectID = null;
		$ConsultantID = null;	
		$CertificateCode = null;
		$FileName = null;	
		$Path = null;
		$TraineeID = null;
		$CertificateTypeID = null;
		$date = null;
		//$FatherName = null;
		//$enddate =  null;
		//$remarks =  null;
		
		//$query = "SELECT project_name, description, province, district, start_date, end_date, donor, status from project where id = " . $projectId;
		$query = "SELECT  traineeCertificate_id, projectID, consultantID, certificateCode, filename, traineeID, certificatetype_id, date FROM nsdptraineecertificates where traineeCertificate_id = " . $traineeCertificateID;
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$traineeCertificateID = $row[0];
			$projectID = $row[1];
			$ConsultantID = $row[2];
			$CertificateCode = $row[3];
			$Path= $row[4];
			$TraineeID= $row[5];
			$CertificateTypeID= $row[6];
			$date= $row[7];
            //echo $row[4];
			//$FatherName = $row[8];
			//$startdate = $row[9];
		//	$enddate = $row[10];
			//$remarks = $row[11];
		} 
	?>	
	<form id="edit-project" action="update-certificate.php" method="POST" enctype="multi-part/form-data>
		<input type="hidden" value="<?php echo $traineeCertificateID; ?>" id="certificateId" name="certificateId" />	
		<table>			
			<tr>
				<td>Consultant</td>
				<td>
					<select id="consultant" name="consultant">
						<?php
						$query = "SELECT consultantID, consultantName from consultant";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $traineeCertificateID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>	
			<tr>
				<td>Project Name</td>
				<td>
					<select id="project" name="project">
						<?php
						$query = "SELECT projectID, projectName from project";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $projectID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>		
			<tr>
				<td>Trainee</td>
				<td>
					<select id="trainee" name="trainee">
						<?php
						$query = "SELECT traineeID, traineeNameEng from trainee";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $TraineeID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
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
						$query = "SELECT certificatetype_id, certificate from zcertificatetype";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $CertificateTypeID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>
		
			
			<tr>			
				<td>Path</td>
				<td>
					<input type="file" id="file" name="file"/> </td><td><a href='image/<?php echo $row[4]; ?>' download> <?php echo $row[4]; ?>
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
