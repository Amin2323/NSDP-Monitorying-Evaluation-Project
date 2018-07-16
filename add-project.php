
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
			
			$(document).ready(function(){
				$("#eventStartDate").datepicker({dateFormat: 'dd-mm-yy'});
				$("#eventEndDate").datepicker({dateFormat: 'dd-mm-yy'});
				
			
			$("#btn-add").click(function(e){
					var donorId = $("#donor").val();
					var ipId = $("#ip").val();
					 var traineeName = $("#name").val();
					 var matcht = /^[A-Z a-z]+$/;
					// var traineefName = $("#fname").val();
					// var matchtfs = /^[A-Z a-z]+$/;
					
					// var job = $("#job").val();
					// var Add = $("#Add").val();
					// var pattern = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
					// var email = $("#email").val();
					// var phone = $("#phone").val(); 
					// var matchp =/^\d{10}$/; 
					// var age = $("#age").val();
					// var matchtf = /[0-9]+$/;
					
					var errorMessage = [];
					
					if(donorId == 0){
						errorMessage.push("Please Select Donor.");
					}
					if(ipId == 0){
						errorMessage.push("Please Select Implementation Partner.");
					}
					 if(traineeName == 0){
						 errorMessage.push("Please insert Trainee Name.");
					}else if(!(matcht.test(traineeName))){
						 errorMessage.push("Please Insert only Text for Trainee Name.");
					 }
					
					// if(traineefName == 0){
						// errorMessage.push("Please Insert Trainee Father Name.");
					// }else if(!(matchtfs.test(traineefName))){
						// errorMessage.push("Please Insert only Text for Trainee Father Name.");
					// }
										
					// if(job == 0){
						// errorMessage.push("Please inset the job.");
					// }	
				
					// if(Add == 0){
						// errorMessage.push("Please insert the Address for the Trainee Contact Person.");
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
	
?>
  <div id="main">
	<div style="width: 40%; margin-TOP: 150px; margin-left: auto; margin-right: auto;">
		<h3>Project - Add</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<div id="div-error" style="display: none;"></div>
	<form id="add-project" action="process1-add-project.php" method="POST">
		<table>			
			
			<tr>
				<td>Donor</td>
				<td>
				<select id="donor" name="donor">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT donorID, donorName from donor";
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
				<td>Consultant/IP</td>
				<td>
				<select id="ip" name="ip">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT consultantID, consultantName from consultant";
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
				<td>Project Number</td>
				<td>
					<input type="text" id="num" name="num" />
				</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td>
					<input type="text" id="name" name="name" />
				</td>
			</tr>
			<tr>			
				<td>Project Amount</td>
				<td>
					<input name="amount" type="amount" />
				</td>	
			</tr>
				<tr>				
				<td>Currancy</td>
				<td>
				<select id="currancy" name="currancy">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT CurrencyID, prjCurrencyEnglish from tbl_currency";
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
				<td>Project Status</td>
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
						
						$query = "SELECT projectstatusID, statusEnglish from tblkprojstatus";
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
				<td>Project Type</td>
				<td>
				<select id="type" name="type">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT prjtypeID, prjTypeEnglish from tbl_projecttype";
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
				<td>Start Date</td>
				<td>
					<input type="text" id="eventStartDate" name="eventStartDate" />
				</td>			
			</tr>
			<tr>
				<td>End Date</td>
				<td>
					<input type="text" id="eventEndDate" name="eventEndDate" />
				</td>			
			</tr>
			<tr>			
				<td>Remarks</td>
				<td>
					<input name="remarks" type="remarks" />
				</td>	
			</tr>
		
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			
			<tr>			
				
			</tr>
			<tr>			
						
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
