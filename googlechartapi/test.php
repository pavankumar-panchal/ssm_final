<?php
include('../functions/phpfunctions.php');
$query = "SELECT slno,username,reportingauthority FROM ssm_users WHERE type <> 'ADMIN'";
$result = runmysqlquery($query);
$fetchcount = mysqli_num_rows($result);
$i = 1;
while($fetch = mysqli_fetch_array($result))
{
		if($fetch['reportingauthority'] <> '')
		{
			$fetchra = runmysqlqueryfetch("SELECT username FROM ssm_users WHERE slno = '".$fetch['reportingauthority']."'");
			$fetchrausername = $fetchra['username'];
		}
		else
			$fetchrausername = '';
		if($i == $fetchcount)
		$grid .= "{c:[{v:'".$fetch['username']."'},{v:'".$fetchrausername."'}]}";
		else
		$grid .= "{c:[{v:'".$fetch['username']."'},{v:'".$fetchrausername."'}]},";
$i++;
}
$grid .= "]}});";
		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "usercsv23.txt";
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/saralimax-ssm/googlechartapi/'.$filebasename;
		$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/saralimax-ssm/googlechartapi/'.$filebasename;
		
		$fp = fopen($filepath,"wa+");
		if($fp)
		{
			fwrite($fp,$grid);
			downloadfile($filepath);
			fclose($fp);
		} 

?>
