<?php

//Include Database Configuration details
if (file_exists("../inc/dbconfig.php")) {
	include('../inc/dbconfig.php');
} elseif (file_exists("../../inc/dbconfig.php")) {
	include('../../inc/dbconfig.php');
} else
	include('./inc/dbconfig.php');

//Connect to host
$newconnection = mysqli_connect($dbhost, $dbuser, $dbpwd) or die("Cannot connect to Mysql server host");

$newconnection_old = mysqli_connect($dbhost_old, $dbuser_old, $dbpwd_old) or die("Cannot connect to Mysql server host");

/* -------------------- Get local server time [by adding 5.30 hours] -------------------- */
function datetimelocal($format)
{
	//$diff_timestamp = date('U') + 19800;
	$date = date($format);
	return $date;
}

/* -------------------- Upload ZIP file through PHP -------------------- */
function fileupload($filename, $filetempname)
{
	//check that we have a file
	//Check if the file is JPEG image and it's size is less than 350Kb

	//retrieve the date.
	$date = datetimelocal('YmdHis-');
	$filebasename = $date . basename($filename);
	$ext = substr($filebasename, strrpos($filebasename, '.') + 1);
	if ($ext == "zip") {
		$newname = $_SERVER['DOCUMENT_ROOT'] . '/support/uploads/' . $filebasename;
		$downloadlink = 'http://' . $_SERVER['HTTP_HOST'] . '/support/uploads/' . $filebasename;
		if (!file_exists($newname)) {
			if ((move_uploaded_file($filetempname, $newname))) {
				$result = "1^" . $newname; //Upload successfull
			} else {
				$result = "^" . 4; //Problem dusring upload
			}
		} else {
			$result = "^" . 3; //File already exists by same name
		}
	} else {
		$result = "^" . 2; //Extension doesn't match
	}
	return $result;
}

/* ---------------------------- Upload Any through PHP  -------------------------------------- */
function uploadfile()
{
	$destination_path = getcwd() . DIRECTORY_SEPARATOR;
	$result = 0;
	$target_path = $destination_path . basename($_FILES['myfile']['name']);
	if (@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
		$result = 1;
	}
	sleep(1);
}


