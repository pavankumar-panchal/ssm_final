<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
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
		$oscompanyname = $_POST['oscompanyname'];
		$osname = $_POST['osname'];
		$contactnumber = $_POST['contactnumber'];
		$emailid = $_POST['emailid'];
		$category = $_POST['category'];
		$place = $_POST['place'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$skypeid = $_POST['skypeid'];		
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_osmaster(oscompanyname,osname,contactnumber,emailid,category,place,district,state,skypeid) VALUES('".$oscompanyname."','".$osname."','".$contactnumber."','".$emailid."','".$category."','".$place."','".$district."','".$state."','".$skypeid."')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_osmaster SET oscompanyname = '".$oscompanyname."',osname = '".$osname."',contactnumber = '".$contactnumber."',emailid = '".$emailid."',category = '".$category."',place = '".$place."',district = '".$district."',state = '".$state."',skypeid = '".$skypeid."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."saved successfully");
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_osmaster WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."deleted successfully");
	break;
	
	case 'generategrid':
	{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">OS Company Name</td><td nowrap = "nowrap" class="td-border-grid">OS Name</td><td nowrap = "nowrap" class="td-border-grid">Contact Number</td><td nowrap = "nowrap" class="td-border-grid">Email ID</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Place</td><td nowrap = "nowrap" class="td-border-grid">District</td><td nowrap = "nowrap" class="td-border-grid">State</td><td nowrap = "nowrap" class="td-border-grid">Skype ID</td></tr>';
		$query = "SELECT * FROM ssm_osmaster ORDER BY slno";
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;			
			if($i_n%2 == 0) $color = "#edf4ff";
			else $color = "#f7faff";
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
	$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_osmaster");
	echo($grid."|^^|"." ".$fetchcount ." records found from ".$query['count']).".";
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT * FROM ssm_osmaster WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['oscompanyname']."^".$result['osname']."^".$result['contactnumber']."^".$result['emailid']."^".$result['category']."^".$result['place']."^".$result['district']."^".$result['state']."^".$result['skypeid']);
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
				case 'slno': $orderbyfield = 'slno'; break;
				case 'oscompanyname': $orderbyfield = 'oscompanyname'; break;
				case 'osname': $orderbyfield = 'osname'; break;
				case 'contactnumber': $orderbyfield = 'contactnumber'; break;
				case 'emailid': $orderbyfield = 'emailid'; break;
				case 'category': $orderbyfield = 'category'; break;
				case 'place': $orderbyfield = 'place'; break;
				case 'district': $orderbyfield = 'district'; break;
				case 'state': $orderbyfield = 'state'; break;
				case 'skypeid': $orderbyfield = 'skypeid'; break;
			}
			switch ($selection)
			{
				case 'slno': $textfield = "slno LIKE '%".$searchcriteria."%'"; break;
				case 'oscompanyname': $textfield = "oscompanyname LIKE '%".$searchcriteria."%'"; break;
				case 'osname': $textfield = "osname LIKE '%".$searchcriteria."%'"; break;
				case 'contactnumber': $textfield = "contactnumber LIKE '%".$searchcriteria."%'"; break;
				case 'emailid': $textfield = "emailid LIKE '%".$searchcriteria."%'"; break;
				case 'category': $textfield = "category LIKE '%".$searchcriteria."%'"; break;
				case 'place': $textfield = "place LIKE '%".$searchcriteria."%'"; break;
				case 'district': $textfield = "district LIKE '%".$searchcriteria."%'"; break;
				case 'state': $textfield = "state LIKE '%".$searchcriteria."%'"; break;
				case 'skypeid': $textfield = "skypeid LIKE '%".$searchcriteria."%'"; break;
			}
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">OS Company Name</td><td nowrap = "nowrap" class="td-border-grid">OS Name</td><td nowrap = "nowrap" class="td-border-grid">Contact Number</td><td nowrap = "nowrap" class="td-border-grid">Email ID</td><td nowrap = "nowrap" class="td-border-grid">Category</td><td nowrap = "nowrap" class="td-border-grid">Place</td><td nowrap = "nowrap" class="td-border-grid">District</td><td nowrap = "nowrap" class="td-border-grid">State</td><td nowrap = "nowrap" class="td-border-grid">Skype ID</td></tr>';
			
			$query = "SELECT * FROM ssm_osmaster WHERE ".$textfield." ORDER BY ".$orderbyfield;
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;			
				if($i_n%2 == 0) $color = "#edf4ff";
				else $color = "#f7faff";
$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_osmaster");
			echo($grid."|^^|"."Filtered ".$fetchcount ." records found from ".$query['count']).".";
		}
	}
	break;
}
?>