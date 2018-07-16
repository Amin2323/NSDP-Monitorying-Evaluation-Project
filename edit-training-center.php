
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
				
        <title>NSDP</title>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#eventStartDate").datepicker({dateFormat: 'yy-mm-dd'});
				$("#eventEndDate").datepicker({dateFormat: 'yy-mm-dd'});
				
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
		} else {
				include("Non-toolbar1.php");
			}
	
?>
  <div id="main">
	<div style="width: 40%; margin-TOP: 150px; margin-left: auto; margin-right: auto;">
		<h3>Training Center - Edit</h3>
	</div>	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
		$mysqli = new mysqli("localhost", "root", "password", "medatabase");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		$centerId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
		$projectID = null;
		$districtID = null;
		$center = null;
		$location = null;
		
		$query = "SELECT centreID, projectID, districtID, centreName, location from trainingcentre where centreID = " . $centerId;
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$projectID = $row[1];
			$districtID = $row[2];
			$center = $row[3];
			$location = $row[4];
		} 
	?>
	<form id="edit-training" action="update-training-center.php" method="POST">
		<input type="hidden" value="<?php echo $centerId; ?>" id="centerId" name="centerId" />
		<table>			
				
			<tr>
				<td>Project Name</td>
				<td>
					<select id="project" name="project">
						<?php
						$query = "SELECT distinct projectID, projectName from trainingcenterview";
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
				<td>DistrictName Name</td>
				<td>
					<select id="district" name="district">
						<?php
						$query = "SELECT  districtID, districtName from trainingcenterview";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $districtID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>			
			<tr>			
				<td>Center Name</td>
				<td>
					<input type="text" id="centerName" name="centerName" value="<?php echo $center; ?>"/>
				</td>			
			</tr>
			
			<tr>			
				<td>Location</td>
				<td>
					<input type="text" id="location" name="location" value="<?php echo $location; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td colspan="2">
					<input type="submit" value="Update Training" class="btn primary"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
</body>
</html>
