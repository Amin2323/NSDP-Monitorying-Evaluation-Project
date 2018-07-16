
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="js/underscore-1.3.3/underscore-min.js"></script>
		<script type="text/javascript" src="css/external/dropdown.js"></script>
			
		<link rel="Stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css" />
		
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.1/media/css/jquery.dataTables.css" />
		
		<script type="text/javascript" src="js/DataTables-1.9.1/media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen" />

		
        <title>NSDP Trainees</title>
		
		
		<script type="text/javascript">
			$(document).ready(function () {	
			
				
					$("#btn-add").click(function(e){
					
					var projectId = $("#project").val();
					var userId = $("#user").val();
					
					
					var errorMessage = [];
					
					
					if(projectId == 0){
						errorMessage.push("Please Select Project.");
					}
					if(userId == 0){
						errorMessage.push("Please Select user.");
					}
					
					if(errorMessage.length > 0) {
						e.preventDefault();
						$("#div-error").html("<strong>Please resolve the following errors.</strong><br />");
						$("#div-error").css("display", "block");
						
						$("#div-error").append('<ul id="error-list" style="list-style-type: square;" />');
						for(i = 0; i < errorMessage.length; i++){
							$("#error-list").append("<li><font color=black>" + errorMessage[i] + "</li>");
							$("#error-list").css("display", "block");
							$("#error-list").css("text-color", "red");
						}
					}
				});	
		});


        </script>
</head>
<body>
<?php require_once("includes/session.php"); ?>
<?php 
	$userID =$_SESSION['userID'];
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
	//include("toolbar.php");
?>
  <div id="main">
	<div style="width: 40%; margin-TOP: 150px; margin-left: auto; margin-right: auto;">
		<h3>Users For Projects - Add</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<div id="div-error" style="display: none;"></div>
	<form id="add-trainee" action="process-add-user-projects.php" method="POST">
		<table>			
			
				<tr>
				<td>Project Name </td>
				<td>
					<select id="project" name="project">
						<option value="0">Please Select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						$completed ="Completed";
						$query = "SELECT projectID, projectNo from ongoingprojects where statusEnglish != '{$completed}' ";
						//$query = "SELECT projectID, projectName from userProject where userID = '$userID'";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
					</select> 				
				</td>
				</tr>
				<tr>
				<td>User </td>
				<td>
				<select id="User" name="User">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT userID, userName from timsuser";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
				</td>
				</tr>
				
			<tr>			
				<td colspan="2">
					<input type="submit" value="Add Trainee" class="btn primary" id="btn-add"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
 

</body>
</html>
