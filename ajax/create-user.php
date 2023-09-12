<?php

ob_start("ob_gzhandler"); 
include('../functions/phpfunctions.php');
if(!isset($_POST['lastslno']))
{
	$_POST['lastslno'] = null;	
}
$switchtype = $_POST['switchtype'];
$lastslno = $_POST['lastslno'];
switch($switchtype)
{
	case 'save':
	{
		$username = strtoupper($_POST['username']);
		if($lastslno != '')
		{
			$loginpassword = $_POST['password'];
			$query ="select AES_DECRYPT(loginpassword,'imaxpasswordkey') as loginpassword  from ssm_users 
			where slno = '".$lastslno."'";
			$result = runmysqlqueryfetch($query);
			$password =$result['loginpassword'];
			if($loginpassword <> $password)
			{
				$loginpassword = $_POST['password'];
			}
			else
			{				
				$loginpassword = generatepwd();
			}
		}
		elseif($lastslno == '')
		{
			$loginpassword = generatepwd();
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
		$disablelogin = $_POST['disablelogin'];
		$dol = $_POST['dol'];
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_users(username,loginpassword,type,existinguser,reportingauthority,supportunit,locationname,
			fullname,gender, presentaddress, permanentaddress, mobile, emergencynumber, emergencyremarks, dob,doj,designation,
			personalemail,officialemail,dol,password,disablelogin) values('".$username."',AES_ENCRYPT('".$loginpassword."',
			'imaxpasswordkey'),'".$type."','".$existinguser."','".$reportingauthority."','".$supportunit."','".$locationname."',
			'".$fullname."','".$gender."','".$presentaddress."','".$permanentaddress."','".$mobile."','".$emergencynumber."',
			'".$emergencyremarks."','".changedateformat($dob)."','".changedateformat($doj)."','".$designation."',
			'".$personalemail."','".$officialemail."','".changedateformat($dol)."','".$loginpassword."','".$disablelogin."')";
			$result = runmysqlquery($query);
		}
		else
		{
			if($loginpassword <> $password)
			{
				$query = "UPDATE ssm_users set username = '".$username."',loginpassword =AES_ENCRYPT('".$loginpassword."',
				'imaxpasswordkey'),type = '".$type."',existinguser = '".$existinguser."',
				reportingauthority = '".$reportingauthority."',supportunit = '".$supportunit."',
				locationname = '".$locationname."',fullname = '".$fullname."',gender = '".$gender."',
				presentaddress = '".$presentaddress."',permanentaddress = '".$permanentaddress."',mobile = '".$mobile."',
				emergencynumber = '".$emergencynumber."', emergencyremarks = '".$emergencyremarks."',
				dob = '".changedateformat($dob)."',doj = '".changedateformat($doj)."',designation = '".$designation."',
				personalemail = '".$personalemail."', officialemail = '".$officialemail."',dol = '".changedateformat($dol)."',
				disablelogin = '".$disablelogin."' where slno = '".$lastslno."'";
				$result = runmysqlquery($query);
			}
			else
			{
				$query = "UPDATE ssm_users set username = '".$username."',type = '".$type."',existinguser = '".$existinguser."',
				reportingauthority = '".$reportingauthority."',supportunit = '".$supportunit."',locationname = '".$locationname."',
				fullname = '".$fullname."',gender = '".$gender."',presentaddress = '".$presentaddress."',
				permanentaddress = '".$permanentaddress."',mobile = '".$mobile."',emergencynumber = '".$emergencynumber."', 
				emergencyremarks = '".$emergencyremarks."',dob = '".changedateformat($dob)."',doj = '".changedateformat($doj)."',
				designation = '".$designation."',personalemail = '".$personalemail."', officialemail = '".$officialemail."',
				dol = '".changedateformat($dol)."',disablelogin = '".$disablelogin."' where slno = '".$lastslno."'";
				$result = runmysqlquery($query);
			}
		}
	}
