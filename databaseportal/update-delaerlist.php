<?php
include('../functions/phpfunctions.php');
$resultset = '';
$olddealername = $_POST['olddealername'];
$newdealername = $_POST['newdealername'];
$newdealerid = $_POST['newdealerid'];
$newdealercategory = $_POST['newdealercategory'];
$newdealercallertype = $_POST['newdealercallertype'];
$message = '';
if ($olddealername <> '' && $newdealername <> '' && $newdealerid <> '' && $newdealercategory <> '' && $newdealercallertype <> '') {
	$message = '';
	$query = "(select  count(*) as count, 'aa' as dummy  from ssm_callregister where customername = '" . $olddealername . "') union all 
(select  count(*) as count, 'aa' as dummy  from ssm_emailregister where customername = '" . $olddealername . "')  union all  
(select  count(*) as count, 'aa' as dummy  from ssm_errorregister where customername = '" . $olddealername . "')  union all  
(select  count(*) as count, 'aa' as dummy  from ssm_inhouseregister where customername = '" . $olddealername . "')  union all  
(select  count(*) as count, 'aa' as dummy  from ssm_referenceregister where customername = '" . $olddealername . "')  union all  
(select  count(*) as count, 'aa' as dummy  from ssm_requirementregister where customername = '" . $olddealername . "')  union all  
(select  count(*) as count, 'aa' as dummy  from ssm_skyperegister where customername = '" . $olddealername . "'); ";
	$result = runmysqlquery($query);
	//$fetch = runmysqlqueryfetch($result);
	//echo($fetch['count'].$fetch['dummy']);
	while ($fetch = mysqli_fetch_row($result)) {
		for ($i = 0; $i < count($fetch); $i++) {
			$resultset .= $fetch[$i];
		}
	}
	$fetchedresult = explode('aa', $resultset);
	if ($fetchedresult[0] > 0) {
		$query = "UPDATE ssm_callregister SET customername = '" . $newdealername . "', customerid = '" . $newdealerid . "', category = '" . $newdealercategory . "', callertype = '" . $newdealercallertype . "' WHERE customername = '" . $olddealername . "'";
		$result = runmysqlquery($query);
	}
	if ($fetchedresult[1] > 0) {
		$query = "UPDATE ssm_emailregister SET customername = '" . $newdealername . "', customerid = '" . $newdealerid . "', category = '" . $newdealercategory . "', callertype = '" . $newdealercallertype . "' WHERE customername = '" . $olddealername . "'";
		$result = runmysqlquery($query);
	}
	if ($fetchedresult[2] > 0) {
		$query = "UPDATE ssm_errorregister SET customername = '" . $newdealername . "', customerid = '" . $newdealerid . "' WHERE customername = '" . $olddealername . "'";
		$result = runmysqlquery($query);
	}
	if ($fetchedresult[3] > 0) {
		$query = "UPDATE ssm_inhouseregister SET customername = '" . $newdealername . "', customerid = '" . $newdealerid . "', category = '" . $newdealercategory . "', callertype = '" . $newdealercallertype . "' WHERE customername = '" . $olddealername . "'";
		$result = runmysqlquery($query);
	}
	if ($fetchedresult[4] > 0) {
		$query = "UPDATE ssm_referenceregister SET customername = '" . $newdealername . "', customerid = '" . $newdealerid . "', category = '" . $newdealercategory . "' WHERE customername = '" . $olddealername . "'";
		$result = runmysqlquery($query);
	}
	if ($fetchedresult[5] > 0) {
		$query = "UPDATE ssm_requirementregister SET customername = '" . $newdealername . "', customerid = '" . $newdealerid . "' WHERE customername = '" . $olddealername . "'";
		$result = runmysqlquery($query);
	}
	if ($fetchedresult[6] > 0) {
		$query = "UPDATE ssm_skyperegister SET customername = '" . $newdealername . "', customerid = '" . $newdealerid . "', category = '" . $newdealercategory . "', callertype = '" . $newdealercallertype . "' WHERE customername = '" . $olddealername . "'";
		$result = runmysqlquery($query);
	}
	$message = 'Dealer Information updated Successfully';
} else {
	$message = 'All the fields are mandatory';
}

?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Delaer List Update</title>
	<link rel="stylesheet" type="text/css" href="../style/main.css">
</head>

<body>
	<form name="submitform" method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="4">
			<tr>
				<td colspan="2"><strong>
						<?php echo ($message); ?>
					</strong></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Existing Dealer Name:</td>
				<td><label>
						<input name="olddealername" type="text" class="swifttext" id="olddealername" size="60" />
					</label></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>New Dealer Name:</td>
				<td><input name="newdealername" type="text" class="swifttext" id="newdealername" size="60" /></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>New Dealer Id:</td>
				<td><input name="newdealerid" type="text" class="swifttext" id="newdealerid" size="60" /></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Category:</td>
				<td><input name="newdealercategory" type="text" class="swifttext" id="newdealercategory" size="60"
						value="" /></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Callertype:</td>
				<td><input name="newdealercallertype" type="text" class="swifttext" id="newdealercallertype"
						value="dealer" size="60" readonly="readonly" /></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td><label>
						<input name="submit" type="submit" class="swiftchoicebutton" id="submit" value="Submit" />
						&nbsp;&nbsp;&nbsp;

						<input type="reset" class="swiftchoicebutton" name="reset" id="reset" value="Reset" />
					</label></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</form>
</body>

</html>