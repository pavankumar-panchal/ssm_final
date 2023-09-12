<?php
//Master Separator = ^#*#^
//Level1 Separator = ^##^
//Level2 Separator = ^*^
//Date Separator = ^^

//Main Format = Headings and format^#*#^Values of Table
//Headings and format = Heading^*^Format^##^Heading^*^Format^##^...n [Where n= Total Columns]
//Values of Table = Line1^##^Line2^##^...n  [Where n= Total Rows.]
//Values of Line = Value1^*^Value2^*^...n [Where n= Total Columns]
//Date Field = Year^^Month^^Date [Where Month is integer of the month minus one, Eg: Jan = 0, Feb = 1..]


ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');

$register = $_GET['register'];
$registers = explode("^^^", $register);
$fromdate = $_GET['fromdate'];
$todate = $_GET['todate'];
//$userid = $_GET['userid'];
$userid = imaxgetcookie('ssmuserid');
$status = $_GET['status'];
$dealer = $_GET['dealer'];
$customer = $_GET['customer'];
$employee = $_GET['employee'];
$ssmuser = $_GET['ssmuser'];
$supportunit = $_GET['supportunit'];
$anonymous = $_GET['anonymous'];
/*$userpiece = ($userid == "")?(""):(" AND userid='".$userid."'");
$categorypiece = ($category == "")?(""):(" AND category='".$category."'");
//$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");
$statuspiece = ($status == "")?(""):(" AND status LIKE '%".$status."%'");

if(isset($customer) && isset($dealer) && isset($employee)) { $callertype = ""; }
elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
elseif(isset($employee) && isset($customer)) { $callertype = "AND (callertype='employee' OR callertype='customer')"; }
elseif(isset($employee) && isset($dealer)) { $callertype = "AND (callertype='employee' OR callertype='dealer')"; }
elseif(isset($customer) && isset($dealer)) { $callertype = "AND (callertype='customer' OR callertype='dealer')"; }
elseif(isset($customer)) { $callertype = "AND callertype='customer'"; }
elseif(isset($dealer)) { $callertype = "AND callertype='dealer'"; }
elseif(isset($employee)) { $callertype = "AND callertype='employee'"; }*/


