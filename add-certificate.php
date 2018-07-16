
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
		<script type="text/javascript">
			$(document).ready(function () {
			$('#consultant').change(function(){
					$.getJSON("getProject.php?Id=" + $(this).val(), function(json) {
						$("#project").empty();
						_.each(json.projects, function(project){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#project").append("<option value=" + project.id + ">" + project.name + "</option>");
						});
					});
				});
				$('#project').change(function(){
					$.getJSON("getTraineet.php?Id=" + $(this).val(), function(json) {
						$("#Trainee").empty();
						_.each(json.trainees, function(Trainee){
							//console.log("District Id: " + district.id + ", District Name: " + district.name);
							$("#Trainee").append("<option value=" + Trainee.id + ">" + Trainee.name + "</option>");
						});
					});
				});
			
		
				$("#btn-add").click(function(e){
					var consultant = $("#consultant").val();
					//var matcht = /^[A-Z a-z]+$/;
					var project = $("#project").val();
				//	var matchtf = /^[A-Z a-z]+$/;
					var trainee = $("#Trainee").val();
					var ctype = $("#ctype").val();
					var eventStartDate = $("#eventStartDate").val();
					var file = $("#file").val();
				//	var contact = $("#contact").val();
				//	var statusId = $("#status").val();
				//	var distabilityId = $("#distability").val();
				//	var pattern = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
				//	var email = $("#email").val();
				//	var phone = $("#phone").val(); 
				//	var matchp =/^\d{10}$/; 
					
					var errorMessage = [];
					
					if(consultant == 0){
						errorMessage.push("Please Select consultant.");
					}
                    //else if(!(matcht.test(traineeName))){
					//	errorMessage.push("Please Insert only Text for Trainee Name.");
					//}
					
					if(project == 0){
						errorMessage.push("Please Select Project.");
					}
                    //else if(!(matchtf.test(traineefName))){
						//errorMessage.push("Please Insert only Text for Trainee Father Name.");
					//}
					
					if(trainee == 0){
						errorMessage.push("Please Select Trainee.");
					}
					
					if(ctype == 0){
						errorMessage.push("Project Select Certificate Type.");
					}	
					if(eventStartDate == 0){
						errorMessage.push("Please Insert A Date.");
					}
					if(file == 0){
						errorMessage.push("Please select a File for uploading. ");
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
	   	<script type="text/javascript">
			
			$(document).ready(function(){
				$("#eventStartDate").datepicker({dateFormat: 'yy-mm-dd'});
				//$("#eventEndDate").datepicker({dateFormat: 'yy-mm-dd'});
				});
			
			
        </script>


</head>
<body>
<?php require_once("includes/session.php"); ?>
<?php 
	$userID =$_SESSION['userID'];
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
	<div style="width: 40%; margin-TOP: 180px; margin-left: auto; margin-right: auto;">
		<h3>Trainee - Certificate - Information</h3>
	</div>
	
	<div style="width: 40%; margin-TOP: 10px; margin-left: auto; margin-right: auto;">
	<div id="div-error" class="alert alert-error" style="display: none;"></div>
	<form id="add-trainee" action="process-add-certificate.php" method="POST" enctype="multipart/form-data">
		<table>			
			
                <tr>
				<td>Consultant</td>
				<td>
				<select id="consultant" name="consultant">
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
                
				<td>Project</td>
				<td>
				<select id="project" name="project">
                    	<option value="0">Please select</option>
				</select>
					
				</td>
			</tr>
            <tr>
				<td>Trainee</td>
				<td>
				<select id="Trainee" name="Trainee">
                    	<option value="0">Please select</option>
				</select>
					
				</td>
			</tr>
            	<tr>
				<td>Certificate Type</td>
				<td>
				<select id="ctype" name="ctype">
					<option value="0">Please select</option>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}	
						
						$query = "SELECT certificatetype_id, certificate from zcertificatetype";
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
				<td>Certificate Code</td>
				<td>
                    <?php
                        $mysqli = new mysqli("localhost", "root", "password", "medatabase");
						/* check connection */
						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
      	                 }
                            $query = "SELECT Max(certificateCode) from traineecertificate";
	                        $result = $mysqli->query($query);
                            
                            //$max=$result->fetch_array(MYSQLI_NUM);
                           // echo $reslut;
						
                        	while($row = $result->fetch_array(MYSQLI_NUM))
        						{ 
        						 
        						  $row[0]++;
                                  ?>
        							
                                    <input type="text" name="ccode" value="<?php echo $row[0]; ?>" readonly="True" >
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
               
			
                
		<!--

                <tr>
				<td>Department</td>
								<td>
									<select id="department" name="department">
										<option value="0">Please Select</option>
										<?php
										$mysqli = new mysqli("localhost", "root", "password", "medatabase");
										/* check connection */
										if (mysqli_connect_errno()) {
											printf("Connect failed: %s\n", mysqli_connect_error());
											exit();
										}	
										//$query = "SELECT projectID, projectName from project ";
                                       // if($_SESSION['role']==1){
										  $query = "SELECT Department_id, Department from zdepartment";
                                        //}
                                        //else
                                        //{
                                       	  //  $query = "SELECT projectID, projectName from tmislogin where userID = '$userID'";
                                        //}
                                        
										$result = $mysqli->query($query);	
										while($row = $result->fetch_array(MYSQLI_NUM))
										{ ?>
											<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
										<?php
										}
										?>
									</select> 				
								</td>				
					
			</tr>
-->
			<tr>
                <td>Upload Certificate</td>
                <td><input type="file" name="file" size="50" /></td>
            </tr>
		
              <tr align="center">			
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
