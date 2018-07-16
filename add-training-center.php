
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />
		
		<script type="text/javascript" src="js/underscore-1.3.3/underscore-min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
				
        <title>National Skills Development Program</title>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#eventStartDate").datepicker({dateFormat: 'dd-mm-yy'});
				$("#eventEndDate").datepicker({dateFormat: 'dd-mm-yy'});	
				$('#project').change(function(){
					$.getJSON("getProvinceProject.php?projectId=" + $(this).val(), function(json) {
						$("#province").empty();
						_.each(json.provinces, function(province){
							
							$("#province").append("<option value=" + province.id + ">" + province.name + "</option>");
						});
					});
				});
				$('#province').click(function(){
					$.getJSON("getDistricts.php?Id=" + $(this).val(), function(json) {
						$("#district").empty();
						_.each(json.districts, function(district){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#district").append("<option value=" + district.id + ">" + district.name + "</option>");
						});
					});
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$("#btn-add").click(function(e){
					var project = $("#project").val();
					var province = $("#province").val();
					var district = $("#district").val();
					var center = $("#center").val();
					var location = $("#location").val();
				
					
					var errorMessage = [];
					
					if(project == 0){
						errorMessage.push("Please Select Project Name.");
					}
					
					if(province == 0){
						errorMessage.push("Please select Province.");
					}
					
					if(district == 0){
						errorMessage.push("Please Select District.");
					}
					
					if(center == 0){
						errorMessage.push("Project Insert Center.");
					}	
					if(location == 0){
						errorMessage.push("Please Insert a Location.");
					}
					
						
					if(errorMessage.length > 0) {
						e.preventDefault();
						$("#div-error").html("<strong>Please resolve the following errors.</strong><br />");
						$("#div-error").css("display", "block");
						
						$("#div-error").append('<ul id="error-list" style="list-style-type: square;" />');
						for(i = 0; i < errorMessage.length; i++){
							$("#error-list").append("<li>" + errorMessage[i] + "</li>");
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
	<div style="width: 40%; margin-TOP: 160px; margin-left: auto; margin-right: auto;">
		<h3>Add - Training Center</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<div id="div-error" style="display: none;"></div>
	<form id="add-trainee" action="process-add-training.php" method="POST">
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
						
						$query = "SELECT projectID, projectName from project";
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
				<td>Province Name</td>
				<td>
					<select id="province" name="province" /> 
				</td>
			</tr>			
			<tr>
				<td>District Name</td>
				<td>
					<select id="district" name="district" /> 
				</td>
			</tr>
			
			
			<tr>			
				<td>Center</td>
				<td>
					<input type="text" id="center" name="center" />
				</td>			
			</tr>
			<tr>
				<td>Location</td>
				<td>
					<input type="text" id="location" name="location" />
				</td>
			</tr>
			<tr>			
				<td colspan="2">
					<input type="submit" value="Add Training" class="btn primary" id="btn-add"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
</body>
</html>
