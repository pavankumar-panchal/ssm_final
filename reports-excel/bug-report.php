<?php
include('../functions/phpfunctions.php');
$grid = '';
if(isset($_POST['errorreportgrid']))
{
	$grid = $_POST['errorreportgrid'];
}
else
{
	$grid = '<table width="100%" cellpadding="3" cellspacing="0" border="1"><tr bgcolor="#4f81bd">
	<td width="9%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Error ID</font></strong></td>
	<td width="10%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Name</font></strong></td>
	<td width="5%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Product Version</font></strong></td>
	<td width="8%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Back End</font></strong></td>
	<td width="12%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Reference Files</font></strong></td>
	<td width="26%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bug Description</font></strong></td>
	<td width="26%"><strong><font color="#FFFFFF" style="font-size:11px; font-family:Calibri;">Bug Understood by You</font></strong></td>
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
		$query = "SELECT ssm_errorregister.errorid AS errorid, ssm_products.productname AS productname, ssm_errorregister.productversion AS productversion, ssm_errorregister.database AS `database`, ssm_errorregister.errorfile AS errorfile, ssm_errorregister.errorreported AS errorreported,ssm_errorregister.errorunderstood AS errorunderstood, ssm_errorregister.remarks AS remarks, ssm_users.fullname AS userid, ssm_errorregister.customername AS customername FROM ssm_errorregister LEFT JOIN ssm_products ON ssm_products.slno = ssm_errorregister.productname  LEFT JOIN ssm_users AS ssm_users on ssm_users.slno = ssm_errorregister.userid  LEFT JOIN ssm_supportunits on ssm_users.supportunit =ssm_supportunits.slno  WHERE ssm_errorregister.slno = '".$bugloadnos."' ORDER BY  `date` DESC ";
		
		$fetch = runmysqlqueryfetch($query);
		
		$grid .= '<tr bgcolor='.$color.'>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorid'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productname'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['productversion'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['database'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorfile'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorreported'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['errorunderstood'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['remarks'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['userid'].'</font></td>
		<td><font color="#333333" style="font-size:11px; font-family:Calibri;">'.$fetch['customername'].'</font></td>
		</tr>';
	}
	$grid .= '</table>';
}	

$localdate = datetimelocal('Ymd');
$localtime = datetimelocal('His');
$filebasename = "S_BRp".$localdate."-".$localtime.".xls";
$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/filecreated/'.$filebasename;
$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/filecreated/'.$filebasename;

$fp = fopen($filepath,"wa+");
if($fp)
{
	fwrite($fp,$grid);
	downloadfile($filepath);
	fclose($fp);
}  
	
?>

