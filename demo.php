<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Dialog - Modal form</title>
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
	<style>
		body { font-size: 62.5%; }
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
	</style>
	<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		var name = $( "#name" ),
			email = $( "#email" ),
			password = $( "#password" ),
			allFields = $( [] ).add( name ).add( email ).add( password ),
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 600,
			width: 350,
			modal: true,
			buttons: {
				"Create an account": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( name, "username", 3, 16 );
					bValid = bValid && checkLength( email, "email", 6, 80 );
					bValid = bValid && checkLength( password, "password", 5, 16 );

					bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
					bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

					if ( bValid ) {
						$( "#users tbody" ).append( "<tr>" +
							"<td>" + name.val() + "</td>" + 
							"<td>" + email.val() + "</td>" + 
							"<td>" + password.val() + "</td>" +
						"</tr>" ); 
						$( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-user1" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
	</script>
	<style type="text/css">
	.styled-button-10 {
	background:#0000FF;
	background:-moz-linear-gradient(top,#0000FF 0%,#0000FF 100%);
	background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#0000FF),color-stop(100%,#0000FF));
	background:-webkit-linear-gradient(top,#0000FF 0%,#0000FF 100%);
	background:-o-linear-gradient(top,#0000FF 0%,#0000FF 100%);
	background:-ms-linear-gradient(top,#0000FF 0%,#0000FF 100%);
	background:linear-gradient(top,#0000FF 0%,#0000FF 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0000FF',endColorstr='#0000FF',GradientType=0);
	padding:10px 15px;
	color:#fff;
	font-family:'Helvetica Neue',sans-serif;
	font-size:16px;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border:1px solid #459A00
}
</style>
</head>
<body>

<div class="demo">

<div id="dialog-form" title="Create new user">
	<p class="validateTips">All form fields are required.</p>

	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>


<button id="create-user" class="styled-button-101">Create new user</button>
<input type="submit"  id="create-user1" class="styled-button-10" value="Download" />

</div><!-- End demo -->




</body>
</html>
