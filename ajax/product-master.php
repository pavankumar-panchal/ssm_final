<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
$type = $_POST['type'];
$lastslno = $_POST['lastslno'];

switch($type)
{
	case 'save':
	{
		$productname = $_POST['productname'];
		$shortformat = $_POST['shortformat'];
		$productgroup = $_POST['productgroup'];
		$productinuse = $_POST['productinuse'];		
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_products(productname,shortformat,productgroup,productinuse) values('".$productname."',
			'".$shortformat."','".$productgroup."','".$productinuse."')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_products SET productname = '".$productname."',shortformat = '".$shortformat."',
			productinuse = '".$productinuse."' ,productgroup =  '".$productgroup."'  WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."saved successfully");
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_products WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."deleted successfully");
	break;
	case 'generategrid':
	{
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
		$resultcount1 = "SELECT  count(*) as count FROM ssm_products";
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
		
		
		$query = "SELECT slno,productname,shortformat,productinuse,productgroup FROM ssm_products ORDER BY slno 
		LIMIT ".$startlimit.",".$limit."";
		if($startlimit == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header">
						<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
						<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
						<td nowrap = "nowrap" class="td-border-grid">Short Format</td>
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
			if($fetch['3'] == 'no')
			{
				$color = "#c0d8db";;	
			}
				
			if($fetch['4'] == 'TAXATION')
			{
				$categoryclass = 'taxation';
			}
			else if($fetch['4'] == 'ACCOUNTS')
			{
				$categoryclass = 'accounts';	
			}
			else if($fetch['4'] == 'PAYROLL')
			{
				$categoryclass = 'payroll';
			}
			else if($fetch['4'] == 'OTHERS')
			{
				$categoryclass = 'others';
			}
				
			$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
			
			for($i = 0; $i < count($fetch)-2; $i++)
			{
				if($i == 0 && $fetch[4] <> '')
				{
				    $grid .= '<td nowrap="nowrap"  class="td-border-grid" style="cursor:pointer">
					<div style="float:left">'.$fetch[0].'</div><div class="'.$categoryclass.' category"></div></td>';
				}
				else
				{
					$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".$fetch[$i]."</td>";
				}
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
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
		$query2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_products ");
		echo($grid.'|^^|'."Filtered ".$fetchresultcount1." records found from ".$query2['count']."|^^|".$linkgrid);
	}
	/*$fetchcount = mysqli_num_rows($result);
	$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_products");
	echo($grid."|^^|"." ".$fetchcount ." records found from ".$query['count']).".";*/
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT * FROM ssm_products WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['productname']."^".$result['shortformat']."^".$result['productgroup']
		."^".$result['productinuse']);
	}
	break;
	
	case 'searchfilter':
	{
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
				case 'productname': $orderbyfield = 'productname'; break;
				case 'shortformat': $orderbyfield = 'shortformat'; break;
				case 'productgroup': $orderbyfield = 'productgroup'; break;
				case 'productinuse': $orderbyfield = 'productinuse'; break;
				
			}
			switch ($selection)
			{
				case 'slno': $textfield = "slno LIKE '%".$searchcriteria."%'"; break;
				case 'productname': $textfield = "productname LIKE '%".$searchcriteria."%'"; break;
				case 'shortformat': $textfield = "shortformat LIKE '%".$searchcriteria."%'"; break;
				case 'productgroup': $textfield = "productgroup LIKE '%".$searchcriteria."%'"; break;	
				case 'productinuse': $textfield = "productinuse LIKE '%".$searchcriteria."%'"; break;			
			}
			
			$resultcount = "SELECT  count(*) as count FROM ssm_products  
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
		
			$query = "SELECT slno,productname,shortformat,productinuse,productgroup FROM ssm_products WHERE ".$textfield." 
			ORDER BY ".$orderbyfield." LIMIT ".$startlimit.",".$limit;
			if($startlimit == 0)
			{
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header">
							<td nowrap = "nowrap" class="td-border-grid">Sl No</td>
							<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
							<td nowrap = "nowrap" class="td-border-grid">Short Format</td>
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
				
				if($fetch['4'] == 'TAXATION')
				{
					$categoryclass = 'taxation';
				}
				else if($fetch['4'] == 'ACCOUNTS')
				{
					$categoryclass = 'accounts';	
				}
				else if($fetch['4'] == 'PAYROLL')
				{
					$categoryclass = 'payroll';
				}
				else if($fetch['4'] == 'OTHERS')
				{
					$categoryclass = 'others';
				}
				
				$grid .= '<tr class="gridrow" onclick="javascript:gridtoform('.$fetch[0].');" bgcolor='.$color.'>';
				for($i = 0; $i < count($fetch)-2; $i++)
				{
					if($i == 0 && $fetch[4] <> '')
					{
						$grid .= '<td nowrap="nowrap"  class="td-border-grid" style="cursor:pointer">
						<div style="float:left">'.$fetch[0].'</div><div class="'.$categoryclass.' category"></div></td>';
					}
					else
					{
						$grid .= "<td nowrap='nowrap' class='td-border-grid' style='cursor:pointer'>".$fetch[$i]."</td>";
					}
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
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
		$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_products");
		echo($grid."|^^|"."Filtered ".$fetchresultcount." records found from ".$query['count'].'|^^|'.$linkgrid);
		}
	}
	break;
}
?>