
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
				
        <title>NSDP Trainees</title>
		<script type="text/javascript">
			$(document).ready(function () {
			$('#province').change(function(){
					$.getJSON("getDistricts.php?Id=" + $(this).val(), function(json) {
						$("#district").empty();
						_.each(json.districts, function(district){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#district").append("<option value=" + district.id + ">" + district.name + "</option>");
						});
					});
				});
				$('#district').click(function(){
					$.getJSON("getDistrictsVillage.php?Id=" + $(this).val(), function(json) {
						$("#village").empty();
						_.each(json.villages, function(village){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#village").append("<option value=" + village.id + ">" + village.name + "</option>");
						});
					});
				});
			
		
				$("#btn-add").click(function(e){
					var traineeName = $("#name").val();
					var matcht = /^[A-Z a-z]+$/;
					var traineefName = $("#fname").val();
					var matchtf = /^[A-Z a-z]+$/;
					var ProvinceId = $("#province").val();
					var genderId = $("#gender").val();
					var tradeId = $("#trade").val();
					var languageId = $("#language").val();
					var contact = $("#contact").val();
					var statusId = $("#status").val();
					var distabilityId = $("#distability").val();
					var pattern = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
					var email = $("#email").val();
					var phone = $("#phone").val(); 
					var matchp =/^\d{10}$/; 
					
					var errorMessage = [];
					
					if(traineeName == 0){
						errorMessage.push("Please insert Trainee Name.");
					}else if(!(matcht.test(traineeName))){
						errorMessage.push("Please Insert only Text for Trainee Name.");
					}
					
					if(traineefName == 0){
						errorMessage.push("Please Insert Trainee Father Name.");
					}else if(!(matchtf.test(traineefName))){
						errorMessage.push("Please Insert only Text for Trainee Father Name.");
					}
					
					if(ProvinceId == 0){
						errorMessage.push("Please Select Province.");
					}
					
					if(genderId == 0){
						errorMessage.push("Project Select Gender.");
					}	
					if(tradeId == 0){
						errorMessage.push("Please select a trade.");
					}
					if(languageId == 0){
						errorMessage.push("Please select a Language. ");
					}
					if(contact == 0){
						errorMessage.push("Please Insert the Address.");
					}
					if(statusId == 0){
						errorMessage.push("Please Select the Status.");
					}
					if(distabilityId == 0){
						errorMessage.push("Please Select the disability.");
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
	<div style="width: 40%; margin-TOP: 150px; margin-left: auto; margin-right: auto;">
		<h3>Trainee - Information</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<div id="div-error" style="display: none;"></div>
	<form id="add-trainee" action="process-add-trainee.php" method="POST">
		<table>			
			<tr>
				<td>Trainee Name</td>
				<td>
					<input type="text" id="name" name="name" />
				</td>
				<td>Province</td>
				<td>
				<select id="province" name="province">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT provinceID, provinceName from province";
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
				<td>Father Name</td>
				<td>
					<input type="text" id="fname" name="fname" />
				</td>
				<td>District</td>
				<td>
				<select id="district" name="district">
				</select>
					
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
				<td>Village</td>
				<td>
				<select id="village" name="village">
				</select>
					
				</td>
			</tr>
			<tr>			
				<td>Tazkira/ID</td>
				<td>
					<input name="tazkira" type="text" id="tazkira" onblur="MM_validateForm('tazkira','','NisNum','mobile','','NinRange1:10');return document.MM_returnValue" />
				</td>		
				<td>Trade</td>
				<td>
				<select id="trade" name="trade">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						$projectid = $_SESSION['projectID'];
						$query = "SELECT tradeID, tradeName from tradesProjects where projectID = '{$projectid}'";
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
				<td>Language</td>
				<td>
				<select id="language" name="language">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT languageID, languageEnglish from tbl_language";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
				</td>
				<td>Contact Address</td>
				<td>
					<input type="text" id="contact" name="contact" />
				</td>
			</tr>
			<tr>
				<td>Martail</td>
				<td>
				<select id="status" name="status">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT maritalStatusID, maritalStatusEnglish	 from tbl_traineemaritalstatus";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
				</td>
				<td>Phone</td>
				<td>
					<input type="text" id="phone" name="phone" />
				</td>		
				
			</tr>
			<tr>
				<td>Physical Status</td>
				<td>
				<select id="distability" name="distability">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT disabilityID, disabilityEnglish from tbl_traineedisability";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
				</td>
				<td>E-mail</td>
				<td>
					<input type="text" id="email" name="email" />
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
