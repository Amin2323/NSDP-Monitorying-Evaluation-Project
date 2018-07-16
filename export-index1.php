<?php
	$mysqli = new mysqli("localhost", "root", "password", "medatabase");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	/*
	$query = "SELECT * FROM v_attendance order by id;";
	
	$result = $mysqli->query($query) or die('Query failed!');
	
	while($row = $result->fetch_array(MYSQLI_NUM)) {
	//while($q = mysql_fetch_assoc($result)){
		$output[] = $row;
	}
	require_once "excel.php";
	$export_file = "xlsfile://export.xls";
	$fp = fopen($export_file, "wb");
	if (!is_resource($fp))
	{
		die("Cannot open $export_file");
	}
	fwrite($fp, serialize($output));
	fclose($fp);
	header ("Content-Type: application/x-msexcel");
	header ("Content-Disposition: attachment; filename=\"exports.xls\"" );
	readfile("xlsfile://export.xls");
	exit;	
		
		
		
*/	
  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "Trainee-Data_" . date('Ymd') . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");
				
				
  $flag = false;
  $result = $mysqli->query("select column_name from information_schema.columns where table_name = 'Index2' and column_name in (
	'traineeID', 
	'traineeNameEng', 
	'fatherNameEng', 
	'ProjectName', 
	'tradeName', 
	'provinceName', 
	'districtName', 
	'centreName', 
	'TrainingTypeEnglish',
	'literacyEnglish', 
	'traineeAge', 
	'languageEnglish', 
	'trainingStartDate', 
	'trainingEndDate',
	'consultantName'
  ) order by column_name;");

  while($row = $result->fetch_array(MYSQLI_NUM)) {
	echo $row[0]."\t";
  }
  
  
  
  echo "\r";
  $result = $mysqli->query("SELECT centreName,consultantName,districtName,fatherNameEng,languageEnglish,literacyEnglish,projectName,provinceName,tradeName,traineeAge,traineeID,traineeNameEng,trainingEndDate,trainingStartDate,trainingTypeEnglish  FROM Index2") or die('Query failed!');	
  

  while($row = $result->fetch_array(MYSQLI_NUM)) {
  
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
	
  }
 
  exit;

?>
	
