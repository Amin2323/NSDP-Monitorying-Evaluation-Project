 
<?php require_once("includes/session.php"); ?>

 
	  <?php 
	if(!$_SESSION['roleID']=1){
				include("toolbar.php");
		} else {
				include("Non-toolbar.php");
			}
			?>
	