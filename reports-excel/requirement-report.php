<?php
include('../functions/phpfunctions.php');
$grid = '';
if(isset($_POST['requirementreportgrid']))
{
	$grid = $_POST['requirementreportgrid'];
}
else
{	
	$grid = '<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd">
	<td width="9%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement ID</font></strong></td>
	<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td>
	<td width="5%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td>
	<td width="8%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Back End</font></strong></td>
	<td width="26%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Requirement Description</font></strong></td>
	<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Remarks</font></strong></td>
	<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reported By</font></strong></td>
	<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Customer Reference</font></strong></td><tr>';
	$i_n = 0;
	for($i = 0; $i<count($_POST["check"]); $i++)
	{
		$bugloadnos = $_POST["check"][$i];
		$i_n++;
		$color;
		if($i_n%2 == 0)
			$color = "#dbe5f1";
		else
			$color = "#ffffff";
		$query = "SELECT ssm_requirementregister.requirementid AS requirementid,
		ssm_products.productname AS productname,
		ssm_requirementregister.productversion AS productversion,
		ssm_requirementregister.database AS `database`,
		ssm_requirementregister.requirement AS requirement,
		ssm_requirementregister.remarks AS remarks,
		ssm_users.fullname AS userid,
		ssm_requirementregister.customername AS customername
		FROM ssm_requirementregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_requirementregister.productname 
		LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_requirementregister.userid 
		LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno  WHERE ssm_requirementregister.slno = '".$bugloadnos."' ORDER BY  `date` DESC ";
		
		$fetch = runmysqlqueryfetch($query);
		
		$grid .= '<tr bgcolor='.$color.'>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['requirementid'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productname'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productversion'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['database'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['requirement'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['remarks'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['userid'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['customername'].'</font></td>
		</tr>';
	}
	$grid .= '</table>';
}

	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_RRp".$localdate."-".$localtime.".xls";
	$addstring = "/support";
	if($_SERVER['HTTP_HOST'] == "meghanab")
		$addstring = "/saralimax-ssm";
	
	$filepath = $_SERVER['DOCUMENT_ROOT'].$addstring.'/filecreated/'.$filebasename;
	$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].$addstring.'/filecreated/'.$filebasename;
	
	$fp = fopen($filepath,"wa+");
	if($fp)
	{
		fwrite($fp,$grid);
		downloadfile($filepath);
		fclose($fp);
	}	
?>

