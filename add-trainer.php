
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
					$.getJSON("getDistrictsProvince.php?Id=" + $(this).val(), function(json) {
						$("#district").empty();
						_.each(json.districts, function(district){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#district").append("<option value=" + district.id + ">" + district.name + "</option>");
						});
					});
				});
				
				$('#district').click(function(){
					$.getJSON("getCenterDistrict.php?Id=" + $(this).val(), function(json) {
						$("#center").empty();
						_.each(json.centers, function(center){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#center").append("<option value=" + center.id + ">" + center.name + "</option>");
						});
					});
				});
				$('#center').click(function(){
					$.getJSON("gettraderProject.php?Id=" + $(this).val(), function(json) {
						$("#trade").empty();
						_.each(json.trades, function(trade){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#trade").append("<option value=" + trade.id + ">" + trade.name + "</option>");
						});
					});
				});
				$("#Add Training").click(function(){
					window.location.href = "list-trainers.php";
				});
				
				$("#btnAdd-Trainer").click(function(e){
					var projectId = $("#project").val();
					var traineeName = $("#Tname").val();
					var matcht = /^[A-Z a-z]+$/;
					var traineefName = $("#Tfathername").val();
					var matchtfs = /^[A-Z a-z]+$/;
					
					var genderId = $("#gender").val();
					var levelId = $("#elevel").val();
				
					var experiance = $("#experiance").val();
					var matchte = /[0-9]+$/;
					
					
					var pattern = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
					var email = $("#mail").val();
					var phone = $("#phone").val(); 
					var matchp =/^\d{10}$/; 
					var age = $("#age").val();
					var matchtf = /[0-9]+$/;
					
					var errorMessage = [];
					
					if(projectId == 0){
						errorMessage.push("Please Select Project.");
					}
					if(traineeName == 0){
						errorMessage.push("Please insert Trainee Name.");
					}else if(!(matcht.test(traineeName))){
						errorMessage.push("Please Insert only Text for Trainee Name.");
					}
					
					if(traineefName == 0){
						errorMessage.push("Please Insert Trainee Father Name.");
					}else if(!(matchtfs.test(traineefName))){
						errorMessage.push("Please Insert only Text for Trainee Father Name.");
					}
										
					if(genderId == 0){
						errorMessage.push("Project Select Gender.");
					}	
					if(age == "") {
							errorMessage.push ("Please enter an Age for this Trainee");
						} else if(age < 15 || age > 45){
							errorMessage.push(" Invalid Range of Age. age should be between 15 and 45.");
						}
						else if(!(matchtf.test(age))){
							errorMessage.push ( "Use two digit number for age.");
					}
					if(levelId == 0){
						errorMessage.push("Please select a trade Level.");
					}
					
					if(experiance == 0){
						errorMessage.push("Please Insert the Experiance.");
					}
					if(phone == 0){
						errorMessage.push("Please Enter CellPhone Number.");
					}else if(!(matchp.test(phone))){
						errorMessage.push("Please Insert 10 digit CellPhone Number.");
					}
					if(email == "") {
							errorMessage.push ("Please enter an email address");
						} else if(!(pattern.test(email))){
							errorMessage.push ( "Invalid email entered (example@domain.com).");
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
	<div style="width: 40%; margin-TOP: 165px; margin-left: auto; margin-right: auto;">
		<h3>Add - Trainer</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<div id="div-error" style="display: none;"></div>
	<form id="add-trainee" action="process-add-trainers.php" method="POST">
		<table>	
			<tr>
				<td>Project Name</td>
				<td>
					<select id="project" Name="project">
						<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						$role = $_SESSION['role'];
						if ( $role == 1){
						$query = "SELECT distinct projectID, projectName from project";
						} else {
						$userID = $_SESSION['userID'];
						$query = "SELECT distinct projectID, projectName from projectUser1 where userID = '{$userID}'  ";
						}
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
				<td>select Province</td>
				<td>
					<select id="province" name="province">
					</select>
				</td>
			</tr>
			<tr>
				<td>District Name </td>
				<td>
					<select id="district" name="district">
					
					</select> 				
				</td>			
			<tr>
				<td>center Name </td>
				<td>
					<select id="center" name="center">
					
					</select> 				
				</td>
				
			</tr>		
			<tr>
				<td>trade Name </td>
				<td>
					<select id="trade" name="trade">
					
					</select> 				
				</td>
			<tr>			
				<td>Trainer Name</td>
				<td>
					<input type="text" id="Tname" name="Tname" />
				</td>			
			</tr>
			<tr>			
				<td>Trainer Father Name</td>
				<td>
					<input type="text" id="Tfathername" name="Tfathername" />
				</td>			
			</tr>
			<tr>
				<td>Gender</td>
				<td>
				<select id="gender" name="gender">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT genderID, genderEnglish from tbl_gender";
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
				<td>Age</td>
				<td>
					<input type="text" id="age" name="age" />
				</td>			
			</tr>
			<tr>			
				<td>Experiance</td>
				<td>
					<input type="text" id="experiance" name="experiance" />
				</td>			
			</tr>
			<tr>
				<td>Education Level</td>
				<td>
				<select id="elevel" name="elevel">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT educationLevelID, educationLevelEnglish from tbl_trainereducationlevel";
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
				<td>E_Mail</td>
				<td>
					<input type="text" id="mail" name="mail" />
				</td>			
			</tr>
			<tr>			
				<td>Cell Phone</td>
				<td>
					<input type="text" id="phone" name="phone" />
				</td>			
			</tr>
			<tr>
				<td>Trainer Capacity</td>
				<td>
					<input type="text" id="capacity" name="capacity" />
				</td>
			</tr>
			<tr>			
				<td colspan="2">
					<input type="submit" value="Add Training" class="btn primary" id="btnAdd-Trainer"/>
				</td>			
			</tr>						
		</table>			
	</form>
	</div>
 </div>
</body>
</html>