$output = "Date^*^date";
$query = "Select dates.date1 AS date1";
$query1 = " FROM (SELECT DISTINCT dates.date AS date1 FROM (";
$query3 = ") AS dates ORDER BY dates.date) AS dates ";
$addleftjoin = (count($registers) == 1 || count($registers) == count($registers) - 1) ? ("") : (" LEFT JOIN ");
for ($k = 0; $k < count($registers) - 1; $k++) {
	$addunion = ($k == 0) ? ("") : (" UNION ");
	/*********************************************** Call ************************************************************/
	if ($registers[$k] == 'call') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_callregister.userid='" . $userid . "'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_callregister.anonymous='" . $anonymous . "'");
		$categorypiece = ($category == "") ? ("") : (" AND ssm_callregister.category='" . $category . "'");
		//$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_callregister.status LIKE '%" . $status . "%'");

		if (isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) {
			$callertype = "";
		}
		/*elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }*/elseif (isset($employee) && isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($dealer) && isset($ssmuser) && isset($employee)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')";
		} elseif (isset($ssmuser) && isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer')";
		} elseif (isset($employee) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer')";
		} elseif (isset($employee) && isset($ssmuser)) {
			$callertype = "AND (callertype='employee' OR callertype='ssmuser')";
		} elseif (isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer)) {
			$callertype = "AND callertype='customer'";
		} elseif (isset($dealer)) {
			$callertype = "AND callertype='dealer'";
		} elseif (isset($employee)) {
			$callertype = "AND callertype='employee'";
		} elseif (isset($ssmuser)) {
			$callertype = "AND callertype='ssmuser'";
		}

		$output .= "^##^Calls^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , calldates.nos AS calldates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_callregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_callregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_callregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "'  " . $supportunitpiece . $callertype . $statuspiece . $anonymouspiece . $categorypiece . $userpiece . "  GROUP BY date ORDER BY date) AS calldates ON calldates.date = dates.date1 ";
	}
	/*********************************************** Email - Customer ************************************************************/elseif ($registers[$k] == 'email') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_emailregister.userid='" . $userid . "'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");

		$categorypiece = ($category == "") ? ("") : (" AND ssm_emailregister.category='" . $category . "'");
		//$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_emailregister.status LIKE '%" . $status . "%'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_emailregister.anonymous='" . $anonymous . "'");

		if (isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) {
			$callertype = "";
		}
		#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
		elseif (isset($employee) && isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($dealer) && isset($ssmuser) && isset($employee)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')";
		} elseif (isset($ssmuser) && isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer')";
		} elseif (isset($employee) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer')";
		} elseif (isset($employee) && isset($ssmuser)) {
			$callertype = "AND (callertype='employee' OR callertype='ssmuser')";
		} elseif (isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer)) {
			$callertype = "AND callertype='customer'";
		} elseif (isset($dealer)) {
			$callertype = "AND callertype='dealer'";
		} elseif (isset($employee)) {
			$callertype = "AND callertype='employee'";
		} elseif (isset($ssmuser)) {
			$callertype = "AND callertype='ssmuser'";
		}

		$output .= "^##^Emails^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , emaildates.nos AS emaildates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_emailregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_emailregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_emailregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' AND ssm_emailregister.anonymous='no' " . $supportunitpiece . $callertype . $statuspiece . $anonymouspiece . $categorypiece . $userpiece . "  GROUP BY date ORDER BY date) AS emaildates ON emaildates.date = dates.date1 ";
	}
	/*********************************************** Email - NC ************************************************************/elseif ($registers[$k] == 'emailnc') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_emailregister.userid='" . $userid . "'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_emailregister.status LIKE '%" . $status . "%'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_emailregister.anonymous='" . $anonymous . "'");

		$output .= "^##^Emails-NC^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , emailncdates.nos AS emailncdates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_emailregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_emailregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_emailregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' AND ssm_emailregister.anonymous='yes' " . $supportunitpiece . $statuspiece . $anonymouspiece . $userpiece . "  GROUP BY date ORDER BY date) AS emailncdates ON emailncdates.date = dates.date1 ";
	}
	/*********************************************** Error ************************************************************/elseif ($registers[$k] == 'error') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_errorregister.userid='" . $userid . "'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_errorregister.status LIKE '%" . $status . "%'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_errorregister.anonymous='" . $anonymous . "'");

		$output .= "^##^Errors^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , errordates.nos AS errordates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_errorregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_errorregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_errorregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_errorregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' " . $supportunitpiece . $callertype . $statuspiece . $anonymouspiece . $categorypiece . $userpiece . "  GROUP BY date ORDER BY date) AS errordates ON errordates.date = dates.date1 ";
	}
	/*********************************************** In-house ************************************************************/elseif ($registers[$k] == 'inhouse') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_inhouseregister.userid='" . $userid . "'");
		$categorypiece = ($category == "") ? ("") : (" AND ssm_inhouseregister.category='" . $category . "'");
		//$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_inhouseregister.status LIKE '%" . $status . "%'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_inhouseregister.anonymous='" . $anonymous . "'");
		if (isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) {
			$callertype = "";
		}
		#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
		elseif (isset($employee) && isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($dealer) && isset($ssmuser) && isset($employee)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')";
		} elseif (isset($ssmuser) && isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer')";
		} elseif (isset($employee) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer')";
		} elseif (isset($employee) && isset($ssmuser)) {
			$callertype = "AND (callertype='employee' OR callertype='ssmuser')";
		} elseif (isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer)) {
			$callertype = "AND callertype='customer'";
		} elseif (isset($dealer)) {
			$callertype = "AND callertype='dealer'";
		} elseif (isset($employee)) {
			$callertype = "AND callertype='employee'";
		} elseif (isset($ssmuser)) {
			$callertype = "AND callertype='ssmuser'";
		}

		$output .= "^##^Inhouse^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , inhousedates.nos AS inhousedates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_inhouseregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_inhouseregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_inhouseregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' " . $supportunitpiece . $callertype . $statuspiece . $categorypiece . $anonymouspiece . $userpiece . "  GROUP BY date ORDER BY date) AS inhousedates ON inhousedates.date = dates.date1 ";
	}
	/*********************************************** Onsite ************************************************************/elseif ($registers[$k] == 'onsite') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_onsiteregister.userid='" . $userid . "'");
		$categorypiece = ($category == "") ? ("") : (" AND ssm_onsiteregister.category='" . $category . "'");
		//$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_onsiteregister.status LIKE '%" . $status . "%'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_onsiteregister.anonymous='" . $anonymous . "'");
		if (isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) {
			$callertype = "";
		}
		#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
		elseif (isset($employee) && isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($dealer) && isset($ssmuser) && isset($employee)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')";
		} elseif (isset($ssmuser) && isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer')";
		} elseif (isset($employee) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer')";
		} elseif (isset($employee) && isset($ssmuser)) {
			$callertype = "AND (callertype='employee' OR callertype='ssmuser')";
		} elseif (isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer)) {
			$callertype = "AND callertype='customer'";
		} elseif (isset($dealer)) {
			$callertype = "AND callertype='dealer'";
		} elseif (isset($employee)) {
			$callertype = "AND callertype='employee'";
		} elseif (isset($ssmuser)) {
			$callertype = "AND callertype='ssmuser'";
		}

		$output .= "^##^Onsite^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , onsitedates.nos AS onsitedates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_onsiteregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_onsiteregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_onsiteregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' " . $supportunitpiece . $callertype . $statuspiece . $categorypiece . $anonymouspiece . $userpiece . "  GROUP BY date ORDER BY date) AS onsitedates ON onsitedates.date = dates.date1 ";
	}
	/*********************************************** Reference ************************************************************/elseif ($registers[$k] == 'reference') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_referenceregister.userid='" . $userid . "'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_referenceregister.status LIKE '%" . $status . "%'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_referenceregister.anonymous='" . $anonymous . "'");

		$output .= "^##^Reference^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , referencedates.nos AS referencedates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_referenceregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_referenceregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_referenceregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_referenceregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' " . $supportunitpiece . $statuspiece . $anonymouspiece . $userpiece . "  GROUP BY date ORDER BY date) AS referencedates ON referencedates.date = dates.date1 ";
	}
	/*********************************************** Requirement ************************************************************/elseif ($registers[$k] == 'requirement') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_requirementregister.userid='" . $userid . "'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_requirementregister.status LIKE '%" . $status . "%'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_requirementregister.anonymous='" . $anonymous . "'");

		$output .= "^##^Requirement^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , requirementdates.nos AS requirementdates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_requirementregister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_requirementregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_requirementregister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_requirementregister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' " . $supportunitpiece . $statuspiece . $anonymouspiece . $userpiece . "  GROUP BY date ORDER BY date) AS requirementdates ON requirementdates.date = dates.date1 ";
	}
	/*********************************************** Skype ************************************************************/elseif ($registers[$k] == 'skype') {
		$userpiece = ($userid == "") ? ("") : (" AND ssm_skyperegister.userid='" . $userid . "'");
		$categorypiece = ($category == "") ? ("") : (" AND ssm_skyperegister.category='" . $category . "'");
		//$categorypiece1 = ($category == "")?(""):(" OR category LIKE '%".$category."%'");
		$statuspiece = ($status == "") ? ("") : (" AND ssm_skyperegister.status LIKE '%" . $status . "%'");
		$supportunitpiece = ($supportunit == "") ? ("") : (" AND ssm_supportunits.slno='" . $supportunit . "'");
		$anonymouspiece = ($anonymous == "") ? ("") : (" AND ssm_skyperegister.anonymous='" . $anonymous . "'");

		if (isset($customer) && isset($dealer) && isset($employee) && isset($ssmuser)) {
			$callertype = "";
		}
		#elseif(!isset($customer) && !isset($dealer) && !isset($employee)) { $callertype = ""; }
		elseif (isset($employee) && isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='dealer' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($dealer) && isset($ssmuser) && isset($employee)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer' OR callertype='ssmuser')";
		} elseif (isset($ssmuser) && isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer' OR callertype='ssmuser')";
		} elseif (isset($employee) && isset($customer)) {
			$callertype = "AND (callertype='employee' OR callertype='customer')";
		} elseif (isset($employee) && isset($dealer)) {
			$callertype = "AND (callertype='employee' OR callertype='dealer')";
		} elseif (isset($employee) && isset($ssmuser)) {
			$callertype = "AND (callertype='employee' OR callertype='ssmuser')";
		} elseif (isset($customer) && isset($dealer)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($dealer) && isset($ssmuser)) {
			$callertype = "AND (callertype='customer' OR callertype='dealer')";
		} elseif (isset($customer)) {
			$callertype = "AND callertype='customer'";
		} elseif (isset($dealer)) {
			$callertype = "AND callertype='dealer'";
		} elseif (isset($employee)) {
			$callertype = "AND callertype='employee'";
		} elseif (isset($ssmuser)) {
			$callertype = "AND callertype='ssmuser'";
		}

		$output .= "^##^Skype^*^number^##^Title1^*^string^##^Text1^*^string";
		$query0 .= " , skypedates.nos AS skypedates, '' AS title1, '' AS text1 ";
		$query2 .= $addunion . " (SELECT DISTINCT date FROM ssm_skyperegister ) ";
		$query4 .= " LEFT JOIN (SELECT date, count(*) AS nos FROM ssm_skyperegister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid 
LEFT JOIN ssm_supportunits ON ssm_supportunits.slno = ssm_users.supportunit 
WHERE ssm_skyperegister.date BETWEEN '" . changedateformat($fromdate) . "' AND '" . changedateformat($todate) . "' " . $supportunitpiece . $callertype . $statuspiece . $anonymouspiece . $categorypiece . $userpiece . "  GROUP BY date ORDER BY date) AS skypedates ON skypedates.date = dates.date1 ";
	}
}
$output .= "^#*#^";
$query .= $query0 . $query1 . $query2 . $query3 . $query4;
$result = runmysqlquery($query);
$totalrows = mysqli_num_rows($result);
$count = 0;

