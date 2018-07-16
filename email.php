<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <script src="js/validation/main.js"></script>
  <script type="text/javascript" src="js/validation/jquery.validate.js"></script>
	<style type="text/css">
		* { font-family: Verdana; font-size: 96%; }
		label { width: 10em; float: left; }
		label.error { float: none; color: blue; padding-left: .5em; vertical-align: top; }
		p { clear: both; }
		.submit { margin-left: 12em; }
		em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>
  <script>
  $(document).ready(function(){
    $("#add-project").validate();
  });
  </script>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="js/underscore-1.3.3/underscore-min.js"></script>
		<script type="text/javascript" src="css/external/dropdown.js"></script>
				
       
</head>
<body>
  

 <form class="cmxform" id="commentForm" method="get" action="">
 <fieldset>
   <legend>A simple comment form with submit validation and default messages</legend>
   <p>
     <label for="cname">Name</label>
     <em>*</em><input id="cname" name="name" size="25" class="required" minlength="2" />
   </p>
   <p>
     <label for="cemail">E-Mail</label>
     <em>*</em><input id="cemail" name="email" size="25"  class="required email" />
   </p>
   <p>
     <label for="curl">URL</label>
     <em>  </em><input id="curl" name="url" size="25"  class="url" value="" />
   </p>
   <p>
     <label for="ccomment">Your comment</label>
     <em>*</em><textarea id="ccomment" name="comment" cols="22"  class="required"></textarea>
   </p>
   <p>
     <input class="submit" type="submit" value="Submit"/>
   </p>
 </fieldset>
 </form>
 <div id="main">
	<div style="width: 40%; margin-TOP: 130px; margin-left: auto; margin-right: auto;">
		<h3>Project - Add</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<form id="add-project" action="process11-add-project.php" method="POST">
		<table>			
			
			<tr>
				<td>Donor</td>
				<td>
				<select id="donor" name="donor">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT donorID, donorName from donor";
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
				<td>Consultant/IP</td>
				<td>
				<select id="ip" name="ip">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT consultantID, consultantName from consultant";
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
				<td>Project Number</td>
				<td>
					<input type="text" id="num" name="num" class="required" minlength="2" />
				</td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td>
					<input type="text" id="name" name="name" />
				</td>
			</tr>
			<tr>			
				<td>Project Amount</td>
				<td>
					<input name="amount" type="amount" />
				</td>	
			</tr>
				<tr>				
				<td>Currancy</td>
				<td>
				<select id="currancy" name="currancy">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT CurrencyID, prjCurrencyEnglish from tbl_currency";
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
				<td>Project Status</td>
				<td>
				<select id="status" name="status">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT projectstatusID, statusEnglish from tblkprojstatus";
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
				<td>Project Type</td>
				<td>
				<select id="type" name="type">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT prjtypeID, prjTypeEnglish from tbl_projecttype";
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
				<td>Start Date</td>
				<td>
					<input type="text" id="eventStartDate" name="eventStartDate" />
				</td>			
			</tr>
			<tr>
				<td>End Date</td>
				<td>
					<input type="text" id="eventEndDate" name="eventEndDate" />
				</td>			
			</tr>
			<tr>			
				<td>Remarks</td>
				<td>
					<input name="remarks" type="remarks" />
				</td>	
			</tr>
		
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			<tr>
				
			</tr>
			
			<tr>			
				
			</tr>
			<tr>			
						
			</tr>
			<tr>			
				<td colspan="2">
					<input type="submit" value="Add Trainee" class="btn primary" id="btn-add"/>
				</td>			
			</tr>			
		</table>			
	</form>
	</div>
 </div>
</body>
</html>