/* -------------------- Download any file through PHP header -------------------- */
function downloadfile($filelink)
{
	$filename = basename($filelink);
	header('Content-type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . $filename);
	readfile($filelink);
}

/* -------------------- Run a query to database -------------------- */
function runmysqlquery($query)
{
	global $newconnection;
	$dbname = 'relyon_imax';

	//Connect to Database
	mysqli_select_db($newconnection, $dbname) or die("Cannot connect to database");
	set_time_limit(3600);
	//Run the query
	$result = mysqli_query($newconnection, $query) or die(" run Query Failed in Runquery function1." . $query); //;

	//Return the result
	return $result;
}

function runmysqlquery_old($query)
{
	global $newconnection_old;
	$dbname = 'relyon_imax';

	//Connect to Database
	mysqli_select_db($newconnection_old, $dbname) or die("Cannot connect to database");


	set_time_limit(3600);
	//Run the query
	$result = mysqli_query($query, $newconnection_old) or die(" run Query Failed in Runquery function1." . $query); //;

	//Return the result
	return $result;
}

/* -------------------- Run a query to database with fetching from SELECT operation -------------------- */
function runmysqlqueryfetch($query)
{
	global $newconnection;
	$dbname = 'relyon_imax';

	//Connect to Database
	mysqli_select_db($newconnection, $dbname) or die("Cannot connect to database");
	set_time_limit(3600);
	//Run the query
	$result = mysqli_query($newconnection, $query) or die(" run Query Failed in Runquery function1." . $query); //;

	//Fetch the Query to an array
	$fetchresult = mysqli_fetch_array($result) or die("Cannot fetch the query result." . $query);

	//Return the result
	return $fetchresult;
}

function runmysqlqueryfetch_old($query)
{
	global $newconnection_old;
	$dbname = 'relyon_imax';

	//Connect to Database
	mysqli_select_db($newconnection_old, $dbname) or die("Cannot connect to database");
	set_time_limit(3600);
	//Run the query
	$result = mysqli_query($query, $newconnection_old) or die(" run Query Failed in Runquery function1." . $query); //;

	//Fetch the Query to an array
	$fetchresult = mysqli_fetch_array($result) or die("Cannot fetch the query result." . $query);

	//Return the result
	return $fetchresult;
}

/* -------------------- To change the date format from DD-MM-YYYY to YYYY-MM-DD or reverse -------------------- */

// function changedateformat($date)
// {
// 	if($date <> "0000-00-00")
// 	{
// 		if(strpos($date, " "))
// 		$result = split(" ",$date);
// 		else
// 		$result = split("[:./-]",$date);
// 		$date = $result[2]."-".$result[1]."-".$result[0];
// 	}
// 	else
// 	{
// 		$date = "";
// 	}
// 	return $date;
// }


function changedateformat($date)
{
	if ($date != "0000-00-00") {
		if (strpos($date, " ")) {
			$result = explode(" ", $date);
		} else {
			$result = preg_split('/[:.\-\/]/', $date);
		}
		$date = $result[2] . "-" . $result[1] . "-" . $result[0];
	} else {
		$date = "";
	}
	return $date;
}




// function changetimeformat($time)
// {
// 	if ($time <> "00:00:00") {
// 		$result = split(":", $time);
// 		$time = $result[0] . ":" . $result[1] . ":" . $result[2];
// 	} else {
// 		$time = "";
// 	}
// 	return $time;
// }


function changetimeformat($time)
{
	if ($time !== "00:00:00") {
		$result = explode(":", $time);
		$time = $result[0] . ":" . $result[1] . ":" . $result[2];
	} else {
		$time = "";
	}
	return $time;
}



function cusidcombine($customerid)
{
	$result1 = substr($customerid, 0, 4);
	$result2 = substr($customerid, 4, 4);
	$result3 = substr($customerid, 8, 4);
	$result4 = substr($customerid, 12, 5);
	$result = $result1 . '-' . $result2 . '-' . $result3 . '-' . $result4;
	return $result;
}


/*function changedateformat($date)
{
	if($date <> "0000-00-00")
	{
		$result = explode("-",$date);
		$date = $result[2]."-".$result[1]."-".$result[0];
	}
	else
	{
		$date = "";
	}
	return $date;
}*/
/* -------------------- To trim the data for the grid, If it is more than 20 charecters [Say: "This problem is due to the problem in server" -> "This problem is due ..." -------------------- */
function gridtrim($value)
{
	$desiredlength = 100;
	$length = strlen($value);
	if ($length >= $desiredlength) {
		$value = substr($value, 0, $desiredlength);
		$value .= "...";
	}
	return $value;
}

function gridtrim1($value)
{
	$desiredlength = 20;
	$length = strlen($value);
	if ($length >= $desiredlength) {
		$value = substr($value, 0, $desiredlength);
		$value .= "<br>";
	}
	return $value;
}

function changetime($time)
{
	if ($time == "00:00:00") {
		$time = "";
	}
	return $time;
}

/*function runaccessqueryco($query)
{
	global $codsnname, $codsnuser, $codsnpwd;

	//Connect to host
	$connection = odbc_connect($codsnname, $codsnuser, $codsnpwd) or die("Cannot connect to Access server host");

	//Run the query
	$result = odbc_exec($connection, $query) or die(" run Query Failed in runquery function");
	
	//Return the result
	return $result;
	
	//Close the database connection
	odbc_close($connection);
}
*/
// function runaccessquerycsd($query)
// {
// 	global $csddsnname, $csddsnuser, $csddsnpwd ;
// 	//Connect to host
// 	$connection = odbc_connect($csddsnname, $csddsnuser, $csddsnpwd) or die($csddsnname . $csddsnuser . "Cannot connect to Access server host");

// 	//Run the query
// 	$result = odbc_exec($connection, $query) or die(" run Query Failed in runquery function");

// 	//Return the result
// 	return $result;

// 	//Close the database connection
// 	odbc_close($connection);
// }

function runaccessquerycsd($query)
{
	global $csddsnname, $csddsnuser, $csddsnpwd;

	// Connect to host
	$connection = odbc_connect($csddsnname, $csddsnuser, $csddsnpwd) or die($csddsnname . $csddsnuser . "Cannot connect to Access server host");

	// Run the query
	$result = odbc_exec($connection, $query) or die(" run Query Failed in runquery function");

	// Close the database connection
	odbc_close($connection);

	// Return the result
	return $result;
}




//T0 Display Current Month Calendar--

function attendanceCal($month, $year)
{
	$date = mktime(12, 0, 0, $month, 1, $year);
	$daysInMonth = date("t", $date);
	$offset = date("w", $date);
	$rows = 1;
	$datestring = date('F');
	$calendar = '<table width="590" border="0" cellspacing="0" cellpadding="1" style="border:1px solid #6297DD">';

	$calendar = '<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border:2px solid #DDE9F8"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="12" style="border:2px solid #4B88D8"><tr><td bgcolor="#8ad8ff"><table width="560" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#315D94" align="right" style="color:#FFFFFF; padding-right:8px;"><h3>' . $datestring . ' ' . $year . '</h3></td></tr></table></td></tr>';

	$calendar .= '<tr><td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" class="calendar-table-border"><tr><td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Sun</font></strong></div></td><td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Mon</font></strong></div></td><td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Tue</font></strong></div></td><td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Wed</font></strong></div></td><td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Thu</font></strong></div></td><td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Fri</font></strong></div></td><td bgcolor="#4A82BD" class="calendar-td-border"><div align="center"><strong><font color="#FFFFFF">Sat</font></strong></div></td></tr>';
	$calendar .= '<tr>';

	for ($i = 1; $i <= $offset; $i++) {
		$calendar .= '<td width="80" height="50" bgcolor="#FFFFFF" class="calendar-td-border"></td>';
	}
	$result = runmysqlquery("SELECT DISTINCT `date` FROM ssm_nonworkingdays");
	while ($fetch = mysqli_fetch_array($result)) {
		$holidays[] = $fetch['date'];
	}
	//Write the days in the month
	for ($day = 1; $day <= $daysInMonth; $day++) {
		if (strlen($day) == 1)
			$day = '0' . $day;
		$currentdate = date('Y') . "-" . date('m') . "-" . $day;
		$bgcolor = "#FFFFFF";
		if (in_array($currentdate, $holidays)) {
			$bgcolor = "#FFBE7D"; //orange
			$fetchoccassion = runmysqlqueryfetch("SELECT occassion FROM ssm_nonworkingdays WHERE `date` = '" . $currentdate . "'");
			$intag = wordwrap($fetchoccassion['occassion'], 12, "-<br />\n");
		} else {
			$intag = '';
		}
		if (($day + $offset - 1) % 7 == 0 && $day != 1) {
			$calendar .= "</tr><tr>";
			$rows++;
		}
		$calendar .= '<td width="80" height="50" valign="top" bgcolor="' . $bgcolor . '" class="calendar-td-border"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="right"><strong style="background:#E8EBEC">' . $day . '</strong></td> </tr><tr><td><font color="#333333">' . $intag . '</font></td></tr><tr><td><font color="#333333"></font></td></tr></table></td>';
	}

	//Blank cells after end of the month
	while (($day + $offset) <= $rows * 7) {
		$calendar .= '<td width="80" height="50" bgcolor="#FFFFFF" class="calendar-td-border"></td>';
		$day++;
	}
	$calendar .= "</table></td></tr></table></td></tr></table></td></tr></table></td></tr></table>";
	return $calendar;
}
function changedateformatwithtime($date)
{
	if ($date <> "0000-00-00 00:00:00") {
		if (strpos($date, " ")) {
			$result = split(" ", $date);
			if (strpos($result[0], "-"))
				$dateonly = split("-", $result[0]);
			$timeonly = split(":", $result[1]);
			$timeonlyhm = $timeonly[0] . ':' . $timeonly[1];
			$date = $dateonly[2] . "-" . $dateonly[1] . "-" . $dateonly[0] . " " . '(' . $timeonlyhm . ')';
		}

	} else {
		$date = "";
	}
	return $date;
}

function attendanceCalendardashboard($month, $year, $user)
{
	$date = mktime(12, 0, 0, $month, 1, $year);
	$daysInMonth = date("t", $date);
	$offset = date("w", $date);
	$rows = 1;
	$calendar = '<table width="568" border="0" cellspacing="0" cellpadding="1" style="border:1px solid #6297DD" align="center">';

	$calendar = '<tr>
					<td>
					<table width="564" border="0" cellspacing="0" cellpadding="2" style="border:2px solid #DDE9F8" align="center">
						<tr>
							<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="12" style="border:2px solid #4B88D8" align="center">
								<tr>
									<td bgcolor="#8ad8ff">
									<table width="560" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td valign="top">
											<table width="560" border="0" cellspacing="0" cellpadding="0" align="center">
												<tr>
													<td bgcolor="#315D94" align="right" style="color:#FFFFFF; padding-right:8px;"><h3>' . convertmonthtostring($month) . ' ' . $year . '</h3></td>
												</tr>
											</table>
											</td>
										</tr>';

	$calendar .= '<tr>
					<td valign="top">
						<table width="560" border="0" cellpadding="3" cellspacing="0" class="calendar-table-border" align="center">
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

	for ($i = 1; $i <= $offset; $i++) {
		$calendar .= '<td width="80" height="50" bgcolor="#FFFFFF" class="calendar-td-border"></td>';
	}

	$result = runmysqlquery("SELECT DISTINCT `date` FROM ssm_nonworkingdays");
	while ($fetch = mysqli_fetch_array($result)) {
		$holidays[] = $fetch['date'];
	}

	$ntime = "00:00";
	$ntime1 = explode(':', $ntime);
	$outtime = "00:00";

	for ($day = 1; $day <= $daysInMonth; $day++) {
		if (strlen($day) == 1)
			$day = '0' . $day;
		$currentdate = date('Y') . "-" . date('m') . "-" . $day;
		$dated = $year . '-' . $month . '-' . $day;


		$fetch = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_usertime WHERE userid = '" . $user . "' AND logintype = 'IN' AND logindate='" . $dated . "'");
		$attcount = $fetch['count'];

		$fetch = runmysqlqueryfetch("SELECT MIN(logintime) AS ylogintime FROM ssm_usertime WHERE userid = '" . $user . "' AND logindate='" . $dated . "' AND logintype = 'IN'");
		if ($fetch['ylogintime'] != "") {
			$ntime = $fetch['ylogintime'];
			$ntime1 = explode(':', $ntime);
			$intime = $ntime1[0] . ':' . $ntime1[1];
		}
		$fetch = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $user . "' AND  logindate='" . $dated . "' AND logintype = 'OUT'");
		if ($fetch['ylogouttime'] != "") {
			$otime = $fetch['ylogouttime'];
			$otime1 = explode(':', $otime);
			$outtime = $otime1[0] . ':' . $otime1[1];
		}
		$fetch1 = runmysqlqueryfetch("SELECT MAX(logintime) AS ylogouttime FROM ssm_usertime WHERE userid = '" . $user . "' AND  logindate='" . $dated . "' AND logintype = 'IN'");
		if ($fetch1['ylogouttime'] != "") {
			$ntime1 = $fetch1['ylogouttime'];
			$ntime11 = explode(':', $ntime1);
			$intime1 = $ntime11[0] . ':' . $ntime11[1];
		}
		// echo $ntime . "hi <br />";
		// echo $intime1 . " bye <br />";

		if (!isset($intime)) {
			$intime = null;
		}
		if (!isset($intime1)) {
			$intime1 = null;
		}
		if (!isset($intime) || $intime === "") {
			$intime = "00:00:00";
		}
		if (!isset($intime1) || $intime1 === "") {
			$intime1 = "00:00:00";
		}

		$firstTime = strtotime($intime);
		$secondTime = strtotime($intime1);
		$lastTime = strtotime($outtime);

		if (($firstTime > $lastTime) || ($secondTime > $lastTime)) {
			$outtime = '';
		}


		$timediff = $lastTime - $firstTime; //1232337600 - 4hrs 1232352000 - 8hrs

		if (in_array($dated, $holidays)) {
			if ($attcount > 0 && $outtime <> '') {
				$bgcolor = "#C5D7F3"; //blue
				$intag = "In: " . $intime;
				$outtag = "Out: <font color='#D01120'>Not Available</font>";
			} else {
				$bgcolor = "#FFBE7D"; //orange
				$fetchoccassion = runmysqlqueryfetch("SELECT occassion FROM ssm_nonworkingdays WHERE `date` = '" . $currentdate . "'");
				$intag = wordwrap($fetchoccassion['occassion'], 12, "-<br />\n");
				$outtag = "";
			}
		} elseif ($attcount == 0) {
			$bgcolor = "#FFFFFF"; //white
			$intag = "";
			$outtag = "";
		} elseif ($outtime == '') {
			$bgcolor = "#ffffff"; //white
			$intag = "In: " . $intime;
			$outtag = "Out :<font color='#D01120'>Not Available</font>";
			$color = "#d40808";
		} elseif (($timediff >= 1500) && ($timediff < 14400)) {
			$bgcolor = "#fffdc7"; //yellow
			$intag = "In: " . $intime;
			$outtag = "Out: " . $outtime;
		} elseif ($timediff < 1500) {
			$bgcolor = "#FFFFFF"; //white
			$intag = "In: " . $intime;
			$outtag = "Out: " . $outtime;
		} else {
			$bgcolor = "#afffbf"; //green
			$intag = "In: " . $intime;
			$outtag = "Out: " . $outtime;
		}


		if (($day + $offset - 1) % 7 == 0 && $day != 1) {
			$calendar .= '</tr><tr>';
			$rows++;
		}
		$calendar .= '<td width="80" height="50" valign="top" bgcolor="' . $bgcolor . '" class="calendar-td-border">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="right"><strong style="background:#E8EBEC">' . $day . '</strong></td> </tr><tr><td><font color="#333333">' . $intag . '</font></td>
							</tr>
							<tr>
								<td><font color="#333333">' . $outtag . '</font></td>
							</tr>
						</table>
					</td>';
	}

	while (($day + $offset) <= $rows * 7) {
		$calendar .= '<td width="80" height="50" bgcolor="#FFFFFF" class="calendar-td-border"></td>';
		$day++;
	}
	$calendar .= '</table></td></tr></table></td></tr></table></td></tr></table>';
	return $calendar;
}