//	echo($query);
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
		if(!isset($_POST['slno']))
		{
			$_POST['slno'] = null;
			
		}
		if(!isset($_POST['showtype']))
		{
			$_POST['showtype'] = null;
		}
	
		$startlimit = $_POST['startlimit'];
		$slno1 = $_POST['slno'];
		$showtype = $_POST['showtype'];
		if($showtype == 'all')
		{
			$limit = 1000;
		}
		else
		{
			$limit = 10;
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_users where type <> 'admin'";
		$fetch1 = runmysqlqueryfetch($resultcount1);
		$fetchresultcount1 = $fetch1['count'];
		
		if($startlimit == '')
		{
			$startlimit = 0;
			$slno1 = 0;
		}
		else
		{
			$startlimit = $slno1 ;
			$slno1 = $slno1;
		}
		
		$query = "select s1.slno, s1.username, s2.username as reportingauthority,
		ssm_supportunits.heading as supportunit, s1.fullname, ssm_locationmaster.locationname,
		s1.mobile, s1.emergencynumber,s1.emergencyremarks, s1.doj,  s1.personalemail, 
		s1.officialemail, s1.dol, s1.existinguser ,s1.type 
		FROM ssm_users as s1 
		right join ssm_supportunits on s1.supportunit = ssm_supportunits.slno
		right join ssm_locationmaster on s1.locationname = ssm_locationmaster.slno
		left join ssm_users as s2 on (s1.reportingauthority = s2.slno)
		WHERE s1.type <> 'ADMIN' ORDER BY s1.slno DESC  LIMIT ".$startlimit.",".$limit."; ";
		
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="4" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
				<td width="10%" nowrap = "nowrap" class="td-border-grid">slno</td>
				<td nowrap = "nowrap" class="td-border-grid">User Name</td>
				<td nowrap = "nowrap" class="td-border-grid">Reporting Authority</td>
				<td nowrap = "nowrap" class="td-border-grid">Support Unit</td>
				<td nowrap = "nowrap" class="td-border-grid">Full Name</td>
				<td nowrap = "nowrap" class="td-border-grid">Location</td>
				<td nowrap = "nowrap" class="td-border-grid">Mobile</td>
				<td nowrap = "nowrap" class="td-border-grid">Emergency Number</td>
				<td nowrap = "nowrap" class="td-border-grid">Emergency Remarks</td>
				<td nowrap = "nowrap" class="td-border-grid">Date of Joining</td>
				<td nowrap = "nowrap" class="td-border-grid">Personal Email</td>
				<td nowrap = "nowrap" class="td-border-grid">Official Email</td>
				<td nowrap = "nowrap" class="td-border-grid">Date of Leaving</td>
			</tr>';
		}
		
		$result = runmysqlquery($query);
		$i_n = 0;
		$serial = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			
			$i_n++;
			$slno1++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
				
			 ## Assign Class For Category##
			  if($fetch[14]=='ADMIN')
			  { $categoryclass = 'admin';}
			  else if($fetch[14]=='EXECUTIVE-ONSITE')
			  { $categoryclass = 'onsite ';}
			  else if($fetch[14]=='EXECUTIVE-OTHERS')
			  { $categoryclass = 'general';}
			  else if($fetch[14]=='GUEST')
			  { $categoryclass = 'guest';}	
			  else if($fetch[14]=='MANAGEMENT')
			  { $categoryclass = 'management';}	
			  else if($fetch[14]=='TEAMLEADER')
			  { $categoryclass = 'teamleader';}	
			 
			 if($fetch['13'] == 'no')
			 {
				$color = "#c0d8db";
			 }
			
												 
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch)-2; $i++)
			{
				if($i == 0)
				{
				    $grid .= '<td  nowrap="nowrap"  class="td-border-grid" style="cursor:pointer">
					<div style="float:left;">'.$fetch[0].'</div><div class="'.$categoryclass.' category"></div></td>';
				}
				else if($i == 9 || $i == 14)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".changedateformat($fetch[$i])."</td>";
				}
				else
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".$fetch[$i]."</td>";
				}
			}
			$grid .= '</tr>';
		}
		if(!isset($linkgrid))
		{
			$linkgrid = null;	
		}
		if($slno1 >= $fetchresultcount1)
		{
			$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
							<tr>
								<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
							</tr>
						</table>';
		}
		else
		{
			$linkgrid .= '<table>
							<tr>
								<td class="resendtext">
									<div align ="left" style="padding-right:10px">
										<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');"
style="cursor:pointer" class="resendtext">Show More Records >> </a>
										<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a>&nbsp;&nbsp;&nbsp;</div>
								</td>
							</tr>
						</table>';
		}
		
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users  where type <> 'admin'");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count'].'|^^|'.$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT *,AES_DECRYPT(loginpassword,'imaxpasswordkey') as loginpassword  FROM ssm_users
		WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['username']."^".$result['loginpassword']."^".$result['type']."^"
		.$result['existinguser']."^".$result['reportingauthority']."^".$result['supportunit']."^".$result['locationname']."^"
		.$result['fullname']."^".$result['gender']."^".$result['presentaddress']."^".$result['permanentaddress']."^"
		.$result['mobile']."^".$result['emergencynumber']."^".$result['emergencyremarks']."^".changedateformat($result['dob']).
		"^".changedateformat($result['doj'])."^".$result['designation']."^".$result['personalemail']."^"
		.$result['officialemail']."^".changedateformat($result['dol'])."^".$result['disablelogin']);
	}
	break;
	
	case 'searchfilter':
	{
		if(!isset($_POST['slno']))
		{
			$_POST['slno'] = null;
			
		}
		if(!isset($_POST['showtype']))
		{
			$_POST['showtype'] = null;
		}
		$startlimit = $_POST['startlimit'];
		$slno1 = $_POST['slno'];
		$showtype = $_POST['showtype'];
		if($showtype == 'all')
		{
			$limit = 2000;
		}
		else
		{
			$limit = 10;
		}
		
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
			
			$resultcount1 = "SELECT  count(*) as count 
							FROM ssm_users as s1 
							right join ssm_supportunits on s1.supportunit = ssm_supportunits.slno
							right join ssm_locationmaster on s1.locationname = ssm_locationmaster.slno
							left join ssm_users as s2 on (s1.reportingauthority = s2.slno)
							WHERE  s1.".$textfield." ORDER BY s1.".$orderbyfield." ";
			$fetch1 = runmysqlqueryfetch($resultcount1);
			$fetchresultcount1 = $fetch1['count'];
			
			if($startlimit == '')
			{
				$startlimit = 0;
				$slno1 = 0;
			}
			else
			{
				$startlimit = $slno1 ;
				$slno1 = $slno1;
			}
		
			if($startlimit == 0)
			{
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">slno</td>
							<td nowrap = "nowrap" class="td-border-grid">User Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Existing User</td>
							<td nowrap = "nowrap" class="td-border-grid">Reporting Authority</td>
							<td nowrap = "nowrap" class="td-border-grid">Support Unit</td>
							<td nowrap = "nowrap" class="td-border-grid">Full Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Location</td>
							<td nowrap = "nowrap" class="td-border-grid">Gender</td>
							<td nowrap = "nowrap" class="td-border-grid">Present Address</td>
							<td nowrap = "nowrap" class="td-border-grid">Permanent Address</td>
							<td nowrap = "nowrap" class="td-border-grid">Mobile</td>
							<td nowrap = "nowrap" class="td-border-grid">Emergency Number</td>
							<td nowrap = "nowrap" class="td-border-grid">Emergency Remarks</td>
							<td nowrap = "nowrap" class="td-border-grid">Date of Birth</td>
							<td nowrap = "nowrap" class="td-border-grid">Date of Joining</td>
							<td nowrap = "nowrap" class="td-border-grid">Designation</td>
							<td nowrap = "nowrap" class="td-border-grid">Personal Email</td>
							<td nowrap = "nowrap" class="td-border-grid">Official Email</td>
							<td nowrap = "nowrap" class="td-border-grid">Date of Leaving</td>
						</tr>';
			}
			
			$query = "select  s1.slno,s1.username,s1.existinguser,s2.username as reportingauthority ,
			ssm_supportunits.heading as supportunit ,ssm_locationmaster.locationname,s1.fullname,s1.gender,s1.presentaddress,
			s1.permanentaddress,s1.mobile,s1.emergencynumber,s1.emergencyremarks,s1.dob,s1.doj,s1.designation,s1.personalemail,
			s1.officialemail,s1.dol,s1.type FROM ssm_users as s1 
			right join ssm_supportunits on s1.supportunit = ssm_supportunits.slno
			right join ssm_locationmaster on s1.locationname = ssm_locationmaster.slno
			left join ssm_users as s2 on (s1.reportingauthority = s2.slno)
			WHERE  s1.".$textfield." ORDER BY s1.".$orderbyfield." LIMIT ".$startlimit.",".$limit."; ";
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				
				$i_n++;
				$color;
				$slno1++;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
					
					
			  if($fetch[19]=='ADMIN')
			  { $categoryclass = 'admin';}
			  else if($fetch[19]=='EXECUTIVE-ONSITE')
			  { $categoryclass = 'onsite ';}
			  else if($fetch[19]=='EXECUTIVE-OTHERS')
			  { $categoryclass = 'general';}
			  else if($fetch[19]=='GUEST')
			  { $categoryclass = 'guest';}	
			  else if($fetch[19]=='MANAGEMENT')
			  { $categoryclass = 'management';}	
			  else if($fetch[19]=='TEAMLEADER')
			  { $categoryclass = 'teamleader';}
						
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch)-1; $i++)
			{
				if($i == 0)
				{
				    $grid .= '<td nowrap="nowrap"  class="td-border-grid" style="cursor:pointer">
					<div style="float:left">'.$fetch[0].'</div><div class="'.$categoryclass.' category"></div></td>';
				}
				else if($i == 15 || $i == 14 || $i == 19)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".changedateformat($fetch[$i])."</td>";
				}
				else
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".$fetch[$i]."</td>";
				}
			}
			$grid .= '</tr>';
			}
			$grid .= '</table>';
			if(!isset($linkgrid))
			{
				$linkgrid = null;	
			}
		
			if($slno1 >= $fetchresultcount1)
			{
				$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px">
								<tr>
									<td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td>
								</tr>
							</table>';
			}
			else
			{
				$linkgrid .= '<table>
								<tr>
									<td class="resendtext">
										<div align ="left" style="padding-right:10px">
											<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');"
	style="cursor:pointer" class="resendtext">Show More Records >> </a>
											<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" 
	style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a>&nbsp;&nbsp;&nbsp;</div>
									</td>
								</tr>
							</table>';
		}
		
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_users");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count'].'|^^|'.$linkgrid);
		}
	}
	break;
}
?>