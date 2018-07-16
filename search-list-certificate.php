
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
					window.location.href = "search-list-certificate.php";
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
					"bLengthChange": false, //how many records to show per page. 
					"bFilter": false,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false,
					"bStateSave": true,
                   // "sPaginationType":"full_numbers",
					"aoColumnDefs": [
						{ "bVisible": false, "aTargets": [8] }
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
	
include("toolbar1-varification-certificate.php");
	
?>
  <div id="main">
	<div style="width: 90%; margin-TOP: 165px; margin-left: auto; margin-right: auto;">
		<h3>NSDP - Certificate Varification</h3>
	</div>
	<div style="width: 90%; margin-TOP: 15px; margin-left: auto; margin-right: auto; background-color:#FFF;" dir="rtl">
	  <h4>
	    <form id="form1" method="POST" action="search-list-certificate.php">
	    <input type="text" id="search" name="search" maxlength="8" />
	     Enter Code<span style="float: right;"><button class="btn success" id="btnAddNewProject">Search</button></form></span>
	  </h4>
      <?php $Search = (isset($_POST['search'])) ? $_POST['search'] : ""; ?>
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
				<th>Trainee</th>
				<th>Father Name</th>
                <th>Date</th>
			    <th>Certificate Code</th> 
				<th>Certificate</th>
				<th>Consultant Name</th>
                <th>View</th>
			</tr>
		</thead>		
		<tbody>
			<?php
				//$Search =$_GET['search'];
				
				//$_SESSION['search1']=$Search;
				//echo $Search;
				$query = "SELECT  traineeCertificate_ID, traineeNameEng, fatherNameEng, date, certificateCode, certificate, consultantName from NSDPTraineeCertificates where certificateCode = '$Search' ";
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
                       	
                        
						
                       
                        				
					  <td><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">View</button></td>
                      <td></td>
					</tr>							
				<?php
				}
				
			?>
		</tbody>
	</table>
	<br /> <br />
	
	</div>
	
 </div>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 40px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Certificate Detail</h4>
      </div>
      <div class="modal-body" >
        <?php
        
        
        $query = "SELECT  traineeCertificate_ID, traineeNameEng, fatherNameEng, date, certificateCode, certificate, consultantName,  projectName, 
        contactAddressEng, tradeName, districtName, villageName, provinceName,genderEnglish from NSDPTraineeModel where certificateCode = '$Search' ";
				$result = $mysqli->query($query);	
				while($row = $result->fetch_array(MYSQLI_NUM))
				{ ?>
                    <table class="table table-hover">
					<tr>
                        <td>Certificate ID</td>
						<td><?php echo $row[0]; ?></td>
                        <td>Consultant</td>
                        <td><?php echo $row[6]; ?></td>
                         
                       
                    </tr>
                    <tr>
                        <td>Trainee Name</td>
						<td><?php echo $row[1]; ?></td>
                        <td>Project Name</td>
                        <td><?php echo $row[7]; ?></td>
                         
                        
                    </tr>
                    <tr>
                        <td>Father Name</td>
						<td><?php echo $row[2]; ?></td>
                      
                        <td>Certificate</td>
						<td><?php echo $row[5]; ?></td>
                     </tr>
                    <tr>
                        <td>Gender</td>			
				        <td><?php echo $row[13]; ?></td>
                        <td>Print Date</td>
						<td><?php echo $row[3]; ?></td>
                        
                    </tr>
                    <tr>
                        <td>Certificate Code</td>
						<td><?php echo $row[4]; ?></td>
                        <td>Province</td>
                        <td><?php echo $row[12]; ?></td>
                        
                    </tr>
                    <tr>
                        <td>District</td>
                       	<td><?php echo $row[10]; ?></td>
                        <td>Village</td>
						<td><?php echo $row[11]; ?></td>
                    </tr>
                   
                     <tr>
                        <td>Contact Address</td>
					    <td><?php echo $row[8]; ?></td>
                        <td>Trade</td>
                        <td><?php echo $row[9]; ?></td>
                    </tr>
                   </table>						
				<?php
				}
                //ehco $row[3];
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
</body>
</html>