function dorunquery($query)
{
	$result = runmysqlqueryfetch($query);
	$fetchresult = $result['output'];
	return $fetchresult;
}
function dorunquerylink($query)
{
	$result = runmysqlqueryfetch($query);
	$fetchresult = $result['output'];
	return $fetchresult;
}

function replacemailvariable($content, $array)
{
	while ($item = current($array)) {
		if ($item == "")
			$item = "-";
		$content = str_replace(key($array), $item, $content);
		next($array);
	}
	return $content;
}

function newreplacemailvariable($content, $array)
{
	$arraylength = count($array);
	for ($i = 0; $i < $arraylength; $i++) {
		$splitvalue = explode('%^%', $array[$i]);
		$oldvalue = $splitvalue[0];
		$newvalue = $splitvalue[1];
		$content = str_replace($oldvalue, $newvalue, $content);
	}
	return $content;
}

function getpagelink($linkvalue)
{
	switch ($linkvalue) {
		case 'home_dashboard':
			return '../home/index.php';
			break;
		case 'home_setting':
			return '../home/settings.php';
			break;
		case 'home_help':
			return '../home/help.php';
			break;
		case 'master_users':
			return '../masters/users.php';
			break;
		case 'master_customer':
			return '../masters/customer.php';
			break;
		case 'master_dealers':
			return '../masters/dealers.php';
			break;
		case 'master_locations':
			return '../masters/locations.php';
			break;
		case 'master_osemployees':
			return '../masters/osemployee.php';
			break;
		case 'master_product':
			return '../masters/products.php';
			break;
		case 'master_version':
			return '../masters/versions.php';
			break;
		case 'master_category':
			return '../masters/categories.php';
			break;
		case 'master_supportunit':
			return '../masters/supportunits.php';
			break;
		case 'master_nonworkingdays':
			return '../masters/non-workingdays.php';
			break;
		case 'profile_changepassword':
			return '../profile/changepassword.php';
			break;
		case 'profile_editprofile':
			return '../profile/editprofile.php';
			break;
		case 'profile_completeprofile':
			return '../profile/completeprofile.php';
			break;
		case 'profile_viewprofile':
			return '../profile/viewprofile.php';
			break;
		case 'register_call':
			return '../registers/calls.php';
			break;
		case 'register_email':
			return '../registers/emails.php';
			break;
		case 'register_error':
			return '../registers/errors.php';
			break;
		case 'register_requirement':
			return '../registers/requirement.php';
			break;
		case 'register_reference':
			return '../registers/reference.php';
			break;
		case 'register_skype':
			return '../registers/skype.php';
			break;
		case 'register_onsite':
			return '../registers/onsite.php';
			break;
		case 'register_inhouse':
			return '../registers/inhouse.php';
			break;
		case 'billing_invoice':
			return '../billing/invoice.php';
			break;
		case 'billing_receipts':
			return '../billing/receipts.php';
			break;
		case 'logout':
			return '../logout.php';
			break;
		case 'authorize_records':
			return '../masters/record-authorization.php';
			break;
		case 'attendance_report':
			return '../attendance/attendance.php';
			break;
		case 'attendance_report_adv':
			return '../attendance/attendance-adv.php';
			break;
		case 'report_callstatistics':
			return '../reports/call-statistics.php';
			break;
		case 'report_dailyreport':
			return '../reports/daily-report.php';
			break;
		case 'report_bugstatistics':
			return '../reports/bug-statistics.php';
			break;
		case 'report_requirementstatistics':
			return '../reports/requirement-statistics.php';
			break;
		case 'report_onsitestatistics':
			return '../reports/onsite-statistics.php';
			break;
		case 'report_onsitependings':
			return '../reports/onsite-pendingvisit.php';
			break;
		case 'report_statisticschart':
			return '../reports/statisticschart.php';
			break;
		case 'kb_add':
			return '../kb/add.php';
			break;
		case 'kb_view':
			return '../kb/view.php';
			break;
		default:
			return '../home/index.php';
			break;
	}
}
function getpagetitle($linkvalue)
{
	switch ($linkvalue) {
		case 'home_dashboard':
			return 'SSM : Dashboard';
			break;
		case 'home_setting':
			return 'SSM : Settings';
			break;
		case 'home_help':
			return 'SSM : Help';
			break;
		case 'master_users':
			if ($usertype <> 'ADMIN')
				return 'SSM : Dashboard';
			else
				return 'SSM : Users';
			break;
		case 'master_customer':
			return 'SSM : Customer';
			break;
		case 'master_dealers':
			return 'SSM : Dealers';
			break;
		case 'master_locations':
			return 'SSM : Locations';
			break;
		case 'master_osemployees':
			return 'SSM : Out Station Employees';
			break;
		case 'master_product':
			return 'SSM : Products';
			break;
		case 'master_version':
			return 'SSM : Product Versions';
			break;
		case 'master_category':
			return 'SSM : Categories';
			break;
		case 'master_supportunit':
			return 'SSM : Support Units';
			break;
		case 'master_nonworkingdays':
			return 'SSM : Non Working Days';
			break;
		case 'profile_changepassword':
			return 'SSM : Change Password';
			break;
		case 'profile_editprofile':
			return 'SSM : Your Profile';
			break;
		case 'profile_completeprofile':
			return 'SSM : Complete Your Profile';
			break;
		case 'profile_viewprofile':
			return 'SSM : View Your Profile';
			break;
		case 'register_call':
			return 'SSM : Call Register';
			break;
		case 'register_email':
			return 'SSM : Email Register';
			break;
		case 'register_error':
			return 'SSM : Error Register';
			break;
		case 'register_requirement':
			return 'SSM : Requirement Register';
			break;
		case 'register_reference':
			return 'SSM : Reference Register';
			break;
		case 'register_skype':
			return 'SSM : Skype Register';
			break;
		case 'register_onsite':
			return 'SSM : Onsite Register';
			break;
		case 'register_inhouse':
			return 'SSM : Inhouse Register';
			break;
		case 'billing_invoice':
			return 'SSM : Invoices';
			break;
		case 'billing_receipts':
			return 'SSM : Receipts';
			break;
		case 'logout':
			return 'SSM : Logout';
			break;
		case 'authorize_records':
			return 'SSM : Authorize Records';
			break;
		case 'attendance_report':
			return 'SSM : Attendance Report';
			break;
		case 'attendance_report_adv':
			return 'SSM : Attendance Report - Advanced';
			break;
		case 'report_callstatistics':
			return 'SSM : Call Statistics Report';
			break;
		case 'report_dailyreport':
			return 'SSM : Daily Report';
			break;
		case 'report_bugstatistics':
			return 'SSM : Bug Statistics Report';
			break;
		case 'report_requirementstatistics':
			return 'SSM : Requirement Statistics Report';
			break;
		case 'report_onsitestatistics':
			return 'SSM : Onsite Statistics Report';
			break;
		case 'report_onsitependings':
			return 'SSM : Onsite Pendings Report';
			break;
		case 'report_statisticschart':
			return 'SSM : Statistics Chart Report';
			break;
		case 'kb_add':
			return 'SSM : Add Knowledge Base';
			break;
		case 'kb_View':
			return 'SSM : View Knowledge Base';
			break;
		default:
			return 'SSM : Dashboard';
			break;
	}
}

