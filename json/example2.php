<?php
include('../functions/phpfunctions.php');

$arr = array();
$rs = runmysqlquery("SELECT customername, customerid FROM ssm_callregister");
 
while($obj = mysqli_fetch_object($rs)) {
	$arr[] = $obj;
}
 
echo '{"sample":'.json_encode($arr).'}';
?>
