
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/DataTables-1.9.4/media/js/jquery.js"></script>		
		<script type="text/javascript" src="js/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="js/DataTables-1.9.4/TableTools-2.1.5/media/js/TableTools.js"></script>
		<script type="text/javascript" src="js/DataTables-1.9.4/TableTools-2.1.5/media/js/ZeroClipboard.js"></script>
		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>

		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen" />
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.4/media/css/jquery.dataTables.css" />
				
        <title>National Skills Development Program</title>
		<script type="text/javascript">
		
			$(document).ready(function () {
				$("#trainee").dataTable({
					"sDom": '<"H"Tfr>t<"F"ip>',
					"oTableTools": {
						"aButtons": [
							"copy", "csv", "xls", "pdf"
						]
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

	<table id="trainee">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Project Name</th>
				<th>Trade</th>
				<th>Province</th>
				<th></th>
			</tr>
		</thead>		
		<tbody>
			<?php
				$userID = $_SESSION['userID'];
				$userName1 = $_SESSION['user'];
				$ipid = $_SESSION['ipID'];
				echo $userName1;
			    if($roleID != "1"){
				$query = "SELECT traineeID, traineeNameEng, fatherNameEng, ProjectName, tradeName, provinceName, districtName, centreName, TrainingTypeEnglish,
				literacyEnglish, traineeAge, languageEnglish, trainingStartDate, trainingEndDate,consultantName  FROM Index2 where consultantID = '$ipid'";
				} else {
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
