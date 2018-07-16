
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
				
        <title>NSDP Trainees</title>
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
		<link href="libs/bootstrap-1.3.0/bootstrap.min.css" rel="stylesheet">
		<link href="app/app.css" rel="stylesheet">
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
  
 
 <br /><br /><br /><br />
	
	<script type="text/javascript">
	document.getElementById("username").focus();
	</script>
	<?php require_once("includes/connection.php"); ?>
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
	
	
<div class="login-wrapper" style="width: 40%; margin-TOP: 160px; margin-left: auto; margin-right: auto;">
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
</body>
</html>
