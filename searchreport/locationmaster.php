<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');

$searchcriteria = $_POST['searchcriteria'];
$selection = $_POST['databasefield'];
$orderby = $_POST['orderby'];

switch($orderby)
{
	case 'locationname': $orderbyfield = 'locationname'; break;
	case 'businessname': $orderbyfield = 'businessname'; break;
	case 'address': $orderbyfield = 'address'; break;
	case 'place': $orderbyfield = 'place'; break;
	case 'district': $orderbyfield = 'district'; break;
	case 'state': $orderbyfield = 'state'; break;
	case 'phone': $orderbyfield = 'phone'; break;
	case 'emailid': $orderbyfield = 'emailid'; break;
	case 'locationincharge': $orderbyfield = 'locationincharge'; break;
}
switch ($selection)
{
	case 'locationname': $textfield = "locationname LIKE '%".$searchcriteria."%'"; break;
	case 'businessname': $textfield = "businessname LIKE '%".$searchcriteria."%'"; break;
	case 'address': $textfield = "address LIKE '%".$searchcriteria."%'"; break;
	case 'phone': $textfield = "phone LIKE '%".$searchcriteria."%'"; break;
	case 'place': $textfield = "place LIKE '%".$searchcriteria."%'"; break;
	case 'district': $textfield = "district LIKE '%".$searchcriteria."%'"; break;
	case 'state': $textfield = "state LIKE '%".$searchcriteria."%'"; break;
	case 'emailid': $textfield = "emailid LIKE '%".$searchcriteria."%'"; break;
	case 'locationincharge': $textfield = "locationincharge LIKE '%".$searchcriteria."%'"; break;
}
$grid = '<table width="500" border="1" bordercolor = "#006699" cellpadding="0" cellspacing="0" >';
$grid .= '<tr bgcolor="#B8CCE4"><td><font color="#4F81BD">Sl No</font></td><td><font color="#00823B">Location Name</font></td><td><font color="#00823B">Business Name</font></td><td><font color="#00823B">Address</font></td><td><font color="#00823B">Place</font></td><td><font color="#00823B">District</font></td><td><font color="#00823B">State</font></td><td><font color="#00823B">Phone</font></td><td><font color="#00823B">Email ID</font></td><td><font color="#00823B">Location Incharge</font></td></tr>';

$query = "SELECT * FROM ssm_locationmaster WHERE ".$textfield." ORDER BY ".$orderbyfield;
$result = runmysqlquery($query);
$i_n = 0;
while($fetch = mysqli_fetch_row($result))
{
	$i_n++;
	$color;
	if($i_n%2 == 0)
		$color = "#ECECEC";
	else
		$color = "#D8D8D8";
	$grid .= '<tr bgcolor=".$color.">';
	for($i = 0; $i < count($fetch); $i++)
	{
		$grid .= "<td><font color='#00823B'>".$fetch[$i]."</font></td>";
	}
	$grid .= '</tr>';
}
$grid .= '</table>';

	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_LM".$localdate."-".$localtime.".xls";
	$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/uploads/'.$filebasename;
	$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/uploads/'.$filebasename;
	
	$fp = fopen($filepath,"wa+");
	if($fp)
	{
		fwrite($fp,$grid);
		downloadfile($filepath);
		fclose($fp);
	} 

?><link rel="stylesheet" type="text/css" href="../style/main.css">