function valid_email($str)
{
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}


function timeDiff($firstTime, $lastTime)
{
	$firstTime = strtotime($firstTime);
	$lastTime = strtotime($lastTime);
	$timeDiff = $lastTime - $firstTime;
	return $timeDiff;
}

function dateDiff($enddate, $startdate)
{
	$difference = abs(strtotime($enddate) - strtotime($startdate));
	$days = round(((($difference / 60) / 60) / 24), 0);
	return $days;
}

function convertmonthtostring($month)
{
	switch ($month) {
		case '01':
			$datestring = 'January';
			break;
		case '02':
			$datestring = 'February';
			break;
		case '03':
			$datestring = 'March';
			break;
		case '04':
			$datestring = 'April';
			break;
		case '05':
			$datestring = 'May';
			break;
		case '06':
			$datestring = 'June';
			break;
		case '07':
			$datestring = 'July';
			break;
		case '08':
			$datestring = 'August';
			break;
		case '09':
			$datestring = 'September';
			break;
		case '10':
			$datestring = 'October';
			break;
		case '11':
			$datestring = 'November';
			break;
		case '12':
			$datestring = 'December';
			break;
	}
	return $datestring;
}

function backup_table_data($table_name, $backup_table_name, $table_name_value, $backup_table_name_value)
{
	db_query("INSERT INTO " . $backup_table_name . "(" . $backup_table_name_value . ") SELECT " . $table_name_value . " FROM " . $table_name);
}

