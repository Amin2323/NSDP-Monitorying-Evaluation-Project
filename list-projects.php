
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
		
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>		
		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
		
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />
		<link rel="Stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css" />
		
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.1/media/css/jquery.dataTables.css" />
		
		<script type="text/javascript" src="js/DataTables-1.9.1/media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen" />

				
        <title>NSDP</title>
		<script type="text/javascript">
		
			$(document).ready(function () {
				$("#btnAddNewProject").click(function(){
					window.location.href = "add-project.php";
				});
				
				$(".delete-project").click(function(event){
					var r = confirm("Are you sure you want to delete this record?");
					if (r === true) {
						var target = $(event.target).parent();
						var projectId = $(target).attr("projectId");

						$.ajax({
							type: "GET",
							url: "delete-project.php?id=" + projectId,
							success: function(data) {
								$(target).parent().parent().fadeOut();
							},
							error: function(data) {
								alert("Error deleting project.");
							}						
						});					
					}	
				});
				
				$("#attendance").dataTable({
					"bPaginate": true,
					"bLengthChange": true, //how many records to show per page. 
					"bFilter": true,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false,
					"bStateSave": true,
					"aoColumnDefs": [
						{ "bVisible": false, "aTargets": [13] }
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
	<div style="width: 90%; margin-TOP: 160px; margin-left: auto; margin-right: auto;">
		<h3>National Skills Development Program - Projects</h3>
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

	<table id="attendance">
		<thead>
			<tr>
				<th>ID</th>
				<th>Donor</th>
				<th>Consultant</th>
				<th>Status</th>
				<th>Number</th>
				<th>Name</th>
				<th>Type</th>
				<th>Amount</th>
				<th>Currancy</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Remarks</th>
				<th></th>
			</tr>
		</thead>		
		<tbody>
			<?php
				$query = "SELECT  projectID, donorName, consultantName, statusEnglish, projectNo, projectName, prjTypeEnglish, projectAmount, prjCurrencyEnglish, contractDate, endOfContract, remarks FROM projectview";
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
						<td>
							<a href="#" class="delete-project" projectId="<?php echo $row[0]; ?>"><img src="images/delete.png" /></a>
							<a href="edit-project.php?id=<?php echo $row[0]; ?>"><img src="images/edit.png" /></a>
						</td>						
						<td></td>
					</tr>							
				<?php
				}
			?>
		</tbody>
	</table>
	<br /> <br />
	<span style="float: right;"><button class="btn primary" id="btnAddNewProject">Add New</button></span>
	</div>

 </div>
</body>
</html>
