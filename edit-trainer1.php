
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
		<script type="text/javascript" src="js/underscore-1.3.3/underscore-min.js"></script>
        <title>NSDP Trainees</title>
		<script type = "text/javascript">
			$(document).ready(function(){
				//$("#eventStartDate").datepicker({dateFormat: 'dd-mm-yy'});
				//$("#eventEndDate").datepicker({dateFormat: 'dd-mm-yy'});	
				$('#project').click(function(){
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
				// $("#Add Training").click(function(){
					// window.location.href = "list-trainers.php";
				// });
				
				// $("#btnAdd-Trainer").click(function(e){
					// var projectId = $("#project").val();
					// var traineeName = $("#Tname").val();
					// var matcht = /^[A-Z a-z]+$/;
					// var traineefName = $("#Tfathername").val();
					// var matchtfs = /^[A-Z a-z]+$/;
					
					// var genderId = $("#gender").val();
					// var levelId = $("#elevel").val();
				
					// var experiance = $("#experiance").val();
					// var matchte = /[0-9]+$/;
					
					
					// var pattern = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
					// var email = $("#mail").val();
					// var phone = $("#phone").val(); 
					// var matchp =/^\d{10}$/; 
					// var age = $("#age").val();
					// var matchtf = /[0-9]+$/;
					
					// var errorMessage = [];
					
					// if(projectId == 0){
						// errorMessage.push("Please Select Project.");
					// }
					// if(traineeName == 0){
						// errorMessage.push("Please insert Trainee Name.");
					// }else if(!(matcht.test(traineeName))){
						// errorMessage.push("Please Insert only Text for Trainee Name.");
					// }
					
					// if(traineefName == 0){
						// errorMessage.push("Please Insert Trainee Father Name.");
					// }else if(!(matchtfs.test(traineefName))){
						// errorMessage.push("Please Insert only Text for Trainee Father Name.");
					// }
										
					// if(genderId == 0){
						// errorMessage.push("Project Select Gender.");
					// }	
					// if(age == "") {
							// errorMessage.push ("Please enter an Age for this Trainee");
						// } else if(age < 15 || age > 45){
							// errorMessage.push(" Invalid Range of Age. age should be between 15 and 45.");
						// }
						// else if(!(matchtf.test(age))){
							// errorMessage.push ( "Use two digit number for age.");
					// }
					// if(levelId == 0){
						// errorMessage.push("Please select a trade Level.");
					// }
					
					// if(experiance == 0){
						// errorMessage.push("Please Insert the Experiance.");
					// }
					// if(phone == 0){
						// errorMessage.push("Please Enter CellPhone Number.");
					// }else if(!(matchp.test(phone))){
						// errorMessage.push("Please Insert 10 digit CellPhone Number.");
					// }
					// if(email == "") {
							// errorMessage.push ("Please enter an email address");
						// } else if(!(pattern.test(email))){
							// errorMessage.push ( "Invalid email entered (example@domain.com).");
						// }			
						
					// if(errorMessage.length > 0) {
						// e.preventDefault();
						// $("#div-error").html("<strong>Please resolve the following errors.</strong><br />");
						// $("#div-error").css("display", "block");
						
						// $("#div-error").append('<ul id="error-list" style="list-style-type: square;" />');
						// for(i = 0; i < errorMessage.length; i++){
							// $("#error-list").append("<li>" + errorMessage[i] + "</li>");
						// }
					// }
				// });
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
		<h3>Trainer - Edit</h3>
	</div>	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
		$mysqli = new mysqli("localhost", "root", "password", "medatabase");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		$trainerId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
		$projectID = null;
		$districtID = null;
		$centerID = null;
		$tradeID = null;
		$trainerName = null;
		$fatherName = null;
		$genderID = null;
		$age = null;
		$experiance = null;
		$eLevel = null;
		$phone = null;
		$email = null;
		$capacity = null;
		
		$query = "SELECT trainerID, projectID, districtID, centreID,tradeID, trainerName, fatherName,genderID, age, yearOfExperience, educationLevelID, phone, email,trainerCapacity from trainer where trainerID = " . $trainerId;
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$projectID = $row[1];	
			$districtID = $row[2];	
			$centerID = $row[3];	
			$tradeID = $row[4];	
			$trainer = $row[5];	
			$fatherName = $row[6];
			$gender = $row[7];	
			$age = $row[8];	
			$experiance = $row[9];
			$eLevel = $row[10];	
			$email = $row[11];
			$phone = $row[12];
			$capacity = $row[13];
		} 
		
	?>
	<form id="edit-trainer" action="update-trainer.php" method="POST">
		<input type="hidden" value="<?php echo $trainerId; ?>" id="trainerId" name="trainerId" />
		<table>	
			<tr>
				<td>Project Name</td>
				<td>
					<select id="project" name="project">
						<?php
						$userID = $_SESSION['userID'];
						$query = "SELECT projectID, projectName from projectUser1 where userID = '{$userID}'  ";
						//$query = "SELECT projectID, projectName from project";
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
				<td>select Province</td>
				<td>
					<select id="province" name="province">
					</select>
				</td>
			</tr>			
			<tr>
				<td>District Name</td>
				<td>
					<select id="district" name="district">
						<?php
						$userID = $_SESSION['userID'];
						$query = "SELECT districtID, districtName from projectUser1 where userID = '{$userID}'";
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
					<select id="center" name="center">
						<?php
						$userID = $_SESSION['userID'];
						$query = "SELECT centreID, centreName from  projectUser1 where userID = '{$userID}'";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $centerID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>
			<tr>
				<td>Trade Name</td>
				<td>
					<select id="trade" name="trade">
						<?php
						// projectUser1 where userID = '{$userID}'
						$query = "SELECT tradeID, tradeName from trades";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $tradeID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>					
			<tr>
				<td>Trainer Name</td>
				<td>
					<input type="text" id="name" name="name" value="<?php echo $trainer; ?>"/>
				</td>
			</tr>
			<tr>
				<td>Trainer Father Name</td>
				<td>
					<input type="text" id="fathername" name="fathername" value="<?php echo $fatherName; ?>"/>
				</td>
			</tr>	
			<tr>
				<td>Gender</td>
				<td>
					<select id="gender" name="gender">
						<?php
						$query = "SELECT genderID, genderEnglish from tbl_gender";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $gender) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>	
			<tr>
				<td>Trainer age</td>
				<td>
					<input type="text" id="age" name="age" value="<?php echo $age; ?>"/>
				</td>
			</tr>
			<tr>
				<td>Years of Experiance</td>
				<td>
					<input type="text" id="experiance" name="experiance" value="<?php echo $experiance; ?>"/>
				</td>
			</tr>	
			<tr>
				<td>Education Level</td>
				<td>
					<select id="education" name="education">
						<?php
						$query = "SELECT educationLevelID, educationLevelEnglish from tbl_trainereducationlevel";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $eLevel) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
					</select> 
				</td>
			</tr>
			<tr>
				<td>Trainer Phone</td>
				<td>
					<input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"/>
				</td>
			</tr>
			<tr>
				<td>Trainer E-mail</td>
				<td>
					<input type="text" id="email" name="email" value="<?php echo $email; ?>"/>
				</td>
			</tr>
			<tr>
				<td>Trainer Capacity</td>
				<td>
					<input type="text" id="capacity" name="capacity" value="<?php echo $capacity; ?>"/>
				</td>
			</tr>				
			<tr>			
				<td colspan="2">
					<input type="submit" value="Update Trainee" class="btn primary"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
</body>
</html>