function backup_table($table_name, $backup_table_name)
{
	db_query("DROP TABLE IF EXISTS $backup_table_name");
	db_query("CREATE TABLE " . $backup_table_name . " LIKE " . $table_name);
	db_query("ALTER TABLE $backup_table_name DISABLE KEYS");
	db_query("INSERT INTO " . $backup_table_name . " SELECT * FROM " . $table_name);
	db_query("ALTER TABLE $backup_table_name ENABLE KEYS");
}

function db_query($query)
{
	$output = runmysqlquery($query) or die('<h1 style="color: red;">MySQL Error:</h1>Please copy and paste between the lines and email to nithya.p@relyonsoft.com<br><br>------------------------------------------------------------------------------------<h3>Query:</h3><pre>' . htmlentities($query) . '</pre><h3>MySQL Error:</h3>' . mysqli_error() . '<br><br>------------------------------------------------------------------------------------');
	return $output;
}

function generatepwd()
{
	$charecterset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
	for ($i = 0; $i < 8; $i++) {
		$usrpassword .= $charecterset[rand(0, strlen($charecterset))];
	}
	return $usrpassword;
}


function gettimeDifference($date1, $time1, $date2, $time2)
{
	$startdate = explode("-", $date1);
	$starttime = explode(":", $time1);

	$enddate = explode("-", $date2);
	$endtime = explode(":", $time2);

	$secondsDifference = mktime(
		$endtime[0], $endtime[1], $endtime[2],
		$enddate[1], $enddate[2], $enddate[0]
	) - mktime(
		$starttime[0],
		$starttime[1], $starttime[2], $startdate[1], $startdate[2], $startdate[0]
	);


	if ($secondsDifference > 0) {
		$minutes = floor($secondsDifference / 60);
		$seconds = floor($secondsDifference % 60);
		if ($seconds < 10)
			$seconds = '0' . $seconds;
		$hours = floor($minutes / 60);
		if ($hours < 10)
			$hours = '0' . $hours;
		$minutes = $minutes % 60;
		if ($minutes < 10)
			$minutes = '0' . $minutes;

		$timediff = array($hours, $minutes, $seconds);
		return ($timediff[0] . ':' . $timediff[1] . ':' . $timediff[2]);

	}
	//return $secondsDifference;

}

