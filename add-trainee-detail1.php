
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
			
			$(document).ready(function(){
				$("#eventStartDate").datepicker({dateFormat: 'yy-mm-dd'});
				$("#eventEndDate").datepicker({dateFormat: 'yy-mm-dd'});
				});
			
			
        </script>
		<script type="text/javascript">
		
			$(document).ready(function () {
				$("#btnAddNewTrainee").click(function(){
					window.location.href = "add-trainee.php";
				});
				
				$(".delete-trainee").click(function(event){
					var r = confirm("Are you sure you want to delete this record?");
					if (r === true) {
						var target = $(event.target).parent();
						var traineeId = $(target).attr("traineeId");

						$.ajax({
							type: "GET",
							url: "delete-trainee.php?id=" + traineeId,
							success: function(data) {
								$(target).parent().parent().fadeOut();
							},
							error: function(data) {
								alert("Error deleting trainee.");
							}						
						});					
					}	
				});
				
				$("#trainees").dataTable({
					"bJQueryUI": 	true,
					"sDom": 		'T<"clear">lfrtip',
							"oTableTools": {
							"sRowSelect": "single",
							},
					"bPaginate": true,
					"bLengthChange": true, //how many records to show per page. 
					"bFilter": true,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false,
					"bStateSave": true,
					"aoColumnDefs": [
						{ "bVisible": false, "aTargets": [14] }
					],					
					"fnStateSave": function (oSettings, oData) {
						localStorage.setItem( 'DataTables_' + window.location.pathname, JSON.stringify(oData) );
					},
					"fnStateLoad": function (oSettings) {
						return JSON.parse(localStorage.getItem('DataTables_' + window.location.pathname));
					}
					
				});
			});
			
		</script>	
		<script type="text/javascript">
			$(document).ready(function () {	
			$('#project').change(function(){
					$.getJSON("getcenterProject_trainee.php?Id=" + $(this).val(), function(json) {
						$("#center").empty();
						_.each(json.centers, function(center){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#center").append("<option value=" + center.id + ">" + center.name + "</option>");
						});
					});
				});
				$('#project').click(function(){
				 
					$.getJSON("gettrainersProject.php?Id=" + $(this).val(), function(json) {
						$("#trainer").empty();
						_.each(json.trainers, function(trainer){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#trainer").append("<option value=" + trainer.id + ">" + trainer.name + "</option>");
						});
					});
				});
				
					$("#btn-add").click(function(e){
					//var traineeID = $("#traineeId");
					var projectId = $("#project").val();
					var centerId = $("#center").val();
					var trainerId = $("#trainer").val();
					var traineetypeId = $("#traineetype").val();
					var levelId = $("#level").val();
					var literacyId = $("#literacy").val();
					var eventStartDate = $("#eventStartDate").val();
					var eventEndDate = $("#eventEndDate").val();
					var age = $("#age").val();
					var matchtf = /[0-9]+$/;
					var contact = $("#contact").val();
					var startdate = $("#eventStartDate").val();
					var enddate = $("#eventEndDate").val();	
					
					
					
					var errorMessage = [];
					
					// if(traineeID == 0){
						// errorMessage.push("Please Select Trainee from below List.");
					// }
					if(projectId == 0){
						errorMessage.push("Please Select Project.");
					}
					if(centerId == 0){
						errorMessage.push("Project Select Training center.");
					}
					if(trainerId == 0){
						errorMessage.push("Please select a trainer. ");
					}
					
					if(levelId == 0){
						errorMessage.push("Please Select the Trade level for Trainee.");
					}
					if(eventStartDate == 0){
						errorMessage.push("Please insert Start Date  for the Trainee.");
					}
					if(eventEndDate == 0){
						errorMessage.push("Please Insert Trainee End Date for the Trainee.");
					}
					if(traineetypeId == 0){
						errorMessage.push("Please Select the Trainee Type.");
					}
					if(age == "") {
							errorMessage.push ("Please enter an Age for this Trainee");
						} else if(age < 15 || age > 45){
							errorMessage.push(" Invalid Range of Age. age should be between 15 and 45.");
						}
						else if(!(matchtf.test(age))){
							errorMessage.push ( "Use two digit number for age.");
						}
					if (startdate > enddate ){
						 //alert("End Date must be Greater then Start Date");
						 errorMessage.push("End Date must be Greater then Start Date.");
						}
					if(contact == 0){
						errorMessage.push("Please Insert the Contact Person for trainee.");
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
		<h3>Trainee Detail - Add</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<div id="div-error" style="display: none;"></div>
	<form id="add-trainee" action="process-add-trainee-detail1.php" method="POST">
				
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
						$userID = $_SESSION['userID'];
						$query = "SELECT distinct projectID, projectName from projectUser1 where userID = '{$userID}'  ";
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
				<td>Literacy</td>
				<td>
				<select id="literacy" name="literacy">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT literacyID, literacyEnglish from tbl_traineeliteracy";
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
			
				<td>Center Name</td>
				<td>
				<select id="center" name="center">
					
				</td>
				<td>Trainee Type</td>
				<td>
				<select id="traineetype" name="traineetype">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT traineeTypeID, traineeTypeEnglish from tbl_traineetype";
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
				<td>Trainer Name</td>
				<td>
				<select id="trainer" name="trainer">
					
				</td>
				<td>Age</td>
				<td>
					<input type="text" id="age" name="age" />
				</td>	
			</tr>
				<tr>
				<td>Training Type </td>
				<td>
					<select id="training" name="training">
						<option value="0">Please Select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT trainingtypeID, trainingTypeEnglish from tbl_skillstrainingtype";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
					</select> 				
				</td>
				<td>Start Date</td>
				<td>
					<input type="text" id="eventStartDate" name="eventStartDate" />
				</td>				
			</tr>
			</tr>	
			
			
			<tr>
				<td>Trade Level</td>
				<td>
				<select id="level" name="level">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT tradeLevelID, tradeLevelEnglish from tbl_skillstrainingtradelevel";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
				</td>
				
				<td>End Date</td>
				<td>
					<input type="text" id="eventEndDate" name="eventEndDate" />
				</td>
				
			</tr>
				
			<tr>
				<td>Contact Person</td>
				<td>
				<select id="contact" name="contact">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						$projectID = $_SESSION['projectID'];
						$query = "SELECT traineeContactPersonID, tCName from traineecontactperson where projectID = '{$projectID}'";
						//$query = "SELECT traineeContactPersonID, tCName from traineecontactperson";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM))
						{ ?>
							<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
						<?php
						}
						?>
						</select>
						<a href="add-trainee-contact-person.php">Add New</a>
				</td>
				
				<td>
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
 <div id="main">
	<div style="width: 90%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
		<h3>Trainees - Summary</h3>
	</div>
	
	<div style="width: 90%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	?>
	<table class="trainees" id="trainees">
		<thead>
			<tr>
			<th>Select</th>
				<th>ID</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Gender</th>
				<th>Address</th>
				<th>Language</th>
				<th>Status</th>
				<th>Physical Status</th>
				<th>District</th>
				<th>Village</th>
				<th>Trade</th>
				<th>Phone</th>
				<th>Email</th>
				
				
			</tr>
		</thead>
		<tbody>
			<?php
				$userID = $_SESSION['userID'];
				$traineessId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
				//echo $traineessId;
				$_SESSION['traineesId'] = $traineessId;
				
						$null = null;
						$query = "SELECT traineeID, traineeNameEng, fatherNameEng, genderEnglish, contactAddressEng, languageEnglish, maritalStatusEnglish, disabilityEnglish, districtName, villageName, tradeName, contactPhoneNumber, contactEmail FROM traineeview5 where userID = '{$userID}' and cenTrnTraID IS NULL  ";
					
				$result = $mysqli->query($query);	
				while($row = $result->fetch_array(MYSQLI_NUM))
				{
				 ?>
					<tr>
							<td>
								
								<a href="add-trainee-detail1.php?id=<?php echo $row[0]; ?>"><img src="images/edit.png" /></a>
								
							</td>
							<td><?php echo $row[0]; ?></td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><?php echo $row[3]; ?></td>
							<td><?php echo $row[4]; ?></td>
							<td><?php echo $row[5]; ?></td>
							<td><?php echo $row[6]; ?></td>
							<td><?php echo $row[7]; ?></td>
							<td><?php echo $row[8]; ?></td>
							<td><?php echo $row[9]; ?></td>
							<td><?php echo $row[10]; ?></td>
							<td><?php echo $row[11]; ?></td>
							<td><?php echo $row[12]; ?></td>
							
							<td></td>
					</tr>
						
					<?php
				}
			?>
		</tbody>			
	</table>
	
	</div>
 </div>
</body>
</html>
