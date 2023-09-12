<?php
include('../functions/phpfunctions.php');
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$includeholidays = $_POST['holidays'];
$includeworkingdays = $_POST['workingdays'];
$userid = $_POST['userid'];
$useridpiece = ($userid == "")?(""):(" WHERE ssm_users.slno='".$userid."'");

$fetch = runmysqlqueryfetch("SELECT ssm_users.username AS username FROM  ssm_users ".$useridpiece);
$username = $fetch['username'];

$holidayresult = runmysqlquery("SELECT DISTINCT `date` FROM ssm_nonworkingdays");
while($fetch = mysqli_fetch_array($holidayresult))
{
	$holidays[] = $fetch['date'];
}

	$grid = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><font color="#336699"><strong>Attendance Report of '.$username.' From: '.$fromdate.' To: '.$todate.'</strong></font></td></tr><tr><td>&nbsp;</td></tr></table>';
$grid = '<table width="60%" border="1" cellpadding="5" cellspacing="0" bordercolor="#333333"><tr><td><div align="center"><strong>Date</strong></div></td><td><div align="center"><strong>Status</strong></div></td><td><div align="center"><strong>UserName</strong></div></td><td><div align="center"><strong>Login Time</strong></div></td><td><div align="center"><strong>Logout Time</strong></div></td></tr>';
$datedifference = dateDiff($todate,$fromdate);
$i = 0;
while($i <= $datedifference)
{
	
	$query = "SELECT DATE_ADD('".changedateformat($fromdate)."', INTERVAL ".$i." day) AS dateadd";
	$dateresult = runmysqlquery($query);
	
	while($fetchdate = mysqli_fetch_array($dateresult))
	{
		$fetch1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_usertime WHERE userid = '".$userid."' AND logintype = 'IN' AND logindate='".$fetchdate['dateadd']."'");		
		$attcount = $fetch1['count'];
		
		$fetch1 = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '".$userid."' AND logindate='".$fetchdate['dateadd']."' AND logintype = 'IN'");
		$intime = $fetch1['ylogintime'];
		
		$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '".$userid."' AND  logindate='".$fetchdate['dateadd']."' AND logintype = 'OUT'");
		$outtime = $fetch1['ylogouttime'];
		$firstTime = strtotime($intime);
		$lastTime = strtotime($outtime);
		if($firstTime > $lastTime)
			$outtime = '';
		$timediff = $lastTime-$firstTime; //1232337600 - 4hrs 1232352000 - 8hrs
		
		if(in_array($fetchdate['dateadd'], $holidays))
		{
			if(isset($_POST['holidays']))
			{
				$fetchoccassion = runmysqlqueryfetch("SELECT occassion FROM ssm_nonworkingdays WHERE `date` = '".$fetchdate['dateadd']."'");
				$status = "Holiday - ".$fetchoccassion['occassion'];
				$bgcolor = "#FFBE7D"; //orange
				$intag = "";
				$outtag = "";
			}
			if($attcount > 0 && $outtime <> '')
			{
				$status = "Present on Holiday"; //blue
				$bgcolor = "#C5D7F3";
				$intag = $intime;
				$outtag = $outtime;
			}
		}
		elseif($attcount == 0)
		{
			$status = "Absent"; //white
			$bgcolor = "#FFFFFF";
			$intag = "";
			$outtag = "";
		}
		elseif($outtime == '')
		{
			$status = "Absent"; //white
			$bgcolor = "#FFFFFF";
			$intag = "";
			$outtag = "";
		}
		elseif(($timediff >= 14400) and ($timediff < 28800))
		{
			$status = "Half Day"; //yellow
			$bgcolor = "#fffdc7";
			$intag = $intime;
			$outtag = $outtime;
		}
		elseif($timediff < 14400)
		{
			$status = "Absent"; //white
			$bgcolor = "#FFFFFF";
			$intag = $intime;
			$outtag = $outtime;
		}
		else
		{
			if(isset($_POST['workingdays']))
			{
				$status = "Present"; //green
	//			$bgcolor = "#75FF91";
				$bgcolor = "#afffbf";
				$intag = $intime;
				$outtag = $outtime;
			}
		}
	
		$grid .= '<tr><td bgcolor='.$bgcolor.'>'.$fetchdate['dateadd'].'</td>';
		$grid .= '<td bgcolor='.$bgcolor.'>'.$status.'</td><td bgcolor='.$bgcolor.'>'.$username.'</td><td bgcolor='.$bgcolor.'>'.$intag.'</td><td bgcolor='.$bgcolor.'>'.$outtag.'</td></tr>';
	}
	$i++;
}
$grid .= '</table>';

		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_AR".$localdate."-".$localtime.".xls";
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