// function to delete cookie and encoded the cookie name and value
function imaxdeletecookie($cookiename)
{

	//Name Suffix for MD5 value
	$stringsuff = "55";

	//Convert Cookie Name to base64
	$Encodename = encodevalue($cookiename);

	//Append the encoded cookie name with 55(suffix ) for MD5 value
	$rescookiename = $Encodename . $stringsuff;

	//Set expiration to negative time, which will delete the cookie
	setcookie($Encodename, '', time() - 3600);
	setcookie($rescookiename, '', time() - 3600);

}



// function to create cookie and encoded the cookie name and value
function imaxcreatecookie($cookiename, $cookievalue)
{
	//Define prefix and suffix 
	$prefixstring = "AxtIv23";
	$suffixstring = "StPxZ46";
	$stringsuff = "55";

	//Append Value with the Prefix and Suffix
	$Appendvalue = $prefixstring . $cookievalue . $suffixstring;

	// Convert the Appended Value to base64
	$Encodevalue = encodevalue($Appendvalue);

	//Convert Cookie Name to base64
	$Encodename = encodevalue($cookiename);

	//Create a cookie with the encoded name and value
	setcookie($Encodename, $Encodevalue);

	//Convert Appended encode value to MD5
	$rescookievalue = md5($Encodevalue);

	//Appended the encoded cookie name with 55(suffix )
	$rescookiename = $Encodename . $stringsuff;

	//Create a cookie
	setcookie($rescookiename, $rescookievalue);
	return false;

}

//Function to get cookie and encode it and validate



// function imaxgetcookie($cookiename)
// {
// 	$suff = "55";
// 	// Convert the Cookie Name to base64
// 	$Encodestr = encodevalue($cookiename);

// 	//Read cookie name
// 	$stringret = $_COOKIE[$Encodestr];
// 	$stringret = stripslashes($stringret);

// 	//Convert the read cookie name to md5 encode technique
// 	$Encodestring = md5($stringret);

// 	//Appended the encoded cookie name to 55(suffix)
// 	$resultstr = $Encodestr.$suff;
// 	$cookiemd5 = $_COOKIE[$resultstr];

// 	//Compare the encoded value wit the fetched cookie, if the condition is true decode the cookie value
// 	if($Encodestring == $cookiemd5)
// 	{
// 		$decodevalue = decodevalue($stringret);
// 		//Remove the Prefix/Suffix Characters
// 		$string1 = substr($decodevalue,7);
// 		$resultstring = substr($string1,0,-7);
// 		return $resultstring;
// 	}
// 	elseif(isset($Encodestring) == '')
// 	{
// 		//echo('Cookie Not Avaliable');
// 		return false;
// 	}
// 	else 
// 	{
// 		//echo('Validation failed!!');
// 		return false;
// 	}

// }


