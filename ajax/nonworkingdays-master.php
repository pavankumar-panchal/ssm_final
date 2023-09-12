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
		$date = $_POST['date'];
		$occassion = $_POST['occassion'];
		$remarks = $_POST['remarks'];
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_nonworkingdays(date,occassion,remarks) values('".changedateformat($date)."',
			'".$occassion."','".$remarks."')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_nonworkingdays SET date = '".changedateformat($date)."',occassion = '".$occassion."',
			remarks = '".$remarks."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."saved successfully");
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_nonworkingdays WHERE slno = '".$lastslno."'";
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_nonworkingdays where YEAR(date) = YEAR(CURDATE()) 
		order by date";
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
		
		$query = "select date,occassion,remarks,slno FROM ssm_nonworkingdays where YEAR(date) = YEAR(CURDATE()) 
		order by date LIMIT ".$startlimit.",".$limit."";
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Date</td>
						<td nowrap = "nowrap" class="td-border-grid">Occassion</td>
						<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
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
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[3].');" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno1."</td>";
			for($i = 0; $i < count($fetch)-1; $i++)
			{
				if($i == 0)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
				else
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
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_nonworkingdays where YEAR(date) = YEAR(CURDATE()) 
		order by date");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT * FROM ssm_nonworkingdays WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".changedateformat($result['date'])."^".$result['occassion']."^".$result['remarks']);
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
				case 'date': $orderbyfield = 'date'; break;
				case 'occassion': $orderbyfield = 'occassion'; break;
				case 'remarks': $orderbyfield = 'remarks'; break;
			}
			switch ($selection)
			{
				case 'slno': $textfield = "slno LIKE '%".$searchcriteria."%'"; break;
				case 'date': $textfield = "date LIKE '%".$searchcriteria."%'"; break;
				case 'occassion': $textfield = "occassion LIKE '%".$searchcriteria."%'"; break;
			}
			
			$resultcount = "SELECT  count(*) as count FROM ssm_nonworkingdays  
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
		
			$query = "SELECT date,occassion,remarks,slno FROM ssm_nonworkingdays WHERE ".$textfield." 
			ORDER BY ".$orderbyfield." LIMIT ".$startlimit.",".$limit;
			if($startlimit == 0)
			{
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Date</td>
							<td nowrap = "nowrap" class="td-border-grid">Occassion</td>
							<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
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
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[3].');" bgcolor='.$color.'>';
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno1."</td>";
				for($i = 0; $i < count($fetch) - 1; $i++)
				{
					if($i == 0)
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch[$i])."</td>";
					else
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
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_nonworkingdays");
			echo($grid."|^^|"."Filtered ".$fetchresultcount." records found from ".$query['count'].'|^^|'.$linkgrid);
		}
	}
	break;
}
?>