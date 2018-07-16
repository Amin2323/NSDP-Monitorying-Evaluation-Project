
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
		<script type="text/javascript" src="js/underscore-1.3.3/underscore-min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />
		<link rel="Stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css" />
		
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.1/media/css/jquery.dataTables.css" />
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.4/media/css/jquery.dataTables.css" />
		<script type="text/javascript" src="js/DataTables-1.9.1/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen" />
		<link rel="stylesheet" href="js/jquery-ui-1.8.16.custom/development-bundle/themes/base/jquery.ui.all.css">
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/jquery-1.6.2.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.button.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.resizable.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.ui.dialog.js"></script>
	<script src="js/jquery-ui-1.8.16.custom/development-bundle/ui/jquery.effects.core.js"></script>
		 <script type="text/javascript">
			$(document).ready(function () {
				$("#btn-add").click(function(e){
					var userName = $("#username").val();
					//var matcht = /^[A-Z a-z]+$/;
					var password = $("#password").val();
					//var matchtf = /^[A-Z a-z]+$/;
					var project = $("#project").val();
					var role = $("#Role").val();
					
					
					var errorMessage = [];
					
					if(userName == 0){
						errorMessage.push("Please insert User Name.");
					}
										
					if(password == 0){
						errorMessage.push("Please Insert Password.");
					}
					
					
					if(project == 0){
						errorMessage.push("Please Select Project.");
					}
					
					if(role == 0){
						errorMessage.push("Please Select Role for the User.");
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
			 <style type="text/css">
  
		.login-wrapper {
		width: 400px;
		background-color: #F9F9F9;
		border-radius: 15px;	
		margin-left: auto;
		margin-right: auto;
		padding: 20px;
		border: 1px solid #f9f9f9;
		border-bottom: 1px solid #a3a3a3;
		-webkit-box-shadow: 0px 1px 9px rgba(96, 50, 50, 0.7);
		-moz-box-shadow:    0px 1px 9px rgba(96, 50, 50, 0.7);
		box-shadow:         0px 1px 9px rgba(96, 50, 50, 0.7);		
		font-family: arial; 
	}
  </style>

	
		
			
		<script type="text/javascript">
		
			$(document).ready(function () {
				$("#btnAddNewTrainee").click(function(){
					window.location.href = "add-user.php";
				});
				
				$(".delete-trainee").click(function(event){
					var r = confirm("Are you sure you want to delete this record?");
					if (r === true) {
						var target = $(event.target).parent();
						var traineeId = $(target).attr("userid");

						$.ajax({
							type: "GET",
							url: "delete-user.php?id=" + traineeId,
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
					"sPaginationType":"full_numbers",
					// "bJQueryUI": true,
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
		} );
		
		</script>	
        <title>NSDP</title>
		<script type="text/javascript">
			$(document).ready(function () {
				$("#accordion-android").accordion({animated: 'bounceslide', collapsible: true});
			}); 
		</script>
</head>
<body>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php


		if($_SESSION['role']==1){
				include("toolbar1.php");
		} else {
				include("Non-toolbar1.php");
		}

	//include("toolbar.php");
	
?>

  <div id="main">
	<div style="width: 90%; margin-TOP: 150px; margin-left: auto; margin-right: auto;">
		<h3>NSDP</h3>
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
				<th>User Detail ID</th>
				<th>Role ID</th>
				<th>Role Name</th>
				<th>User ID</th>
				<th>User Name</th>
				<th>Password</th>
				<th>Project ID</th>
				<th>Project Name</th>
				<th>User Status</th>
				<th>Edit/Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = "SELECT idProjectUser, roleID,  role, userID, userName, pass, projectID, projectName  ,Status FROM tmislogin1";
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
							<td>
								<a href="delete-user.php?id=<?php echo $row[3]; ?>" class="delete-trainee" userid="<?php echo $row[3]; ?>"><img src="images/delete.png" /></a>
								<a href="edit-user.php?id=<?php echo $row[3]; ?>"><img src="images/edit.png" /></a>
							</td>
							<td></td>
						</tr>
					<?php
					$_SESSION['userDetailId']=$row[0];
				}
			?>
		</tbody>			
	</table>
	<br /> <br />
	<span style="float: right;"><button class="btn primary" id="btnAddNewTrainee">Add New</button></span>
	</div>
	<a href="#myModal" role="button" class="btn primary" data-toggle="modal" style="float: right;">Add New Trainers</a>
	 
	<!-- Modal -->
	<div id="myModal" style="width: 700px height: 600px;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
	<h3 id="myModalLabel">NSDP Trainer Insertion</h3>
	</div>
	<div class="modal-body">
		<div id="div-error" style="display: none;"></div>
			<div style="height: 400px; overflow:scroll;">
				<?php require_once("includes/functions.php"); ?>
<?php
	include_once("includes/form_functions.php");
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 10, 'password' => 10);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$role     = trim(mysql_prep($_POST['Role']));
		$hashed_password = sha1($password);
		//$project  = trim(mysql_prep($_POST['project']));

		if ( empty($errors) ) {
			$query = "INSERT INTO timsuser (
							userName, pass, roleID, status
						) VALUES (
							'{$username}', '{$hashed_password}','{$role}',1
						)";
			$result = mysql_query($query, $connection);
			echo $query;
			if ($result) {
				$message = "The user was successfully created.";
			} else {
				$message = "The user could not be created.";
				$message .= "<br />" . mysql_error();
			}
			// $query = "Select MAX(userID) from timsuser";
						// $result = $mysqli->query($query);	
						// while($row = $result->fetch_array(MYSQLI_NUM))
						// {
							 // $userID= $row[0]; 
							// $_SESSION['userID']= $userID;
							// echo $_SESSION['userID'];
						// }
						// if(!isset($_SESSION['userID'])){
						// header("Location: index.php");
							// } else {
							// $userId= $_SESSION['userID'];
							// $query = "INSERT INTO projectuser (UserID,ProjectID ) VALUES ('$userId', '$project')";
							// $result = $mysqli->query($query);
							// echo $query;
					// //echo $query;
			// }
			//$query ="insert into projectusers (projectID, UserID) VALUES (
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
	} else { // Form has not been submitted.
		$username = "";
		$password = "";
	}
?>
	
	
<div class="login-wrapper" style="width: 80%; margin-TOP: 30px; margin-left: auto; margin-right: auto;">
<div id="div-error" style="display: none;"></div>
<table id="structure">
	
		
		<td id="page">
			<h2>Create New User</h2>
			<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			<form action="add-user.php" method="post">
			<table>
			
			<tr>
				<td>User Type</td>
				<td>
				<select id="Role" name="Role">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT RoleID, role from timsrole";
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
					<td>Username:</td>
					<td><input type="text" name="username" id="username" maxlength="30" value="<?php echo htmlentities($username); ?>" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" id="password" maxlength="30" value="<?php echo htmlentities($password); ?>" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" id="btn-add" value="Create user" style="float: right;" class="btn primary" /></td>
				</tr>
			</table>
			</form>
		</td>
	
</table>
</div>

			</div>
		</div>
		<div class="modal-footer">
		<button class="btn primary" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn primary" >Save New Record</button>
		<input type="submit" value="Add Training1" class="btn primary" id="btnAdd-Trainer"/>
		</div>
			</div>	
		</div>
	 </div>
	<?php
	include("includes/footer.php");
?>
 </div>
</body>
</html>
