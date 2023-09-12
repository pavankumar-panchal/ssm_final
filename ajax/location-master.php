<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
if(!isset($_POST['lastslno']))
{
	$_POST['lastslno'] = null;	
}
$type = $_POST['type'];
$lastslno = $_POST['lastslno'];

switch($type)
{
	case 'save':
	{
		$locationname = $_POST['locationname'];
		$businessname = $_POST['businessname'];
		$address = $_POST['address'];
		$place = $_POST['place'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$phone = $_POST['phone'];
		$emailid = $_POST['emailid'];
		$locationincharge = $_POST['locationincharge'];
		
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_locationmaster(locationname,businessname,address,place,district,state,phone,emailid,locationincharge) value('".$locationname."','".$businessname."','".$address."','".$place."','".$district."','".$state."','".$phone."','".$emailid."','".$locationincharge."')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_locationmaster set locationname = '".$locationname."',businessname = '".$businessname."',address = '".$address."',place = '".$place."',district = '".$district."',state = '".$state."',phone = '".$phone."',emailid = '".$emailid."',locationincharge = '".$locationincharge."' where slno = '".$lastslno."'";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."saved successfully");
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_locationmaster WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."deleted successfully");
	break;
	
	case 'generategrid':
	{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Location Name</td><td nowrap = "nowrap" class="td-border-grid">Business Name</td><td nowrap = "nowrap" class="td-border-grid">Address</td><td nowrap = "nowrap" class="td-border-grid">Place</td><td nowrap = "nowrap" class="td-border-grid">District</td><td nowrap = "nowrap" class="td-border-grid">State</td><td nowrap = "nowrap" class="td-border-grid">Phone</td><td nowrap = "nowrap" class="td-border-grid">Email ID</td><td nowrap = "nowrap" class="td-border-grid">Location Incharge</td></tr>';
		$query = "SELECT * FROM ssm_locationmaster ORDER BY slno";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
	}
	$fetchcount = mysqli_num_rows($result);
	$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_locationmaster");
	echo($grid."|^^|"." ".$fetchcount ." records found from ".$query['count']).".";
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT * FROM ssm_locationmaster WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['locationname']."^".$result['businessname']."^".$result['address']."^".$result['place']."^".$result['district']."^".$result['state']."^".$result['phone']."^".$result['emailid']."^".$result['locationincharge']);
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
				case 'locationname': $orderbyfield = 'locationname'; break;
				case 'businessname': $orderbyfield = 'businessname'; break;
				case 'address': $orderbyfield = 'address'; break;
				case 'place': $orderbyfield = 'place'; break;
				case 'district': $orderbyfield = 'district'; break;
				case 'state': $orderbyfield = 'state'; break;
				case 'phone': $orderbyfield = 'phone'; break;
				case 'emailid': $orderbyfield = 'emailid'; break;
				case 'locationincharge': $orderbyfield = 'locationincharge'; break;
			}
			switch ($selection)
			{
				case 'locationname': $textfield = "locationname LIKE '%".$searchcriteria."%'"; break;
				case 'businessname': $textfield = "businessname LIKE '%".$searchcriteria."%'"; break;
				case 'address': $textfield = "address LIKE '%".$searchcriteria."%'"; break;
				case 'phone': $textfield = "phone LIKE '%".$searchcriteria."%'"; break;
				case 'place': $textfield = "place LIKE '%".$searchcriteria."%'"; break;
				case 'district': $textfield = "district LIKE '%".$searchcriteria."%'"; break;
				case 'state': $textfield = "state LIKE '%".$searchcriteria."%'"; break;
				case 'emailid': $textfield = "emailid LIKE '%".$searchcriteria."%'"; break;
				case 'locationincharge': $textfield = "locationincharge LIKE '%".$searchcriteria."%'"; break;
			}
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Location Name</td><td nowrap = "nowrap" class="td-border-grid">Business Name</td><td nowrap = "nowrap" class="td-border-grid">Address</td><td nowrap = "nowrap" class="td-border-grid">Place</td><td nowrap = "nowrap" class="td-border-grid">District</td><td nowrap = "nowrap" class="td-border-grid">State</td><td nowrap = "nowrap" class="td-border-grid">Phone</td><td nowrap = "nowrap" class="td-border-grid">Email ID</td><td nowrap = "nowrap" class="td-border-grid">Location Incharge</td></tr>';
			
			$query = "SELECT * FROM ssm_locationmaster WHERE ".$textfield." ORDER BY ".$orderbyfield;
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_locationmaster");
			echo($grid."|^^|"."Filtered ".$fetchcount ." records found from ".$query['count']).".";
		}
	}
	break;
}
?>