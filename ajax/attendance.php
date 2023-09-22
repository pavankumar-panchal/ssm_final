<?php

ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
$type = $_POST['type'];

if ($type == 'dattendance') {
	$getmonth = $_POST['month'];
	$getyear = $_POST['year'];
	$user = $_POST['loggeduser'];
	$message = '';

	function attendanceCalendar($month, $year, $user)
	{
		$date = mktime(12, 0, 0, $month, 1, $year);
		$daysInMonth = date("t", $date);
		$offset = date("w", $date);
		$loggedusertype = $_POST['loggedusertype'];
		$userid = $_POST['userid'];
		$useridpiece = ($userid == "") ? ("") : (" AND ssm_users.slno='" . $userid . "' ");
		$rows = 1;
		$calendar = '<div class="container">';

		$calendar .= '<div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">' . convertmonthtostring($month) . ' ' . $year . '</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead class="bg-info
										
										
										
										
										
										">







										
                                            <tr>
                                                <th class="text-center">Sun</th>
                                                <th class="text-center">Mon</th>
                                                <th class="text-center">Tue</th>
                                                <th class="text-center">Wed</th>
                                                <th class="text-center">Thu</th>
                                                <th class="text-center">Fri</th>
                                                <th class="text-center">Sat</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

		$calendar .= '<tr>';

		for ($i = 1; $i <= $offset; $i++) {
			$calendar .= '<td></td>';
		}

		if ($loggedusertype == 'ADMIN') {
			$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' " . $useridpiece;
		} elseif ($loggedusertype == 'TEAMLEADER' || $loggedusertype == 'MANAGEMENT') {
			$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' " . $useridpiece . "
            AND (reportingauthority='" . $user . "') ";
		} else {

			$query = "SELECT username,slno FROM ssm_users WHERE type <> 'ADMIN' and existinguser = 'yes' " . $useridpiece . "
            AND slno='" . $user . "'";
		}

		$result = runmysqlquery($query);

		while ($fetch = mysqli_fetch_array($result)) {
			$username = $fetch['username'];
			$slno = $fetch['slno'];

			$result = runmysqlquery("SELECT DISTINCT `date` FROM ssm_nonworkingdays");

			while ($fetch = mysqli_fetch_array($result)) {
				$holidays[] = $fetch['date'];
			}

			$ntime = "00:00";
			$ntime1 = explode(':', $ntime);
			$outtime = "00:00";

			for ($day = 1; $day <= $daysInMonth; $day++) {
				if (strlen($day) == 1) {
					$day = '0' . $day;
				}
				$currentdate = date('Y') . "-" . date('m') . "-" . $day;
				$dated = $year . '-' . $month . '-' . $day;
				$fetch = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_usertime WHERE userid = '" . $slno . "' AND logintype = 'IN' AND logindate='" . $dated . "'");
				$attcount = $fetch['count'];

				$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '" . $slno . "' AND logindate='" . $dated . "' AND logintype = 'IN'");

				if ($fetch['ylogintime'] != "") {
					$ntime = $fetch['ylogintime'];
					$ntime1 = explode(':', $ntime);
					$intime = $ntime1[0] . ':' . $ntime1[1];
				}

				$fetch = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $slno . "' AND  logindate='" . $dated . "' AND logintype = 'OUT'");

				if ($fetch['ylogouttime'] != "") {
					$otime = $fetch['ylogouttime'];
					$otime1 = explode(':', $otime);
					$outtime = $otime1[0] . ':' . $otime1[1];
				}

				$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $slno . "' AND  logindate='" . $dated . "' AND logintype = 'IN'");
				if (!isset($fetch1['ylogintime'])) {
					$fetch1['ylogintime'] = null;
				}
				if ($fetch1['ylogintime'] != "") {
					$ntime1 = $fetch['ylogintime'];
					$ntime11 = explode(':', $ntime);
					$intime1 = $ntime11[0] . ':' . $ntime11[1];
				}
				if (!isset($intime)) {
					$intime = null;
				}
				if (!isset($intime1)) {
					$intime1 = null;
				}
				if (!isset($secondTime)) {
					$secondTime = null;
				}
				$firstTime = strtotime($intime);
				$secondtime = strtotime($intime1);
				$lastTime = strtotime($outtime);
				if ($firstTime > $lastTime)
					$outtime = '';
				if ($secondTime > $lastTime)
					$outtime = '';
				$timediff = $lastTime - $firstTime; //1232337600 - 4hrs 1232352000 - 8hrs

				if (in_array($dated, $holidays)) {
					$bgcolor = "#FFBE7D"; //orange
					$fetchoccassion = runmysqlqueryfetch("SELECT occassion FROM ssm_nonworkingdays WHERE `date` = '" . $dated . "'");
					$intag = wordwrap($fetchoccassion['occassion'], 12, "-<br />\n");
					$outtag = "";
					if ($attcount > 0 && $outtime <> '') {
						$bgcolor = "#C5D7F3"; //blue
						$intag = "In: " . $intime;
						$outtag = "Out: " . $outtime;
					}
				} elseif ($attcount == 0) {
					$bgcolor = "#FFFFFF"; //white
					$intag = "";
					$outtag = "";
				} elseif ($outtime == '') {
					$bgcolor = "#FFCCCC"; //light red
					$intag = "In: " . $intime;
					$outtag = "Out :<font color='#D01120'>Not Available</font>";
					$color = "#d40808";
				} elseif (($timediff >= 1500) and ($timediff < 14400)) {
					$bgcolor = "#FFFF99"; //light yellow
					$intag = "In: " . $intime;
					$outtag = "Out: " . $outtime;
				} elseif ($timediff < 1500) {
					$bgcolor = "#FFFFFF"; //white
					$intag = "In: " . $intime;
					$outtag = "Out: " . $outtime;
				} else {
					$bgcolor = "#CCFFCC"; //light green
					$intag = "In: " . $intime;
					$outtag = "Out: " . $outtime;
				}

				if (($day + $offset - 1) % 7 == 0 && $day != 1) {
					$calendar .= '</tr><tr>';
					$rows++;
				}

				$calendar .= '<td class="calendar-cell" bgcolor="' . $bgcolor . '">
                                <strong>' . $day . '</strong><br>
                                ' . $intag . '<br>
                                ' . $outtag . '
                              </td>';
			}

			while (($day + $offset) <= $rows * 7) {
				$calendar .= '<td class="empty-cell"></td>';
				$day++;
			}

			$calendar .= '</tr>';
		}

		$calendar .= '</tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

		return $calendar;
	}
}

if (!isset($useridpiece)) {
	$useridpiece = null;
}

$attendanceCal = attendanceCalendar($getmonth, $getyear, $useridpiece);
echo ($attendanceCal);
?>