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
		$dealercompanyname = $_POST['dealercompanyname'];
		$dealername = $_POST['dealername'];
		$contactnumber = $_POST['contactnumber'];
		$emailid = $_POST['emailid'];
		$category = $_POST['category'];
		$place = $_POST['place'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$skypeid = $_POST['skypeid'];		
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_dealermaster(dealercompanyname,dealername,contactnumber,emailid,category,place,district,
			state,skypeid) VALUES('".$dealercompanyname."','".$dealername."','".$contactnumber."','".$emailid."','".$category."',
			'".$place."','".$district."','".$state."','".$skypeid."')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_dealermaster SET dealercompanyname = '".$dealercompanyname."',dealername = '".$dealername."',
			contactnumber = '".$contactnumber."',emailid = '".$emailid."',category = '".$category."',place = '".$place."',
			district = '".$district."',state = '".$state."',skypeid = '".$skypeid."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."saved successfully");
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_dealermaster WHERE slno = '".$lastslno."'";
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
			$limit = 10000;
		}
		else
		{
			$limit = 10;
		}
		$resultcount1 = "SELECT  count(*) as count FROM ssm_dealermaster";
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
		
		$query = "SELECT * FROM ssm_dealermaster ORDER BY slno LIMIT ".$startlimit.",".$limit."";
		if($startlimit == 0)
		{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Dealer Company Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Dealer Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Contact Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
					<td nowrap = "nowrap" class="td-border-grid">Category</td>
					<td nowrap = "nowrap" class="td-border-grid">Place</td>
					<td nowrap = "nowrap" class="td-border-grid">District</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Skype ID</td>
				</tr>';
		}
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			$slno1++;
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			}
			else
			{
				$color = "#f7faff";
			}
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
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
								<td class="resendtext"><div align ="left" style="padding-right:10px">
								<a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> </a><a onclick ="getmore(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
							</tr>
						</table>';
		}
		$fetchcount1 = mysqli_num_rows($result);
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_dealermaster ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT * FROM ssm_dealermaster WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['dealercompanyname']."^".$result['dealername']."^".$result['contactnumber']."^"
		.$result['emailid']."^".$result['category']."^".$result['place']."^".$result['district']."^".$result['state']."^"
		.$result['skypeid']);
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
		if(!isset($_POST['startlimit']))
		{
			$_POST['startlimit'] = null;
		}
		$startlimit = $_POST['startlimit'];
		$slno1 = $_POST['slno'];
		$showtype = $_POST['showtype'];
		if($showtype == 'all')
		{
			$limit = 200;
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
				case 'slno': $orderbyfield = 'slno'; break;
				case 'dealercompanyname': $orderbyfield = 'dealercompanyname'; break;
				case 'dealername': $orderbyfield = 'dealername'; break;
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
				case 'dealercompanyname': $textfield = "dealercompanyname LIKE '%".$searchcriteria."%'"; break;
				case 'dealername': $textfield = "dealername LIKE '%".$searchcriteria."%'"; break;
				case 'contactnumber': $textfield = "contactnumber LIKE '%".$searchcriteria."%'"; break;
				case 'emailid': $textfield = "emailid LIKE '%".$searchcriteria."%'"; break;
				case 'category': $textfield = "category LIKE '%".$searchcriteria."%'"; break;
				case 'place': $textfield = "place LIKE '%".$searchcriteria."%'"; break;
				case 'district': $textfield = "district LIKE '%".$searchcriteria."%'"; break;
				case 'state': $textfield = "state LIKE '%".$searchcriteria."%'"; break;
				case 'skypeid': $textfield = "skypeid LIKE '%".$searchcriteria."%'"; break;
			}
			$resultcount = "SELECT  count(*) as count FROM ssm_dealermaster  
			WHERE ".$textfield." ORDER BY ".$orderbyfield." ";
			$fetch1 = runmysqlqueryfetch($resultcount);
			$fetchresultcount = $fetch1['count'];
			
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
		
			$query = "SELECT * FROM ssm_dealermaster WHERE ".$textfield." ORDER BY ".$orderbyfield."
			LIMIT ".$startlimit.",".$limit;
			if($startlimit == 0)
			{
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Dealer Company Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Dealer Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Contact Number</td>
							<td nowrap = "nowrap" class="td-border-grid">Email ID</td>
							<td nowrap = "nowrap" class="td-border-grid">Category</td>
							<td nowrap = "nowrap" class="td-border-grid">Place</td>
							<td nowrap = "nowrap" class="td-border-grid">District</td>
							<td nowrap = "nowrap" class="td-border-grid">State</td>
							<td nowrap = "nowrap" class="td-border-grid">Skype ID</td>
						</tr>';
			}
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_row($result))
			{
				$i_n++;
				$color;
				$slno1++;
				if($i_n%2 == 0)
				{
					$color = "#edf4ff";
				}
				else
				{
					$color = "#f7faff";
				}
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch[$i]."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			if(!isset($linkgrid))
			{
				$linkgrid = null;	
			}
			if($slno1 >= $fetchresultcount)
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
									<td class="resendtext"><div align ="left" style="padding-right:10px">
									<a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >> </a><a onclick ="getmorerecords(\''.$startlimit.'\',\''.$slno1.'\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></a>&nbsp;&nbsp;&nbsp;</div></td>
								</tr>
							</table>';
			}
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_dealermaster");
			echo($grid."|^^|"."Filtered ".$fetchresultcount." records found from ".$query['count'].'|^^|'.$linkgrid);
		}
	}
	break;
}
?>