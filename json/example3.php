<?php
include('../functions/phpfunctions.php');

include_once('JSON.php');
$json = new Services_JSON();
 
 
$arr = array();
$rs = runmysqlquery("SELECT customername, customerid FROM ssm_callregister");
 
while($obj = mysqli_fetch_object($rs)) {
	$arr[] = $obj;
}
 
echo '{"sample":'.$json->encode($arr).'}';

?>