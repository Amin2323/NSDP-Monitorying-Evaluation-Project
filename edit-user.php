
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
				
        <title>NSDP</title>
		
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
	<div style="width: 40%; margin-TOP: 160px; margin-left: auto; margin-right: auto;">
		<h3>Trainee-Contact-Person - Edit</h3>
	</div>	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<?php
		$mysqli = new mysqli("localhost", "root", "password", "medatabase");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
		
		$userId = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
		$username = null;
		$password = null;
		$role = null;
		$status = null;
		$project = null;
		//$add = null;
		//$projectID = null;
		
		$query = "SELECT idProjectUser, roleID, userName, pass, projectID  ,Status FROM tmislogin where userID = " . $userId;
		
		$result = $mysqli->query($query);	
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$role = $row[1];
			$userName = $row[2];
			$password = $row[3];	
			$project = $row[4];				
			$status = $row[5];
		} 
	?>	
	
	<form id="edit-trainee" action="update-user.php" method="POST">
		<input type="hidden" value="<?php echo $userId; ?>" id="userId" name="userId" />	
		<table>			
			<tr>			
				<td>Role</td>
				<td>
					<select id="role" name="role">
						<?php
						$query = "SELECT roleID, role from timsrole";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $role) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>	
			<tr>			
				<td>User Name</td>
				<td>
					<input type="text" id="uname" name="uname" value="<?php echo $userName; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>User Password</td>
				<td>
					<input type="password" id="pass" name="pass" value="<?php echo $password; ?>"/>
				</td>			
			</tr>
			<tr>			
				<td>Project</td>
				<td>
					<select id="project" name="project">
						<?php
						$query = "SELECT projectID, projectName from project";
						$result = $mysqli->query($query);	
						while($row = $result->fetch_array(MYSQLI_NUM)){?>
							<option value="<?php echo $row[0]; ?>" <?php echo ($row[0] == $project) ? "selected" : ""; ?>> <?php echo $row[1]; ?></option>
						<?php
						} 
						?>
				</td>			
			</tr>
			<tr>			
				<td>Status</td>
				<td>
				<?php 	echo $status;?>
				<?php if ($status==1){ ?>
						<input type="checkbox"  name="status" value="checked" checked><br> 
						
						<?php
						} else {
						?>
						<input type="checkbox"   name="status" value="0" ><br> 
						
						<?php 
						}
						?>
				</td>			
			</tr>
			
			<tr>			
				<td colspan="2">
					<input type="submit" value="Update Trainee" class="btn primary"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
	<?php
	include("includes/footer.php");
	?>
 </div>
</body>
</html>
