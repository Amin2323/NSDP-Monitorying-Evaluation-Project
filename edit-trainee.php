
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
		
				$("#btn-add").click(function(e){
					var Name = $("#name").val();
					var matcht = /^[A-Z a-z]+$/;
					var traineefName = $("#fname").val();
					var matchtf = /^[A-Z a-z]+$/;
					var ProvinceId = $("#district").val();
					var genderId = $("#gender").val();
					var tradeId = $("#trade").val();
					var languageId = $("#language").val();
					var contact = $("#contact").val();
					var statusId = $("#status").val();
					var distabilityId = $("#Pstatus").val();
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
		<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
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
		<h3>Trainee-Contact-Person - Edit</h3>
	</div>	
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
		$mysqli = new mysqli("localhost", "root", "password", "medatabase");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		$traineeId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
		$Name = null;
		$FatherName = null;
		$Gender = null;
		$Language = null;
		$MaritalStatus = null;
		$PhysicalStatus = null;
		$ProvinceID = null;
		$District = null;
		$Village = null;
		$tradeID = null;
		$ContactAdd = null;
		$Phone = null;
		$Email = null;
		
		//echo $traineeId;
		$query = "SELECT traineeID, traineeNameEng, fatherNameEng, genderID, languageID, maritalStatusID, disabilityID, provinceID,districtID, villageID, tradeID, contactAddressEng, contactPhoneNumber, contactEmail FROM traineeview3 where TraineeID = '{$traineeId}'";
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
		
			$Name = $row[1];
			$FatherName = $row[2];
			$Gender = $row[3];
			$Language = $row[4];
			$MaritalStatus = $row[5];		
			$PhysicalStatus = $row[6];
			$ProvinceID = $row[7];
			//echo $ProvinceID;
			$District = $row[8];
			//echo $District;
			$Village = $row[9];
			$tradeID = $row[10];
			$ContactAdd = $row[11];
			$Phone = $row[12];
			$Email = $row[13];
			
		} 
	?>	
	<div id="div-error" style="display: none;"></div>
	
	<form id="edit-trainee" action="update-trainee.php" method="POST">
		<input type="hidden" value="<?php echo $traineeId; ?>" id="traineeId" name="traineeId" />	
		<table>		
			<tr>			
				<td>Name</td>
				<td>
					<input type="text" id="name" name="name" value="<?php echo $Name; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Father Name</td>
				<td>
					<input type="text" id="fname" name="fname" value="<?php echo $FatherName; ?>"/>
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
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $Gender) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>	
			<tr>			
				<td>Language</td>
				<td>
					<select id="language" name="language">
						<?php
						$query = "SELECT languageID, languageEnglish from tbl_language";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $Language) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			
			<tr>			
				<td>Marital Status</td>
				<td>
					<select id="status" name="status">
						<?php
						$query = "SELECT maritalStatusID, maritalStatusEnglish from tbl_traineemaritalstatus";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $MaritalStatus) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>Physical Status</td>
				<td>
					<select id="Pstatus" name="Pstatus">
						<?php
						$query = "SELECT disabilityID, disabilityEnglish from tbl_traineedisability";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $PhysicalStatus) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>Province</td>
				<td>
					<select id="province" name="province">
						<?php
						$query = "SELECT provinceID, provinceName from province";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $ProvinceID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>District</td>
				<td>
					<select id="district" name="district">
						<?php
						$query = "SELECT districtID, districtName from district";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $District) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>Village</td>
				<td>
					<select id="village" name="village">
						<?php
						$query = "SELECT villageID, villageName from village";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $Village) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>				
			</tr>
			<tr>
				<td>Trade Name</td>
				<td>
					<select id="trade" name="trade">
						<?php
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
				<td>Contact Address</td>
				<td>
					<input type="text" id="Add" name="Add" value="<?php echo $ContactAdd; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Phone Number</td>
				<td>
					<input type="text" id="phone" name="phone" value="<?php echo $Phone; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Email Add</td>
				<td>
					<input type="text" id="email" name="email" value="<?php echo $Email; ?>"/>
				</td>			
			
			
			<tr>			
				<td colspan="2">
					<input type="submit" value="Update Trainee" class="btn primary" id="btn-add"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
</body>
</html>
