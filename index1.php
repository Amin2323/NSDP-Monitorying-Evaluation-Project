
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
		
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.4/media/css/jquery.dataTables.css" />
		
		<script type="text/javascript" src="js/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen" />

				
        <title>National Skills Development Program</title>
		<script type="text/javascript">
		
			$(document).ready(function () {
				
				
				$("#trainee").dataTable({
					
					"bPaginate": true,
					"bLengthChange": true, //how many records to show per page. 
					"bFilter": true,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false,
					"bStateSave": true,
					"sPaginationType":"full_numbers",
					
					
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
</head>
<body>
<?php require_once("includes/session.php"); ?>
<?php 
		$roleID = $_SESSION['role'];
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
	<div style="width: 90%; margin-TOP: 180px; margin-left: auto; margin-right: auto;">
		<h3>National Skills Development Program - Trainee Summary List </h3>
	</div>
	
	<div style="width: 90%; margin-TOP: 5px; margin-left: auto; margin-right: auto;">
	<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	?>
	
	<span style="float: right;"><a href="export-index1.php" class="btn">Export to Excel</a></span>
	<table id="trainee">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Project Name</th>
				<th>Trade</th>
				<th>Province</th>
				<th>District</th>
				<th>Center</th>
				<th>Training Type</th>
				<th>Literacy</th>
				<th>Age</th>
				<th>Language</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Consultant</th>
				
				<th></th>
			</tr>
		</thead>		
		<tbody>
			<?php
				$userID = $_SESSION['userID'];
				$userName1 = $_SESSION['user'];
				$statuse = $_SESSION['status'];
				$ipid = $_SESSION['ipID'];
				//echo $userName1;
				echo $statuse;
			    if($roleID != "1"){
				$query = "SELECT traineeID, traineeNameEng, fatherNameEng, ProjectName, tradeName, provinceName, districtName, centreName, TrainingTypeEnglish,
				literacyEnglish, traineeAge, languageEnglish, trainingStartDate, trainingEndDate,consultantName  FROM Index2 where consultantID = '$ipid'";
				}else {
				$query = "SELECT traineeID, traineeNameEng, fatherNameEng, ProjectName, tradeName, provinceName, districtName, centreName, TrainingTypeEnglish,
				literacyEnglish, traineeAge, languageEnglish, trainingStartDate, trainingEndDate,consultantName  FROM Index2";
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
						<td><?php echo $row[14]; ?></td>
						
												
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
