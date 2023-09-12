
<?php
	include('../functions/phpfunctions.php');
	$productname = $_POST['productname'];
	$query = "SELECT DISTINCT shortformat, productinuse FROM ssm_products WHERE slno = '".$productname."' ORDER BY productname";
	$fetch = runmysqlqueryfetch($query);
	echo('<input name="shortformat" type="text" class="swifttext" id="shortformat" size="30" readonly  style="background:#FEFFE6;" autocomplete = "off" value ="'.$fetch['shortformat'].'" />');
	echo('|^^|');
	echo('<input name="productinuse" type="text" class="swifttext" id="productinuse" size="30" readonly   style="background:#FEFFE6;" autocomplete = "off" value ="'.$fetch['productinuse'].'" />');
?>