<?php
include('../inc/includefiles.php');
$searchcriteria = $_POST['searchcriteria'];
$selection = $_POST['databasefield'];
$orderby = $_POST['orderby'];

switch($orderby)
{
	case 'slno': $orderbyfield = 'slno'; break;
	case 'oscompanyname': $orderbyfield = 'oscompanyname'; break;
	case 'osname': $orderbyfield = 'osname'; break;
	case 'contactnumber': $orderbyfield = 'contactnumber'; break;
	case 'emailid': $orderbyfield = 'emailid'; break;
	case 'category': $orderbyfield = 'category'; break;
	case 'place': $orderbyfield = 'place'; break;
	case 'district': $orderbyfield = 'district'; break;
	case 'state': $orderbyfield = 'state'; break;
	case 'skypeid': $orderbyfield = 'skypeid'; break;
}
switch ($selection)
{
	case 'slno': $textfield = "slno LIKE '%".$searchcriteria."%'"; break;
	case 'oscompanyname': $textfield = "oscompanyname LIKE '%".$searchcriteria."%'"; break;
	case 'osname': $textfield = "osname LIKE '%".$searchcriteria."%'"; break;
	case 'contactnumber': $textfield = "contactnumber LIKE '%".$searchcriteria."%'"; break;
	case 'emailid': $textfield = "emailid LIKE '%".$searchcriteria."%'"; break;
	case 'category': $textfield = "category LIKE '%".$searchcriteria."%'"; break;
	case 'place': $textfield = "place LIKE '%".$searchcriteria."%'"; break;
	case 'district': $textfield = "district LIKE '%".$searchcriteria."%'"; break;
	case 'state': $textfield = "state LIKE '%".$searchcriteria."%'"; break;
	case 'skypeid': $textfield = "skypeid LIKE '%".$searchcriteria."%'"; break;
}
$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
$grid .= '<tr bgcolor="#D8DFE7" style="font-weight:bold"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">OS Company Name</td><td nowrap = "nowrap" class="td-border-grid">OS Name</td><td nowrap = "nowrap" class="td-border-grid">Contact Number</td><td nowrap = "nowrap" class="td-border-grid">Email ID</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Place</td><td nowrap = "nowrap" class="td-border-grid">District</td><td nowrap = "nowrap" class="td-border-grid">State</td><td nowrap = "nowrap" class="td-border-grid">Skype ID</td></tr>';

$query = "SELECT * FROM ssm_osmaster WHERE ".$textfield." ORDER BY ".$orderbyfield;
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
	$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');">';
	for($i = 0; $i < count($fetch); $i++)
	{
		$grid .= "<td nowrap='nowrap' class='td-border-grid' bgcolor=".$color.">".$fetch[$i]."</td>";
	}
	$grid .= '</tr>';
}
$grid .= '</table>';
		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_OSM".$localdate."-".$localtime.".xls";
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
