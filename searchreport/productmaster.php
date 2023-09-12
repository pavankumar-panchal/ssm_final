<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
$searchcriteria = $_POST['searchcriteria'];
$selection = $_POST['databasefield'];
$orderby = $_POST['orderby'];

switch($orderby)
{
	case 'slno': $orderbyfield = 'slno'; break;
	case 'productname': $orderbyfield = 'productname'; break;
	case 'shortformat': $orderbyfield = 'shortformat'; break;
	case 'productinuse': $orderbyfield = 'productinuse'; break;
}
switch ($selection)
{
	case 'slno': $textfield = "slno LIKE '%".$searchcriteria."%'"; break;
	case 'productname': $textfield = "productname LIKE '%".$searchcriteria."%'"; break;
	case 'shortformat': $textfield = "shortformat LIKE '%".$searchcriteria."%'"; break;
	case 'productinuse': $textfield = "productinuse LIKE '%".$searchcriteria."%'"; break;			
}
$grid = '<table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Sl No</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Short Format</font></td><td><font color="#FFFFFF">Product In Use</font></td></tr>';

$query = "SELECT * FROM ssm_products WHERE ".$textfield." ORDER BY ".$orderbyfield;
$result = runmysqlquery($query);
$i_n = 0;
while($fetch = mysqli_fetch_row($result))
{
	$i_n++;
	$color;
	if($i_n%2 == 0)
	$color = "#edf4ff";
else
	$color = "#f7faff";
	$grid .= '<tr nowrap="nowrap" bgcolor='.$color.'>';
	for($i = 0; $i < count($fetch); $i++)
	{
		$grid .= "<td><font color='#000000'>".$fetch[$i]."</font></td>";
	}
	$grid .= '</tr>';
}
$grid .= '</table>';

		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_PM".$localdate."-".$localtime.".xls";
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/uploads/'.$filebasename;
		$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/uploads/'.$filebasename;
		
		$fp = fopen($filepath,"wa+");
		if($fp)
		{
			fwrite($fp,$grid);
			downloadfile($filepath);
			fclose($fp);
		} 
?>
