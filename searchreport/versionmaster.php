<?php
include('../inc/includefiles.php');
$searchcriteria = $_POST['searchcriteria'];
$selection = $_POST['selection'];
$orderby = $_POST['orderby'];

switch($orderby)
{
	case 'slno': $orderbyfield = 'slno'; break;
	case 'productname': $orderbyfield = 'productname'; break;
	case 'productversion': $orderbyfield = 'productversion'; break;
	case 'releasedate': $orderbyfield = 'releasedate'; break;
	case 'shortformat': $orderbyfield = 'shortformat'; break;
	case 'productinuse': $orderbyfield = 'productinuse'; break;
}
switch ($selection)
{
	case 'slno': $textfield = "slno LIKE '%".$searchcriteria."%'"; break;
	case 'productname': $textfield = "productname LIKE '%".$searchcriteria."%'"; break;
	case 'productversion': $textfield = "productversion LIKE '%".$searchcriteria."%'"; break;
	case 'releasedate': $textfield = "releasedate LIKE '%".changedateformat($searchcriteria)."%'"; break;
	case 'shortformat': $textfield = "shortformat LIKE '%".$searchcriteria."%'"; break;
	case 'productinuse': $textfield = "productinuse LIKE '%".$searchcriteria."%'"; break;			
}
$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Product Name</td><td nowrap = "nowrap" class="td-border-grid">Product Version</td><td nowrap = "nowrap" class="td-border-grid">Release Date</td><td nowrap = "nowrap" class="td-border-grid">Short Format</td><td nowrap = "nowrap" class="td-border-grid">Product In Use</td></tr>';

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
	$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
	for($i = 0; $i < count($fetch); $i++)
	{
		if($i == 3)
		$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
		else
		$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
	}
	$grid .= '</tr>';
}
$grid .= '</table>';

		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_VM".$localdate."-".$localtime.".xls";
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