while ($fetch = mysqli_fetch_row($result)) {
	$count++;
	$totalcolumns = count($fetch);
	for ($i = 0; $i < count($fetch); $i++) {
		if ($i == 0) {
			$date = explode("-", $fetch[$i]);
			$output .= $date[0];
			$output .= "^^";
			$output .= $date[1] - 1;
			$output .= "^^";
			$output .= (int) $date[2];
			$output .= "^*^";
		} else {
			$temp = $fetch[$i];
			if (($i + 2) % 3 == 0)
				$temp = ($fetch[$i] == "") ? "0" : $fetch[$i];
			$output .= $temp;
			if ($i <> ($totalcolumns - 1))
				$output .= "^*^";
		}
	}
	if ($count <> $totalrows)
		$output .= "^##^";
}

echo ($output);
//echo($output."\n\n\n\n\n\n\n\n".$query);

/*$output = "Date^*^date^##^Calls^*^number^##^Title1^*^string^##^Text1^*^string^##^Emails^*^number^##^Title2^*^string^##^Text2^*^string";
$output .= "^#*#^";

$query = "
Select dates.date1 AS date1, calldates.nos AS calldates, '' AS title1, '' AS text1, emaildates.nos AS emaildates, '' AS title2, '' AS text2 FROM
(
SELECT DISTINCT dates.date AS date1 FROM 
((SELECT DISTINCT date FROM ssm_callregister ) UNION (select distinct date from ssm_emailregister)) AS dates ORDER BY dates.date)
 AS dates
LEFT JOIN 
(select date, count(*) AS nos from ssm_callregister GROUP BY date ORDER BY date) AS calldates ON calldates.date = dates.date1
LEFT JOIN 
(select date, count(*) AS nos from ssm_emailregister GROUP BY date ORDER BY date) AS emaildates ON emaildates.date = dates.date1
";

$result = runmysqlquery($query);
$totalrows = mysqli_num_rows($result);
$count = 0;

while($fetch = mysqli_fetch_row($result))
{
	$count++;
	$totalcolumns = count($fetch);
	for($i = 0; $i < count($fetch); $i++)
	{
		if($i == 0)
		{
			$date = explode("-",$fetch[$i]);
			$output .= $date[0];
			$output .= "^^";
			$output .= $date[1] - 1;
			$output .= "^^";
			$output .= (int)$date[2];
			$output .= "^*^";
		}
		else
		{
			$temp = $fetch[$i];
			if(($i + 2) % 3 == 0)
				$temp = ($fetch[$i] == "")?"0":$fetch[$i];
			$output .= $temp;
			if($i <> ($totalcolumns - 1))
				$output .= "^*^";
		}
	}
	if($count <> $totalrows)
		$output .= "^##^";
}





echo($output);*/
//echo("Date^*^date^##^Calls^*^number^##^Title1^*^string^##^Text1^*^string^##^Emails^*^number^##^Title2^*^string^##^Text2^*^string^#*#^2009^^1^^1^*^8^*^^*^^*^3^*^^*^^##^2009^^1^^2^*^9^*^^*^^*^4^*^^*^^##^2009^^1^^3^*^10^*^^*^^*^8^*^^*^^##^2009^^1^^6^*^8^*^^*^^*^12^*^^*^^##^2009^^1^^7^*^2^*^^*^^*^4^*^^*^^##^2009^^1^^8^*^4^*^^*^^*^14^*^^*^");

?>