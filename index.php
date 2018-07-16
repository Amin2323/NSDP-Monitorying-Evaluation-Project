
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
		
</head>
<body>
<?php
	include("Maintoolbar.php");
?>

  
 
 <br /><br /><br /><br />
	
	<script type="text/javascript">
	document.getElementById("username").focus();
	</script>
	
	<?php require_once("includes/session.php"); ?>
	<?php require_once("includes/connection.php"); ?>
	<?php require_once("includes/functions.php"); ?>
<?php
	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		
		if ( empty($errors) ) {
			// Check database to see if username and the hashed password exist there.
			$query = "SELECT roleID, role, userID, userName, pass, status, consultantID, projectID ";
			$query .= "FROM tmislogin1 ";
			$query .= "WHERE userName = '{$username}' ";
			$query .= "AND pass= '{$hashed_password}' ";
			$query .= "AND status= 1 ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['role']=$found_user['roleID'];
				$_SESSION['user']=$found_user['userName'];
				$_SESSION['userID']=$found_user['userID'];
				$_SESSION['ipID']=$found_user['consultantID'];
				$_SESSION['projectID']=$found_user['projectID'];
				$_SESSION['status'] = $found_user['status'];
				redirect_to("index1.php");
			} else {
				// username/password combo was not found in the database
				$message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.<br />
					Or your user Has Expired";
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
	} else { // Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out.";
		} 
		$username = "";
		$password = "";
	}
?>
	
	<div class="login-wrapper" style="width: 40%; margin-TOP: 160px; margin-left: auto; margin-right: auto;" >
	
	 <td style="text-align: center;; border: none;">
			<a href="http://www.nsdp.gov.af/"><img src="images/NSDP.jpg"  alt="Computer man" width="190" height="60" /></a>					
		</td>
		<td id="page" align="left">
		
			<h2>Staff Login</h2>
			<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			
			<form action="index.php" method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Sign In" style="float: right;" class="btn primary" /></td>
				</tr> 
			</table>
			<h4><a href="search-list-certificate.php">Certificate Varification</a></h4>
			</form>
	
</div>
<div style="margin-TOP: 270px">
<?php
	//include("includes/footer.php");
?>
</div>
</body>
</html>
