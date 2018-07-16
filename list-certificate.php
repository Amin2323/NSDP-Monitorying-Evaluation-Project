
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
		
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
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
					window.location.href = "add-certificate.php";
				});
				
				$(".delete-project").click(function(event){
					var r = confirm("Are you sure you want to delete this record?");
					if (r === true) {
						var target = $(event.target).parent();
						var projectId = $(target).attr("CertificateId");

						$.ajax({
							type: "GET",
							url: "delete-certificate.php?id=" + projectId,
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
                    "sPaginationType":"full_numbers",
					"aoColumnDefs": [
						{ "bVisible": false, "aTargets": [10] }
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
		} elseif($_SESSION['user']=='nsdp') {
				include("toolbar1-certificate.php");
			}else{
			     include("Non-toolbar1.php");
			}
	//include("toolbar.php");
?>
  <div id="main">
	<div style="width: 90%; margin-TOP: 165px; margin-left: auto; margin-right: auto;">
		<h3>Trainee - Certificate - List</h3>
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
				<th>Name</th>
				<th>Father Name</th>
                <th>Print Date</th>
			    <th>Reg #</th> 
				<th>Certificate Type</th>
				<th>Consultant Name</th>
                <th>File Name</th>
				<th>Download</th>
				<th>Edit/Delete</th>
			</tr>
		</thead>		
		<tbody>
			<?php
				$query = "SELECT  traineeCertificate_ID, traineeNameEng, fatherNameEng, date, certificateCode, certificate, consultantName, fileName, path from NSDPTraineeCertificates";
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
                        <?php $FileName=$row[7]; ?>
                        <td><a href='image/<?php echo $row[7]; ?>' download> <?php echo $row[7]; ?> </a></td>
					    
						<td>
							<a href="#" class="delete-project" CertificateId="<?php echo $row[0]; ?>"><img src="images/delete.png" /></a>
							<a href="edit-certificate.php?id=<?php echo $row[0]; ?>"><img src="images/edit.png" /></a>
						</td>
                        <input type="hidden" value="$row[7]" id="filename" name="filename" />						
						<td></td>
					</tr>							
				<?php
				}
			?>
		</tbody>
	</table>
	<br /> <br />
	<span style="float: right;"><button class="btn primary" id="btnAddNewProject">Add New Certificate</button></span>
	</div>

 </div>
</body>
</html>