function imaxgetcookie($cookiename)
{
	$suff = "55";
	// Convert the Cookie Name to base64
	$Encodestr = encodevalue($cookiename);

	// Read cookie name
	if (isset($_COOKIE[$Encodestr])) {
		$stringret = $_COOKIE[$Encodestr];
		if (!is_null($stringret)) {
			$stringret = stripslashes($stringret);
		}

		// Convert the read cookie name to md5 encode technique
		$Encodestring = md5($stringret);

		// Appended the encoded cookie name to 55(suffix)
		$resultstr = $Encodestr . $suff;

		if (isset($_COOKIE[$resultstr])) {
			$cookiemd5 = $_COOKIE[$resultstr];

			// Compare the encoded value with the fetched cookie, if the condition is true decode the cookie value
			if ($Encodestring == $cookiemd5) {
				$decodevalue = decodevalue($stringret);
				// Remove the Prefix/Suffix Characters
				$string1 = substr($decodevalue, 7);
				$resultstring = substr($string1, 0, -7);
				return $resultstring;
			} else {
				// Handle the case where cookies don't match
				return false;
			}
		} else {
			// Handle the case where the resultstr cookie key is not set
			return false;
		}
	} else {
		// Handle the case where the Encodestr cookie key is not set
		return false;
	}
}




//Function to logout (clear cookies)
function imaxssmlogout()
{
	session_start();
	session_destroy();
	imaxdeletecookie('ssmuserid');
}

function decodevalue($input)
{
	$input = str_replace('\\\\', '\\', $input);
	$input = str_replace("\\'", "'", $input);
	$length = strlen($input);
	$output = "";
	for ($i = 0; $i < $length; $i++) {
		if ($i % 2 == 0)
			$output .= chr(ord($input[$i]) - 7);
	}
	$output = str_replace("'", "\'", $output);
	return $output;
}

function encodevalue($input)
{
	$length = strlen($input);
	$output1 = "";
	for ($i = 0; $i < $length; $i++) {
		$output1 .= $input[$i];
		if ($i < ($length - 1))
			$output1 .= "a";
	}
	$output = "";
	for ($i = 0; $i < strlen($output1); $i++) {
		$output .= chr(ord($output1[$i]) + 7);
	}
	return $output;
}

