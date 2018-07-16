
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
		<script type="text/javascript">
		$(document).ready(function(){
		$("#btn-add").click(function(e){
			var startdate = $("#eventStartDate").val();
			var enddate = $("#eventEndDate").val();		
			//var traineeName = $("#trainer").val();
			var matcht = /^[A-Z a-z]+$/;	
			var age = $("#age").val();
			var matchtf = /[0-9]+$/;
			
			var errorMessage = [];
			
			if (startdate > enddate ){
						 //alert("End Date must be Greater then Start Date");
						 errorMessage.push("End Date must be Greater then Start Date.");
				}
				
			
			if(age == "") {
							errorMessage.push ("Please enter an Age for this Trainee");
						} else if(age < 15 || age > 45){
							errorMessage.push(" Invalid Range of Age. age should be between 15 and 45.");
						}
						else if(!(matchtf.test(age))){
							errorMessage.push ( "Use two digit number for age.");
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
		$center = null;
		$trainerr = null;
		$trainingtype = null;
		$tradelevel = null;
		$literacy = null;
		$startdate = null;
		$enddate = null;
		$traineetype = null;
		$age = null;
		$contactperson = null;
		
		
		$query = "SELECT centreID, trainerID, trainingTypeID, tradeLevelID, literacyID, trainingStartDate, trainingEndDate, traineeTypeID, traineeAge, traineeContactPersonID FROM traineedetails where cenTrnTraID = " . $traineeId;
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$center = $row[0];
			$trainerr = $row[1];
			$trainingtype = $row[2];
			$tradelevel = $row[3];
			$literacy = $row[4];
			$startdate = $row[5];		
			$enddate = $row[6];
			$traineetype = $row[7];
			$age = $row[8];
			$contactperson = $row[9];
			// Id of Trainee Detail for updation table logs 
		//	$traineeDetailID =$row[10];
			//$_SESSION['traineedetailID']= $traineeDetailID;
		} 
	?>	
	<div id="div-error" style="display: none;"></div>
	
	<form id="edit-trainee" action="update-trainee-detail.php" method="POST">
		<input type="hidden" value="<?php echo $traineeId; ?>" id="traineeId" name="traineeId" />	
		<table>			
			<tr>			
				<td>Training Center</td>
				<td>
					<select id="center" name="center">
						<?php 
						
						$query = "SELECT centreID, centreName from trainingCentre";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $center) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>	
			<tr>			
				<td>Trainer</td>
				<td>
					<select id="trainer" name="trainer">
						<?php
						$query = "SELECT trainerID, trainerName from trainer";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $trainerr) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			
			<tr>			
				<td>Training Type</td>
				<td>
					<select id="ttype" name="ttype">
						<?php
						$query = "SELECT trainingTypeID, trainingTypeEnglish from tbl_skillstrainingtype";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $trainingtype) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>Trade level</td>
				<td>
					<select id="level" name="level">
						<?php
						$query = "SELECT tradeLevelID, tradeLevelEnglish from tbl_skillstrainingtradelevel";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $tradelevel) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>Literacy</td>
				<td>
					<select id="literacy" name="literacy">
						<?php
						$query = "SELECT literacyID, literacyEnglish from tbl_traineeliteracy";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $literacy) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>	
			<tr>			
				<td>Start Date</td>
				<td>
					<input type="text" id="eventStartDate" name="eventStartDate" value="<?php echo $startdate; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>End Date</td>
				<td>
					<input type="text" id="eventEndDate" name="eventEndDate" value="<?php echo $enddate; ?>"/>
				</td>			
			</tr>
				<tr>			
				<td>Trainee Type</td>
				<td>
					<select id="traineetype" name="traineetype">
						<?php
						$query = "SELECT traineeTypeID, traineeTypeEnglish from tbl_traineetype";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $traineetype) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>Age</td>
				<td>
					<input type="text" id="age" name="age" value="<?php echo $age; ?>"/>
				</td>			
			</tr>
			
			</tr>
				<tr>			
				<td>Contact Person</td>
				<td>
					<select id="cPerson" name="cPerson">
						<?php
						$_SESSION['projectID']
						$query = "SELECT traineeContactPersonID, tCName from traineecontactperson";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $contactperson) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			
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
