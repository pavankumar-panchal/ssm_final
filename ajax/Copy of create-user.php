<?php

ob_start("ob_gzhandler"); 
include('../functions/phpfunctions.php');
$switchtype = $_POST['switchtype'];
$lastslno = $_POST['lastslno'];
switch($switchtype)
{
	case 'save':
	{
		$username = strtoupper($_POST['username']);
		$loginpassword = $_POST['password'];
		if($lastslno != '')
		{
			$query ="select AES_DECRYPT(loginpassword,'imaxpasswordkey') as loginpassword  from ssm_users where slno = '".$lastslno."'";
			$result = runmysqlqueryfetch($query);
			$password =$result['loginpassword'];
			if($loginpassword <> $password)
			{
				$loginpassword = generatepwd();
			}
			else
			{
				$loginpassword = $_POST['password'];
			}
		}
		$type = $_POST['type'];
		$existinguser = $_POST['existinguser'];
		$reportingauthority = $_POST['reportingauthority'];
		$supportunit = $_POST['supportunit'];
		$locationname = $_POST['locationname'];
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
		$dol = $_POST['dol'];
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_users(username,loginpassword,type,existinguser,reportingauthority,supportunit,locationname,fullname,gender, presentaddress, permanentaddress, mobile, emergencynumber, emergencyremarks, dob,doj,designation,personalemail,officialemail,dol) values('".$username."',AES_ENCRYPT('".$loginpassword."','imaxpasswordkey'),'".$type."','".$existinguser."','".$reportingauthority."','".$supportunit."','".$locationname."','".$fullname."','".$gender."','".$presentaddress."','".$permanentaddress."','".$mobile."','".$emergencynumber."','".$emergencyremarks."','".changedateformat($dob)."','".changedateformat($doj)."','".$designation."','".$personalemail."','".$officialemail."','".changedateformat($dol)."')";
			$result = runmysqlquery($query);
		}
		else
		{
			if($loginpassword <> $password)
			{
				$query = "UPDATE ssm_users set username = '".$username."',loginpassword =AES_ENCRYPT('".$loginpassword."','imaxpasswordkey'),type = '".$type."',existinguser = '".$existinguser."',reportingauthority = '".$reportingauthority."',supportunit = '".$supportunit."',locationname = '".$locationname."',fullname = '".$fullname."',gender = '".$gender."',presentaddress = '".$presentaddress."',permanentaddress = '".$permanentaddress."',mobile = '".$mobile."',emergencynumber = '".$emergencynumber."', emergencyremarks = '".$emergencyremarks."',dob = '".changedateformat($dob)."',doj = '".changedateformat($doj)."',designation = '".$designation."',personalemail = '".$personalemail."', officialemail = '".$officialemail."',dol = '".changedateformat($dol)."' where slno = '".$lastslno."'";
				$result = runmysqlquery($query);
			}
			else
			{
				$query = "UPDATE ssm_users set username = '".$username."',type = '".$type."',existinguser = '".$existinguser."',reportingauthority = '".$reportingauthority."',supportunit = '".$supportunit."',locationname = '".$locationname."',fullname = '".$fullname."',gender = '".$gender."',presentaddress = '".$presentaddress."',permanentaddress = '".$permanentaddress."',mobile = '".$mobile."',emergencynumber = '".$emergencynumber."', emergencyremarks = '".$emergencyremarks."',dob = '".changedateformat($dob)."',doj = '".changedateformat($doj)."',designation = '".$designation."',personalemail = '".$personalemail."', officialemail = '".$officialemail."',dol = '".changedateformat($dol)."' where slno = '".$lastslno."'";
				$result = runmysqlquery($query);
			}
		}
	}
	//echo($loginpassword.$password);
	echo("1^"."saved successfully".$query);
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_users WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."deleted successfully");
	break;
	
	case 'generategrid':
	{
		$grid = '<table width="100%" cellpadding="4" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">slno</td><td nowrap = "nowrap" class="td-border-grid">User Name</td><td nowrap = "nowrap" class="td-border-grid">Type</td><td nowrap = "nowrap" class="td-border-grid">Existing User</td><td nowrap = "nowrap" class="td-border-grid">Reporting Authority</td><td nowrap = "nowrap" class="td-border-grid">Support Unit</td><td nowrap = "nowrap" class="td-border-grid">Location</td><td nowrap = "nowrap" class="td-border-grid">Full Name</td><td nowrap = "nowrap" class="td-border-grid">Gender</td><td nowrap = "nowrap" class="td-border-grid">Present Address</td><td nowrap = "nowrap" class="td-border-grid">Permanent Address</td><td nowrap = "nowrap" class="td-border-grid">Mobile</td><td nowrap = "nowrap" class="td-border-grid">Emergency Number</td><td nowrap = "nowrap" class="td-border-grid">Emergency Remarks</td><td nowrap = "nowrap" class="td-border-grid">Date of Birth</td><td nowrap = "nowrap" class="td-border-grid">Date of Joining</td><td nowrap = "nowrap" class="td-border-grid">Designation</td><td nowrap = "nowrap" class="td-border-grid">Personal Email</td><td nowrap = "nowrap" class="td-border-grid">Official Email</td><td nowrap = "nowrap" class="td-border-grid">Date of Leaving</td></tr>';
		$query = "select  slno,username,type,existinguser,reportingauthority,supportunit,fullname,locationname,gender,presentaddress,permanentaddress,
mobile,emergencynumber,emergencyremarks,dob,doj,designation,personalemail,officialemail,dol FROM ssm_users WHERE type <> 'ADMIN' ORDER BY slno";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			//$slno++;
			$i_n++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			//$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno."</td>";
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 13 || $i == 14 || $i == 18)
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".changedateformat($fetch[$i])."</td>";
				else
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".$fetch[$i]."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
	}
	$fetchcount = mysqli_num_rows($result);
	$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users");
	echo($grid."|^^|".$fetchcount ." records found from ".$query['count']).".";
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT *,AES_DECRYPT(loginpassword,'imaxpasswordkey') as loginpassword  FROM ssm_users WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['username']."^".$result['loginpassword']."^".$result['type']."^".$result['existinguser']."^".$result['reportingauthority']."^".$result['supportunit']."^".$result['locationname']."^".$result['fullname']."^".$result['gender']."^".$result['presentaddress']."^".$result['permanentaddress']."^".$result['mobile']."^".$result['emergencynumber']."^".$result['emergencyremarks']."^".changedateformat($result['dob'])."^".changedateformat($result['doj'])."^".$result['designation']."^".$result['personalemail']."^".$result['officialemail']."^".changedateformat($result['dol']));
	}
	break;
	
	case 'searchfilter':
	{
		$searchcriteria = $_POST['searchcriteria'];
		$selection = $_POST['selection'];
		$orderby = $_POST['orderby'];
		
		if(strlen($searchcriteria) > 0)
		{
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
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">slno</td><td nowrap = "nowrap" class="td-border-grid">User Name</td><td nowrap = "nowrap" class="td-border-grid">Type</td><td nowrap = "nowrap" class="td-border-grid">Existing User</td><td nowrap = "nowrap" class="td-border-grid">Reporting Authority</td><td nowrap = "nowrap" class="td-border-grid">Support Unit</td><td nowrap = "nowrap" class="td-border-grid">Location</td><td nowrap = "nowrap" class="td-border-grid">Full Name</td><td nowrap = "nowrap" class="td-border-grid">Gender</td><td nowrap = "nowrap" class="td-border-grid">Present Address</td><td nowrap = "nowrap" class="td-border-grid">Permanent Address</td><td nowrap = "nowrap" class="td-border-grid">Mobile</td><td nowrap = "nowrap" class="td-border-grid">Emergency Number</td><td nowrap = "nowrap" class="td-border-grid">Emergency Remarks</td><td nowrap = "nowrap" class="td-border-grid">Date of Birth</td><td nowrap = "nowrap" class="td-border-grid">Date of Joining</td><td nowrap = "nowrap" class="td-border-grid">Designation</td><td nowrap = "nowrap" class="td-border-grid">Personal Email</td><td nowrap = "nowrap" class="td-border-grid">Official Email</td><td nowrap = "nowrap" class="td-border-grid">Date of Leaving</td></tr>';
			
			$query = "SELECT * FROM ssm_users WHERE ".$textfield." ORDER BY ".$orderbyfield;
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
				if($i == 15 || $i == 16 || $i == 20)
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".changedateformat($fetch[$i])."</td>";
				elseif($i <> 2)
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".$fetch[$i]."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users");
			echo($grid."|^^|"."Filtered ".$fetchcount." records found from ".$query['count']).".";
		}
	}
	break;
}
?>