function sendsupportcallmail($lastslno, $customerslno)
{
	$query = "select * from ssm_callregister where ssm_callregister.slno = '" . $lastslno . "'";
	$result = runmysqlqueryfetch($query);


	//Dummy line to override To email ID
	if (($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk"))
		$emailid['meghana'] = 'meghana.b@relyonsoft.com';
	else
		//$emailid[] = $emailids;


		$fromname1 = "Relyon";
	$fromemail = "imax@relyon.co.in";
	require_once('../inc/RSLMAIL_MAIL.php');
	$msg = file_get_contents("../mailcontent/newcustomer.htm");
	$textmsg = file_get_contents("../mailcontent/newcustomer.txt");

	//Create an array of replace parameters
	$array = array();
	$date = datetimelocal('d-m-Y');
	$array[] = "##DATE##%^%" . $date;


	//Relyon Logo for email Content, as Inline [Not attachment]
	$filearray = array(
		array('../images/relyon-logo.jpg', 'inline', '8888888888')
	);


	if (($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk")) {
		$bccemailids['rashmi'] = 'rashmi.hk@relyonsoft.com';
	} else {
		$bccemailids['Relyonimax'] = 'relyonimax@gmail.com';
		$bccemailids['support'] = 'support@relyonsoft.com';
		$bccemailids['info'] = 'info@relyonsoft.com';
		$bccemailids['bigmail'] = 'bigmail@relyonsoft.com';
	}
	$toarray = $emailid;
	$bccarray = $bccemailids;
	$msg = newreplacemailvariable($msg, $array);
	$textmsg = newreplacemailvariable($textmsg, $array);
	$subject = 'test mail';
	$html = $msg;
	$text = $textmsg;
	rslmail($fromname1, $fromemail, $toarray, $subject, $text, $html, null, $bccarray, $filearray, $replyto);

}
/*---------- Daily Report --------------*/
function displaydata($slno, $fromdate, $todate)
{
	$date = datetimelocal('d-m-Y');
	$query = "select distinct(ssm_callregister.customername),ssm_callregister.date  
	from ssm_callregister where ssm_callregister.userid = '" . $slno . "' and ssm_callregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' 
	union
	select distinct(ssm_emailregister.customername),ssm_emailregister.date  
	from ssm_emailregister where ssm_emailregister.userid = '" . $slno . "' and ssm_emailregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' 
	union
	select distinct(ssm_skyperegister.customername),ssm_skyperegister.date  
	from ssm_skyperegister where ssm_skyperegister.userid = '" . $slno . "' and ssm_skyperegister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "'  ";
	$result = runmysqlquery($query);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		$i_n = 0;
		while ($fetchrecord = mysqli_fetch_array($result)) {
			$i_n++;
			if ($i_n % 2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$customername = $fetchrecord['customername'];
			$grid = '';
			$grid .= "<table width='100%'>
						<tr bgcolor='" . $color . "'>
							<td width='35%'>
								<a id='calldata' name='calldata' title='calldata list'
href='JavaScript:calldatalist(\"" . $customername . "\"," . $slno . ");' >" . $customername . "</a></td>";

			$query1 = "SELECT  COUNT(customername) AS calls from ssm_callregister 
			where  customername = '" . $customername . "' and userid = " . $slno . " ";

			$result1 = runmysqlquery($query1);
			while ($fetchrecord1 = mysqli_fetch_array($result1)) {
				$calls = $fetchrecord1['calls'];
			}

			$query2 = "SELECT COUNT(customername) as mails FROM ssm_emailregister  
			where  customername = '" . $customername . "' and userid = " . $slno . " ";
			$result2 = runmysqlquery($query2);
			while ($fetchrecord2 = mysqli_fetch_array($result2)) {
				$mails = $fetchrecord2['mails'];
			}

			$query3 = "SELECT COUNT(customername) as chats FROM ssm_skyperegister  
			where  customername = '" . $customername . "' and userid = " . $slno . " ";
			$result3 = runmysqlquery($query3);
			while ($fetchrecord3 = mysqli_fetch_array($result3)) {
				$chats = $fetchrecord3['chats'];
			}
			if (!isset($calls_count)) {
				$calls_count = null;
			}
			if (!isset($chats_count)) {
				$chats_count = null;
			}
			if (!isset($mails_count)) {
				$mails_count = null;
			}
			$grid .= "<td style='color:#000' width='15%'>" . $calls . "</td>
					<td style='color:#000' width='15%'>" . $chats . "</td>
					<td style='color:#000' width='15%'>" . $mails . "</td></tr>";
			$calls_count = $calls_count + $calls;
			$chats_count = $chats_count + $chats;
			$mails_count = $mails_count + $mails;
		}
		$grid .= '<tr>
				<th style="background-color:#E1F7FB;color:#000">Total</th>
				<td width="95px" style="background-color:#E1F7FB;color:#000">' . $calls_count . '</td>
				<td width="95" style="background-color:#E1F7FB;color:#000">' . $chats_count . '</td>
				<td width="95" style="background-color:#E1F7FB;color:#000">' . $mails_count . '</td>
			</tr></table>';
	} else {
		$grid = '';
		$grid .= '<table width="100%"><tr><td align="center" colspan="8" style="background-color:#edf4ff;color:#000;font-weight:bold;"> 0n leave</td></tr></table>';

	}
	return $grid;

}
/*---------- Report betwwen as you want ------------*/
function displaydatareport($slno, $fromdate, $todate)
{
	$query = "select distinct(ssm_callregister.customername),ssm_callregister.date  
	from ssm_callregister where ssm_callregister.userid = " . $slno . " and ssm_callregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' 
	union
	select distinct(ssm_emailregister.customername),ssm_emailregister.date  
	from ssm_emailregister where ssm_emailregister.userid = " . $slno . " and ssm_emailregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' 
	union
	select distinct(ssm_skyperegister.customername),ssm_skyperegister.date  
	from ssm_skyperegister where ssm_skyperegister.userid = " . $slno . " and ssm_skyperegister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' ";
	$result = runmysqlquery($query);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		$i_n = 0;
		while ($fetchrecord = mysqli_fetch_array($result)) {
			$i_n++;
			if ($i_n % 2 == 0) {
				$color = "#edf4ff";
			} else {
				$color = "#f7faff";
			}
			$customername = $fetchrecord['customername'];
			$grid = '';
			$grid .= '<tr bgcolor=' . $color . '>';
			$grid .= "<td>" . $customername . "</td>";

			$query1 = "SELECT  COUNT(customername) AS calls 
			from ssm_callregister where  customername = '" . $customername . "' and userid = " . $slno . " ";

			$result1 = runmysqlquery($query1);
			while ($fetchrecord1 = mysqli_fetch_array($result1)) {
				$calls = $fetchrecord1['calls'];
			}
			$query2 = "SELECT COUNT(customername) as mails FROM ssm_emailregister  
			where  customername = '" . $customername . "' and userid = " . $slno . " ";
			$result2 = runmysqlquery($query2);
			while ($fetchrecord2 = mysqli_fetch_array($result2)) {
				$mails = $fetchrecord2['mails'];
			}

			$query3 = "SELECT COUNT(customername) as chats FROM ssm_skyperegister  
			where  customername = '" . $customername . "' and userid = " . $slno . " ";
			$result3 = runmysqlquery($query3);
			while ($fetchrecord3 = mysqli_fetch_array($result3)) {
				$chats = $fetchrecord3['chats'];
			}
			if (!isset($calls_count)) {
				$calls_count = null;
			}
			if (!isset($chats_count)) {
				$chats_count = null;
			}
			if (!isset($mails_count)) {
				$mails_count = null;
			}
			$grid .= "<td  width='100px' style='color:#000'>" . $calls . "</td>";
			$grid .= "<td  width='100px' style='color:#000'>" . $chats . "</td>";
			$grid .= "<td  width='100px' style='color:#000'>" . $mails . "</td></tr>";
			$calls_count = $calls_count + $calls;
			$chats_count = $chats_count + $chats;
			$mails_count = $mails_count + $mails;
		}
		$grid .= '<tr>
				<th style="background-color:#E1F7FB;color:#000">Total</th>
				<td width="100px" style="background-color:#E1F7FB;color:#000">' . $calls_count . '</td>
				<td width="100px" style="background-color:#E1F7FB;color:#000">' . $chats_count . '</td>
				<td width="100px" style="background-color:#E1F7FB;color:#000">' . $mails_count . '</td>
			</tr>';
	} else {
		$grid .= '<tr><td align="center" colspan="8" style="background-color:#edf4ff;color:#000"> 0n leave</td></tr>';
	}
	return $grid;
}


?>