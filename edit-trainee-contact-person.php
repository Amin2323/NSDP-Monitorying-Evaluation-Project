
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
				$("#eventStartDate").datepicker({dateFormat: 'dd-mm-yy'});
				$("#eventEndDate").datepicker({dateFormat: 'dd-mm-yy'});	
				$("#btnAdd-Trainer").click(function(e){
					var projectId = $("#project").val();
					var traineeName = $("#name").val();
					var matcht = /^[A-Z a-z]+$/;
					var traineefName = $("#fname").val();
					var matchtfs = /^[A-Z a-z]+$/;
					
					var job = $("#job").val();
					var Add = $("#Add").val();
					var pattern = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
					var email = $("#email").val();
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
										
					if(job == 0){
						errorMessage.push("Please inset the job.");
					}	
				
					if(Add == 0){
						errorMessage.push("Please insert the Address for the Trainee Contact Person.");
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
	<div style="width: 40%; margin-TOP: 160px; margin-left: auto; margin-right: auto;">
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
		$name = null;
		$fathername = null;
		$job = null;
		$phone = null;
		$email = null;
		$add = null;
		$projectID = null;
		
		$query = "SELECT tCName, tCFatherName, projectID, job, phone, email, address from traineeContactPerson where traineecontactPersonID = " . $traineeId;
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$name = $row[0];
			$fathername = $row[1];
			$projectID = $row[2];
			$job = $row[3];
			$phone = $row[4];
			$email = $row[5];		
			$add = $row[6];
		} 
	?>	
	<div id="div-error" style="display: none;"></div>
	<form id="edit-trainee" action="update-trainee-contact-person.php" method="POST">
		<input type="hidden" value="<?php echo $traineeId; ?>" id="traineeId" name="traineeId" />	
		<table>			
			<tr>
				<td>Contact Name</td>
				<td>
					<input name="name" type="text" id="name" value="<?php echo $name; ?>"/>
				</td>
			</tr>		
			<tr>			
				<td>Father Name</td>
				<td>
					<input type="text" id="fname" name="fname" value="<?php echo $fathername; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Project</td>
				<td>
					<select id="project" name="project">
						<?php
						$userID = $_SESSION['userID'];
						$query = "SELECT projectID, projectName from projectUser1 where userID = '{$userID}'  ";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $projectID) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>job</td>
				<td>
					<input type="text" id="job" name="job" value="<?php echo $job; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Cell Phone</td>
				<td>
					<input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>E-mail</td>
				<td>
					<input type="text" id="email" name="email" value="<?php echo $email; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Address</td>
				<td>
					<input type="text" id="add" name="add" value="<?php echo $add; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td colspan="2">
					<input type="submit" value="Update Trainee" class="btn primary" id ="btnAdd-Trainer"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
</body>
</html>
