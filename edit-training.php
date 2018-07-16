
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
	include("toolbar.php");
	
?>
  <div id="main">
	<div style="width: 40%; margin-TOP: 130px; margin-left: auto; margin-right: auto;">
		<h3>Training - Edit</h3>
	</div>	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
		$mysqli = new mysqli("localhost", "root", "password", "trainee");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		$trainingId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
		$name = null;
		$start_date = null;
		$end_date = null;
		$event_venue = null;
		
		$query = "SELECT name, start_date, end_date, event_venue from training where id = " . $trainingId;
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$name = $row[0];
			$start_date = $row[1];
			$end_date = $row[2];
			$event_venue = $row[3];
		} 
	?>
	<form id="edit-training" action="process-edit-training.php" method="POST">
		<input type="hidden" value="<?php echo $trainingId; ?>" id="trainingId" name="trainingId" />
		<table>			
			<tr>
				<td>Training Name</td>
				<td>
					<input type="text" id="name" name="name" value="<?php echo $name; ?>"/>
				</td>
			</tr>		
			<tr>			
				<td>Start Date</td>
				<td>
					<input type="text" id="eventStartDate" name="eventStartDate" value="<?php echo $start_date; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>End Date</td>
				<td>
					<input type="text" id="eventEndDate" name="eventEndDate" value="<?php echo $end_date; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Venue</td>
				<td>
					<input type="text" id="eventVenue" name="eventVenue" value="<?php echo $event_venue; ?>"/>
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
