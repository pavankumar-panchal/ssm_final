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
		$productgroup = $_POST['s_productgroup'];
		$productname = $_POST['productname'];
		$productversion = $_POST['productversion'];
		$releasedate = $_POST['releasedate'];
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_versions(productname,productversion,releasedate,productgroup) values('".$productname."','".$productversion."','".changedateformat($releasedate)."','".$productgroup."')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_versions SET productname = '".$productname."',productversion = '".$productversion."',
			releasedate = '".changedateformat($releasedate)."' , productgroup = '".$productgroup."' 
			WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."saved successfully");
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_versions WHERE slno = '".$lastslno."'";
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_versions";
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
		
		$query = "SELECT ssm_versions.productgroup,ssm_products.productname,ssm_versions.productversion,
				 ssm_versions.releasedate, ssm_versions.slno FROM ssm_versions  
				 LEFT JOIN ssm_products ON ssm_products.slno = ssm_versions.productname  
				 order by ssm_versions.releasedate desc LIMIT ".$startlimit.",".$limit."";
		
		if($startlimit == 0)
		{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">Release Date</td>
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
			if(!isset($fetch[4])){$fetch[4] = '';}
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[4].');" bgcolor='.$color.'>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno1."</td>";
			for($i = 0; $i < count($fetch)-1; $i++)
			{
				if($i == 4)
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
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_versions ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count']."|^^|".$linkgrid);
	}
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT slno,productname,productversion,releasedate,productgroup FROM ssm_versions WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['productname']."^".$result['productversion']."^".
		changedateformat($result['releasedate'])."^".$result['productgroup']);
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
		
		$s_productgroup = $_POST['s_productgroup'];
		$searchcriteria = $_POST['searchcriteria'];
		$selection = $_POST['selection'];
		$orderby = $_POST['orderby'];
		
		if(strlen($searchcriteria) > 0 || strlen($s_productgroup) > 0)
		{
			switch($orderby)
			{
				case 'slno': $orderbyfield = 'ssm_versions.slno'; break;
				case 'productgroup': $orderbyfield = 'ssm_versions.productgroup'; break;
				case 'productname': $orderbyfield = 'ssm_products.productname'; break;
				case 'productversion': $orderbyfield = 'ssm_versions.productversion'; break;
				case 'releasedate': $orderbyfield = 'ssm_versions.releasedate'; break;
			}
			switch ($selection)
			{
				case 'slno': $textfield = "ssm_versions.slno LIKE '%".$searchcriteria."%'"; break;
				case 'productgroup': $textfield = "ssm_versions.productgroup LIKE '%".$s_productgroup."%'"; break;
				case 'productname': $textfield = "ssm_products.productname LIKE '%".$searchcriteria."%'"; break;
				case 'releasedate': $textfield = "ssm_versions.releasedate LIKE '%".changedateformat($searchcriteria)."%'"; break;
			}
			
			$resultcount = "SELECT  count(*) as count FROM ssm_versions 
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_versions.productname    
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
			$query = "SELECT ssm_versions.slno ,ssm_versions.productgroup,
			ssm_products.productname,ssm_versions.productversion,
			ssm_versions.releasedate  FROM ssm_versions  
			LEFT JOIN ssm_products ON ssm_products.slno = ssm_versions.productname   
			WHERE ".$textfield." ORDER BY ".$orderbyfield." LIMIT ".$startlimit.",".$limit;
			
			if($startlimit == 0)
			{
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
							<td nowrap = "nowrap" class="td-border-grid">Release Date</td>
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
				if(!isset($fetch[0]))
				{
					$fetch[0] = null;	
				}
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch); $i++)
				{
					if($i == 4)
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_versions");
		echo($grid."|^^|"."Filtered ".$fetchresultcount." records found from ".$query['count'].'|^^|'.$linkgrid);
		}
	}
	break;
}
?>