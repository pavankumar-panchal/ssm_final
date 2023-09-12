<?php
include('../functions/phpfunctions.php');
$searchcriteria = $_POST['searchcriteria'];
$selection = $_POST['databasefield'];
$orderby = $_POST['orderby'];

switch($orderby)
{
	case 'username': $orderbyfield = 'username'; break;
	case 'type': $orderbyfield = 'type'; break;
	case 'locationname': $orderbyfield = 'locationname'; break;
	case 'reportingauthority': $orderbyfield = 'reportingauthority'; break;
	case 'supportunit': $orderbyfield = 'supportunit'; break;
	case 'existinguser': $orderbyfield = 'existinguser'; break;
	case 'gender': $orderbyfield = 'gender'; break;
}
switch ($selection)
{
	case 'username': $textfield = "username LIKE '%".$searchcriteria."%'"; break;
	case 'type': $textfield = "type LIKE '%".$searchcriteria."%'"; break;
	case 'locationname': $textfield = "locationname LIKE '%".$searchcriteria."%'"; break;
	case 'reportingauthority': $textfield = "reportingauthority LIKE '%".$searchcriteria."%'"; break;
	case 'supportunit': $textfield = "supportunit LIKE '%".$searchcriteria."%'"; break;
	case 'existinguser': $textfield = "existinguser LIKE '%".$searchcriteria."%'"; break;
	case 'gender': $textfield = "gender LIKE '%".$searchcriteria."%'"; break;
}
$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
$grid .= '<tr bgcolor="#D8DFE7" style="font-weight:bold"><td nowrap = "nowrap" class="td-border-grid">slno</td><td nowrap = "nowrap" class="td-border-grid">User Name</td><td nowrap = "nowrap" class="td-border-grid">Password</td><td nowrap = "nowrap" class="td-border-grid">Type</td><td nowrap = "nowrap" class="td-border-grid">Existing User</td><td nowrap = "nowrap" class="td-border-grid">Reporting Authority</td><td nowrap = "nowrap" class="td-border-grid">Support Unit</td><td nowrap = "nowrap" class="td-border-grid">Location</td><td nowrap = "nowrap" class="td-border-grid">Full Name</td><td nowrap = "nowrap" class="td-border-grid">Gender</td><td nowrap = "nowrap" class="td-border-grid">Present Address</td><td nowrap = "nowrap" class="td-border-grid">Permanent Address</td><td nowrap = "nowrap" class="td-border-grid">Mobile</td><td nowrap = "nowrap" class="td-border-grid">Emergency Number</td><td nowrap = "nowrap" class="td-border-grid">Emergency Remarks</td><td nowrap = "nowrap" class="td-border-grid">Date of Birth</td><td nowrap = "nowrap" class="td-border-grid">Date of Joining</td><td nowrap = "nowrap" class="td-border-grid">Designation</td><td nowrap = "nowrap" class="td-border-grid">Personal Email</td><td nowrap = "nowrap" class="td-border-grid">Official Email</td><td nowrap = "nowrap" class="td-border-grid">Date of Leaving</td></tr>';

$query = "SELECT * FROM ssm_users WHERE ".$textfield." ORDER BY ".$orderbyfield;
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
		if(i == 2)
			$grid .= "<td nowrap='nowrap' class='td-border-grid' bgcolor=".$color.">".'********'."</td>";
		else
			$grid .= "<td nowrap='nowrap' class='td-border-grid' bgcolor=".$color.">".$fetch[$i]."</td>";
	}
	$grid .= '</tr>';
}
$grid .= '</table>';

	$localdate = datetimelocal('Ymd');
	$localtime = datetimelocal('His');
	$filebasename = "S_CU".$localdate."-".$localtime.".xls";
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
