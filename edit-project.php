
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
				
        <title>Child Fund Afghanistan</title>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#startDate").datepicker({dateFormat: 'yy-mm-dd'});
				$("#endDate").datepicker({dateFormat: 'yy-mm-dd'});
			});
        </script>
</head>
<body>
<?php
	include("toolbar.php");
	$username=$_POST['username'];
	if(!$username)
	{
		header("Location: login1.php");
	}
?>
  <div id="main">
	<div style="width: 40%; margin-TOP: 130px; margin-left: auto; margin-right: auto;">
		<h3>Project - Edit</h3>
	</div>	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
		$mysqli = new mysqli("localhost", "root", "password", "trainee");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		$projectId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
		$name = null;
		$description = null;	
		$province = null;
		$district = null;	
		$startDate = null;
		$endDate = null;
		$donor = null;
		$status = null;
		
		$query = "SELECT project_name, description, province, district, start_date, end_date, donor, status from project where id = " . $projectId;
		
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$name = $row[0];
			$description = $row[1];
			$province = $row[2];
			$district = $row[3];
			$startDate= $row[4];
			$endDate= $row[5];
			$donor= $row[6];
			$status= $row[7];
		} 
	?>	
	<form id="edit-project" action="process-edit-project.php" method="POST">
		<input type="hidden" value="<?php echo $projectId; ?>" id="projectId" name="projectId" />	
		<table>			
			<tr>
				<td>Project Name</td>
				<td>
					<input name="name" type="text" id="name" value="<?php echo $name; ?>"/>
				</td>
			</tr>		
			<tr>			
				<td>Project Description</td>
				<td>
					<textarea name="description" type="text" id="description" rows="6"><?php echo $description; ?></textarea>
				</td>			
			</tr>
			<tr>			
				<td>Province</td>
				<td>
					<input type="text" id="province" name="province" value="<?php echo $province; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>District</td>
				<td>
					<input type="text" id="district" name="district" value="<?php echo $district; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Start Date</td>
				<td>
					<input type="text" id="startDate" name="startDate" value="<?php echo $startDate; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>End Date</td>
				<td>
					<input type="text" id="endDate" name="endDate" value="<?php echo $endDate; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Donor</td>
				<td>
					<input type="text" id="donor" name="donor" value="<?php echo $donor; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Project Status</td>
				<td>
					<input type="text" id="status" name="status" value="<?php echo $status; ?>"/>
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
