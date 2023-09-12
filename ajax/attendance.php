<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
$type = $_POST['type'];

if($type == 'dattendance')
{
	$getmonth = $_POST['month'];
	$getyear = $_POST['year'];
	$user = $_POST['loggeduser'];
	$message = '';
	function attendanceCalendar($month, $year,$user)
	{
		$date = mktime(12, 0, 0, $month, 1, $year);
		$daysInMonth = date("t", $date);
		$offset = date("w", $date);
		$loggedusertype = $_POST['loggedusertype'];
		$userid = $_POST['userid'];
		$useridpiece = ($userid == "")?(""):(" AND ssm_users.slno='".$userid."' ");
		$rows = 1;
		$calendar = '<table width="590" border="0" cellspacing="0" cellpadding="1" style="border:1px solid #6297DD">';
	
		$calendar = '<tr>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border:2px solid #DDE9F8">
							<tr>
								<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="12" style="border:2px solid #4B88D8">
									<tr>
										<td bgcolor="#8ad8ff">
										<table width="560" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td valign="top">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td bgcolor="#315D94" align="right" style="color:#FFFFFF; padding-right:8px;"><h3>'.convertmonthtostring($month).' '.$year.'</h3></td>
													</tr>
												</table>
												</td>
											</tr>';
	
		$calendar .= '<tr>
						<td valign="top">
						<table width="100%" border="0" cellpadding="3" cellspacing="0" class="calendar-table-border">
							<tr>
								<td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Sun</font></strong></div></td>
								<td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Mon</font></strong></div></td>
								<td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Tue</font></strong></div></td>
								<td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Wed</font></strong></div></td>
								<td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Thu</font></strong></div></td>
								<td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Fri</font></strong></div></td>
								<td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Sat</font></strong></div></td>
							</tr>';
		$calendar .= '<tr>';
	
		for($i = 1; $i <= $offset; $i++)
		{
			$calendar .= '<td width="80" height="50" bgcolor="#FFFFFF" class="calendar-td-border"></td>';
		}
		if($loggedusertype == 'ADMIN')
		{
			$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece ;
		}
		elseif($loggedusertype == 'TEAMLEADER' || $loggedusertype == 'MANAGEMENT')
		{
			$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece." 
			AND (reportingauthority='".$user."') ";
		}
		else
		{
			$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' ".$useridpiece." 
			AND slno='".$user."'";
		}
		$result = runmysqlquery($query);
		while($fetch = mysqli_fetch_array($result))
		{
			$username = $fetch['username'] . "<br/>";
			$slno = $fetch['slno'];
	

		
		$result = runmysqlquery("SELECT DISTINCT `date` FROM ssm_nonworkingdays");
		while($fetch = mysqli_fetch_array($result))
		{
			$holidays[] = $fetch['date'];
		}
		$ntime = "00:00";			
		$ntime1 = explode(':',$ntime);
		$outtime="00:00";	
		for($day = 1; $day <= $daysInMonth; $day++)
		{
			if(strlen($day) == 1)
				$day = '0'.$day;
		   $currentdate = date('Y')."-".date('m')."-".$day;
			$dated = $year.'-'.$month.'-'.$day;
			$fetch = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_usertime WHERE userid = '".$slno."' AND logintype = 'IN' AND logindate='".$dated."'");		
			$attcount = $fetch['count'];
			
			$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '".$slno."' AND logindate='".$dated."' AND logintype = 'IN'");
			
			if($fetch['ylogintime']!="")
			{
				$ntime = $fetch['ylogintime'];
				$ntime1 = explode(':',$ntime);
				$intime = $ntime1[0].':'.$ntime1[1];
			}
			
			$fetch = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '".$slno."' AND  logindate='".$dated."' AND logintype = 'OUT'");
			
			if($fetch['ylogouttime']!="")
			{
				$otime = $fetch['ylogouttime'];
				$otime1 = explode(':',$otime);
				$outtime = $otime1[0].':'.$otime1[1];
			}
			
			$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '".$slno."' AND  logindate='".$dated."' AND logintype = 'IN'");
			if(!isset($fetch1['ylogintime'])){$fetch1['ylogintime'] = null;}
			if($fetch1['ylogintime']!="")
			{
				$ntime1 = $fetch['ylogintime'];
				$ntime11 = explode(':',$ntime);
				$intime1 = $ntime11[0].':'.$ntime11[1];
			}
			if(!isset($intime)){$intime = null;}
			if(!isset($intime1)){$intime1 = null;}
			if(!isset($secondTime)){$secondTime = null;}
			$firstTime = strtotime($intime);
			$secondtime =  strtotime($intime1);
			$lastTime = strtotime($outtime);
			if($firstTime > $lastTime)
				$outtime = '';
			if($secondTime > $lastTime)
				$outtime = '';
			$timediff = $lastTime-$firstTime; //1232337600 - 4hrs 1232352000 - 8hrs
	
			if(in_array($dated, $holidays))
			{
				$bgcolor = "#FFBE7D"; //orange
				$fetchoccassion = runmysqlqueryfetch("SELECT occassion FROM ssm_nonworkingdays WHERE `date` = '".$dated."'");
				$intag = wordwrap($fetchoccassion['occassion'], 12, "-<br />\n");
				$outtag = "";
				if($attcount > 0 && $outtime <> '')
				{
					$bgcolor = "#C5D7F3"; //blue
					$intag = "In: ".$intime;
					$outtag = "Out: ".$outtime;
				}
			}
			elseif($attcount == 0)
			{
				$bgcolor = "#FFFFFF"; //white
				$intag = "";
				$outtag = "";
			}
			elseif($outtime == '')
			{
				$bgcolor = "#ffffff"; //white
				$intag = "In: ".$intime;
				$outtag = "Out :<font color='#D01120'>Not Available</font>";
				$color = "#d40808";
			}
			elseif(($timediff >= 1500) and ($timediff < 14400))
			{
				$bgcolor = "#fffdc7"; //yellow
				$intag = "In: ".$intime;
				$outtag = "Out: ".$outtime;
			}
			elseif($timediff < 1500)
			{
				$bgcolor = "#FFFFFF"; //white
				$intag = "In: ".$intime;
				$outtag = "Out: ".$outtime;
			}
			else
			{
				$bgcolor = "#afffbf"; //green
				$intag = "In: ".$intime;
				$outtag = "Out: ".$outtime;
			}
	
			if( ($day + $offset - 1) % 7 == 0 && $day != 1)
			{
				$calendar .= '</tr><tr>';
				$rows++;
			}
			$calendar .= '<td width="80" height="50" valign="top" bgcolor="'.$bgcolor.'" class="calendar-td-border"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="right"><strong style="background:#E8EBEC">'.$day.'</strong></td> </tr><tr><td><font color="#333333">'.$intag.'</font></td></tr><tr><td><font color="#333333">'.$outtag.'</font></td></tr></table></td>';
		}
		
		while( ($day + $offset) <= $rows * 7)
		{
			$calendar .= '<td width="80" height="50" bgcolor="#FFFFFF" class="calendar-td-border"></td>';
			$day++;
		}
		$calendar .= '</table></td></tr></table></td></tr></table></td></tr></table></td></tr></table>';
		return $calendar;
	}
	
	}
	if(!isset($useridpiece)){$useridpiece = null;}
	$attendanceCal = attendanceCalendar($getmonth,$getyear,$useridpiece);
	echo($attendanceCal);
}
elseif($type == 'dcalendar')
{
	 $year = date ("Y", mktime(0,0,0,date('n'))); 
	 $attendanceCal = attendanceCal(date('n'),$year); 
	 echo($attendanceCal);
}
?>

