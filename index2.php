
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="js/jquery-1.6.4/jquery-min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>		
		
		<link rel="stylesheet" type="text/css" href="css/external/app.css" media="screen" />
		<script type="text/javascript" src="css/external/dropdown.js"></script>
		
		<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />
		<link rel="Stylesheet" type="text/css" href="js/jquery-ui-1.8.16.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css" />
		
		<link rel="Stylesheet" type="text/css" href="js/DataTables-1.9.4/media/css/jquery.dataTables.css" />
		
		<script type="text/javascript" src="js/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen" />

				
        <title>National Skills Development Program</title>
		<script type="text/javascript">
		
			$(document).ready(function () {
				
				
				$("#trainee").dataTable({
					
					"bPaginate": true,
					"bLengthChange": true, //how many records to show per page. 
					"bFilter": true,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false,
					"bStateSave": true,
					"sPaginationType":"full_numbers",
					"bJQueryUI":true,
					
					"aoColumnDefs": [
						{ "bVisible": false, "aTargets": [16] }
					],					
					"fnStateSave": function (oSettings, oData) {
						localStorage.setItem( 'DataTables_' + window.location.pathname, JSON.stringify(oData) );
					},
					"fnStateLoad": function (oSettings) {
						return JSON.parse(localStorage.getItem('DataTables_' + window.location.pathname));
					}
					
					});
			});
			$(document).ready(function() {
					/* Initialise datatables */
					var oTable = $('#trainee').dataTable();
					 
					/* Add event listeners to the two range filtering inputs */
					$('#min').keyup( function() { oTable.fnDraw(); } );
					$('#max').keyup( function() { oTable.fnDraw(); } );
				} );
				$.fn.dataTableExt.afnFiltering.push(
						function( oSettings, aData, iDataIndex ) {
						var iMin = document.getElementById('min').value * 1;
						var iMax = document.getElementById('max').value * 1;
						var iVersion = aData[10] == "-" ? 0 : aData[10]*1;
						if ( iMin == "" && iMax == "" )
						{
							return true;
							}
						else if ( iMin == "" && iVersion < iMax )
							{
								return true;
								}
						else if ( iMin < iVersion && "" == iMax )
							{
								return true;
								}
								else if ( iMin < iVersion && iVersion < iMax )
								{
									return true;
								}
								return false;
							}
						)
			$.fn.dataTableExt.oApi.fnGetColumnData = function ( oSettings, iColumn, bUnique, bFiltered, bIgnoreEmpty ) {
    // check that we have a column id
    if ( typeof iColumn == "2" ) return new Array();
     
    // by default we only want unique data
    if ( typeof bUnique == "3" ) bUnique = true;
     
    // by default we do want to only look at filtered data
    if ( typeof bFiltered == "4" ) bFiltered = true;
     
    // by default we do not want to include empty values
    if ( typeof bIgnoreEmpty == "5" ) bIgnoreEmpty = true;
     
    // list of rows which we're going to loop through
    var aiRows;
     
    // use only filtered rows
    if (bFiltered == true) aiRows = oSettings.aiDisplay;
    // use all rows
    else aiRows = oSettings.aiDisplayMaster; // all row numbers
 
    // set up data array   
    var asResultData = new Array();
     
    for (var i=0,c=aiRows.length; i<c; i++) {
        iRow = aiRows[i];
        var aData = this.fnGetData(iRow);
        var sValue = aData[iColumn];
         
        // ignore empty values?
        if (bIgnoreEmpty == true && sValue.length == 0) continue;
 
        // ignore unique values?
        else if (bUnique == true && jQuery.inArray(sValue, asResultData) > -1) continue;
         
        // else push the value onto the result data array
        else asResultData.push(sValue);
    }
     
    return asResultData;
}}(jQuery));
 
 
function fnCreateSelect( aData )
{
    var r='<select><option value=""></option>', i, iLen=aData.length;
    for ( i=0 ; i<iLen ; i++ )
    {
        r += '<option value="'+aData[i]+'">'+aData[i]+'</option>';
    }
    return r+'</select>';
}
    $(document).ready(function() {
    /* Initialise the DataTable */
    var oTable = $('#trainee').dataTable( {
        "oLanguage": {
            "sSearch": "Search all columns:"
        }
    } );
     
    /* Add a select menu for each TH element in the table footer */
    $("tfoot th").each( function ( i ) {
        this.innerHTML = fnCreateSelect( oTable.fnGetColumnData(i) );
        $('select', this).change( function () {
            oTable.fnFilter( $(this).val(), i );
        } );
    } );
} );
		</script>
</head>
<body>
<?php require_once("includes/session.php"); ?>
<?php 
		$roleID = $_SESSION['role'];
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
	//include("toolbar.php");
?>
  <div id="main">
	<div style="width: 90%; margin-TOP: 180px; margin-left: auto; margin-right: auto;">
		<h3>National Skills Development Program - Trainee Summary List </h3>
	</div>
	
	<div style="width: 90%; margin-TOP: 5px; margin-left: auto; margin-right: auto;">
	<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	
	?>
	<table>
	<tr>
		<td>Minimum Age</td>
		<td><input type="text" id="min"></td>
	</tr>
	<tr>
		<td>Maximum Age</td>
		<td><input type="text" id="max"></td>
	</tr>
	</table
	</br>
	
	<span style="float: right;"><a href="export-index1.php" class="btn">Export to Excel</a></span>
	<table id="trainee">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Project Name</th>
				<th>Trade</th>
				<th>Province</th>
				<th>District</th>
				<th>Center</th>
				<th>Training Type</th>
				<th>Literacy</th>
				<th>Age</th>
				<th>Language</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Consultant</th>
				<th>Check</th>
				<th></th>
			</tr>
		</thead>		
		<tbody>
			<?php
				$userID = $_SESSION['userID'];
				$userName1 = $_SESSION['user'];
				$ipid = $_SESSION['ipID'];
				echo $userName1;
			    if($roleID != "1"){
				$query = "SELECT traineeID, traineeNameEng, fatherNameEng, ProjectName, tradeName, provinceName, districtName, centreName, TrainingTypeEnglish,
				literacyEnglish, traineeAge, languageEnglish, trainingStartDate, trainingEndDate,consultantName  FROM Index2 where consultantID = '$ipid'";
				}else {
				$query = "SELECT traineeID, traineeNameEng, fatherNameEng, ProjectName, tradeName, provinceName, districtName, centreName, TrainingTypeEnglish,
				literacyEnglish, traineeAge, languageEnglish, trainingStartDate, trainingEndDate,consultantName  FROM Index2";
				}
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
						<td><?php echo $row[9]; ?></td>
						<td><?php echo $row[10]; ?></td>
						<td><?php echo $row[11]; ?></td>
						<td><?php echo $row[12]; ?></td>
						<td><?php echo $row[13]; ?></td>
						<td><?php echo $row[14]; ?></td>
						<td><input type="checkbox" id=1></td>
												
						<td></td>
					</tr>							
				<?php
				}
			?>
		</tbody>
	</table>
	
	</div>

 </div>
</body>
</html>
