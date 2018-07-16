
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>		
		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
		
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />
		<link rel="Stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css" />
		
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.1/media/css/jquery.dataTables.css" />
		
		<script type="text/javascript" src="js/DataTables-1.9.1/media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen" />
		
		<script type="text/javascript">
		
			$(document).ready(function () {
				$("#btnAddNewTrainee").click(function(){
					window.location.href = "add-trainee-detail1.php";
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
					"bPaginate": true,
					"bLengthChange": true, //how many records to show per page. 
					"bFilter": true,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false,
					"bStateSave": true,
					"aoColumnDefs": [
						{ "bVisible": false, "aTargets": [15] }
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
        <title>NSDP</title>
		<script type="text/javascript">
			$(document).ready(function () {
				$("#accordion-android").accordion({animated: 'bounceslide', collapsible: true});
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
	<div style="width: 90%; margin-TOP: 160px; margin-left: auto; margin-right: auto;">
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
				<th>ID</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Gender</th>
				<th>Language</th>
				<th>Marital Status</th>
				<th>Physical Status</th>
				<th>province</th>
				<th>District</th>
				<th>Village</th>
				<th>Trade</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Edit/Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$roleID =$_SESSION['role'];
				$userID = $_SESSION['userID'];
				$ipid = $_SESSION['ipID'];
				//echo $ipid;
				 if($roleID != "1"){
				$query = "SELECT traineeID, traineeNameEng, fatherNameEng, genderEnglish, LanguageEnglish, maritalStatusEnglish, disabilityEnglish,
				provinceName, districtName, villageName, tradeName, contactAddressEng, contactPhoneNumber, contactEmail FROM traineeview4 where traineeNameEng IS NOT NULL and consultantID = '{$ipid}'";
				} else {
				$query = "SELECT traineeID, traineeNameEng, fatherNameEng, genderEnglish, LanguageEnglish, maritalStatusEnglish, disabilityEnglish,
				provinceName, districtName, villageName, tradeName, contactAddressEng, contactPhoneNumber, contactEmail FROM traineeview4";
				}
				$result = $mysqli->query($query);	
				while($row = $result->fetch_array(MYSQLI_NUM))
				{ ?>
					
						<tr>
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
							<td><?php echo $row[13]; ?></td>
							
							<td>
								<a href="delete-trainee.php?id=<?php echo $row[0]; ?>" class="delete-trainee" traineeId="<?php echo $row[0]; ?>"><img src="images/delete.png" /></a>
								<a href="edit-trainee.php?id=<?php echo $row[0]; ?>"><img src="images/edit.png" /></a>
							</td>
							<td></td>
						</tr>
				<?php
				}
			?>
		</tbody>			
	</table>
	<br /> <br />
	<span style="float: right;"><button class="btn primary" id="btnAddNewTrainee">Add New</button></span>
	</div>
 </div>
</body>
</html>
