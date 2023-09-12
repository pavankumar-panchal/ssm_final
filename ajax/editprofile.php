<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
$type = $_POST['type'];
switch($type)
{
	case 'generatedata':
	{
		$query = "SELECT * FROM ssm_users where slno = '".$user."'";
		$fetch = runmysqlqueryfetch($query);
		echo($fetch['slno'].'^'.$fetch['fullname'].'^'.$fetch['gender'].'^'.$fetch['presentaddress'].'^'.
		$fetch['permanentaddress'].'^'.$fetch['mobile'].'^'.$fetch['emergencynumber'].'^'.$fetch['emergencyremarks'].'^'.
		changedateformat($fetch['dob']).'^'.changedateformat($fetch['doj']).'^'.$fetch['designation'].'^'.
		$fetch['personalemail'].'^'.$fetch['officialemail']);
	}
	break;
	case 'update':
	{
		$fullname = $_POST['fullname'];
		$gender = $_POST['gender'];
		$presentaddress = $_POST['presentaddress'];
		$permanentaddress = $_POST['permanentaddress'];
		$mobile = $_POST['mobile'];
		$emergencynumber = $_POST['emergencynumber'];
		$emergencyremarks = $_POST['emergencyremarks'];
		$dob = $_POST['dob'];
		$doj = $_POST['doj'];
		$designation = $_POST['designation'];
		$personalemail = $_POST['personalemail'];
		$officialemail = $_POST['officialemail'];
		
		$query = "UPDATE ssm_users SET fullname = '".$fullname."', gender = '".$gender."',
		presentaddress = '".$presentaddress."', permanentaddress = '".$permanentaddress."', mobile = '".$mobile."',
		emergencynumber = '".$emergencynumber."', emergencyremarks = '".$emergencyremarks."', dob = '".changedateformat($dob)."', 
		doj = '".changedateformat($doj)."', designation = '".$designation."', personalemail = '".$personalemail."', 
		officialemail = '".$officialemail."' WHERE slno = '".$user."'";
		$result = runmysqlquery($query);
		
		echo("1^"."Record Saved Successfully.");
	}
	break;
}
?>
