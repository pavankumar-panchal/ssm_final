<?php
include('../functions/phpfunctions.php');
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$includeholidays = $_POST['holidays'];
$includeworkingdays = $_POST['workingdays'];
$userid = $_POST['userid'];

$fetch = runmysqlqueryfetch("SELECT ssm_users.username AS username FROM  ssm_users WHERE ssm_users.slno = '" . $userid . "'");
$username = $fetch['username'];

$holidayresult = runmysqlquery("SELECT DISTINCT `date` FROM ssm_nonworkingdays");
while ($fetch = mysqli_fetch_array($holidayresult)) {
	$holidays[] = $fetch['date'];
}

$grid = '<div class="container">
    <h3 class="mt-3">Attendance Report of ' . $username . ' From: ' . $fromdate . ' To: ' . $todate . '</h3>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>User Name</th>
                <th>Login Time</th>
                <th>Logout Time</th>
            </tr>
        </thead>
        <tbody>';
$datedifference = dateDiff($todate, $fromdate);
$i = 0;
while ($i <= $datedifference) {
	$query = "SELECT DATE_ADD('" . changedateformat($fromdate) . "', INTERVAL " . $i . " day) AS dateadd";
	$dateresult = runmysqlquery($query);

	while ($fetchdate = mysqli_fetch_array($dateresult)) {
		$fetch1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_usertime WHERE userid = '" . $userid . "' AND logintype = 'IN' AND logindate='" . $fetchdate['dateadd'] . "'");
		$attcount = $fetch1['count'];

		$fetch1 = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '" . $userid . "' AND logindate='" . $fetchdate['dateadd'] . "' AND logintype = 'IN'");
		$intime = $fetch1['ylogintime'];

		$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $userid . "' AND  logindate='" . $fetchdate['dateadd'] . "' AND logintype = 'OUT'");
		$outtime = $fetch1['ylogouttime'];
		$firstTime = strtotime($intime);
		$lastTime = strtotime($outtime);
		if ($firstTime > $lastTime)
			$outtime = '';
		$timediff = $lastTime - $firstTime;

		if (in_array($fetchdate['dateadd'], $holidays)) {
			if (isset($_POST['holidays'])) {
				$fetchoccassion = runmysqlqueryfetch("SELECT occassion FROM ssm_nonworkingdays WHERE `date` = '" . $fetchdate['dateadd'] . "'");
				$status = "Holiday - " . $fetchoccassion['occassion'];
				$bgcolor = "bg-warning text-dark";
				$intag = "";
				$outtag = "";
			}
			if ($attcount > 0 && $outtime <> '') {
				$status = "Present on Holiday";
				$bgcolor = "bg-info text-white";
				$intag = $intime;
				$outtag = $outtime;
			}
		} elseif ($attcount == 0) {
			$status = "Absent";
			$bgcolor = "bg-danger text-white";
			$intag = "";
			$outtag = "";
		} elseif ($outtime == '') {
			$status = "Absent";
			$bgcolor = "bg-danger text-white";
			$intag = "";
			$outtag = "";
		} elseif (($timediff >= 14400) and ($timediff < 28800)) {
			$status = "Half Day";
			$bgcolor = "bg-warning text-dark";
			$intag = $intime;
			$outtag = $outtime;
		} elseif ($timediff < 14400) {
			$status = "Absent";
			$bgcolor = "bg-danger text-white";
			$intag = $intime;
			$outtag = $outtime;
		} else {
			if (isset($_POST['workingdays'])) {
				$status = "Present";
				$bgcolor = "bg-success text-white";
				$intag = $intime;
				$outtag = $outtime;
			}
		}

		$grid .= '<tr class="' . $bgcolor . '">
            <td>' . $fetchdate['dateadd'] . '</td>
            <td>' . $status . '</td>
            <td>' . $username . '</td>
            <td>' . $intag . '</td>
            <td>' . $outtag . '</td>
        </tr>';
	}
	$i++;
}
$grid .= '</tbody>
    </table>
</div>';

$localdate = datetimelocal('Ymd');
$localtime = datetimelocal('His');
$filebasename = "S_AR" . $localdate . "-" . $localtime . ".xls";
$filepath = $_SERVER['DOCUMENT_ROOT'] . '/support/uploads/' . $filebasename;
$downloadlink = 'http://' . $_SERVER['HTTP_HOST'] . '/support/uploads/' . $filebasename;

$fp = fopen($filepath, "wa+");
if ($fp) {
	fwrite($fp, $grid);
	downloadfile($filepath);
	fclose($fp);
}

?>