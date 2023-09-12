<?php

$link = mysqli_pconnect("test-db.vinylfox.com", "test", "testuser") or die("Could not connect");
mysqli_select_db("test") or die("Could not select database");

$sql_count = "SELECT id, name, title, hire_date, active FROM random_employee_data";
$sql = $sql_count . " LIMIT ".$_GET['start'].", ".$_GET['limit'];

$rs_count = mysqli_query($sql_count);

$rows = mysqli_num_rows($rs_count);

$rs = mysqli_query($sql);

while($obj = mysqli_fetch_object($rs))
{
	$arr[] = $obj;
}

Echo $_GET['callback'].'({"total":"'.$rows.'","results":'.json_encode($arr).'})'; 

?>
