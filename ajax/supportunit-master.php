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
		$heading = $_POST['heading'];
		$remarks = $_POST['remarks'];
		if($lastslno == '')
		{
			$query = "INSERT INTO ssm_supportunits(heading,remarks) VALUES('".$heading."','".$remarks."')";
			$result = runmysqlquery($query);
		}
		else
		{
			$query = "UPDATE ssm_supportunits SET heading = '".$heading."',remarks = '".$remarks."' WHERE slno = '".$lastslno."'";
			$result = runmysqlquery($query);
		}
	}
	echo("1^"."saved successfully");
	break;
	
	case 'delete':
	{
		$query = "DELETE FROM ssm_supportunits WHERE slno = '".$lastslno."'";
		$result = runmysqlquery($query);
	}
	echo("2^"."deleted successfully");
	break;
	
	case 'generategrid':
	{
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Category Heading</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td></tr>';
		$query = "SELECT * FROM ssm_supportunits ORDER BY slno";
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
				$grid .= "<td nowrap='nowrap' class='td-border-grid' >".$fetch[$i]."</td>";
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>';
	}
	$fetchcount = mysqli_num_rows($result);
	$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_supportunits");
	echo($grid."|^^|"." ".$fetchcount ." records found from ".$query['count']).".";
	break;
	
	case 'gridtoform':
	{
		$query = "SELECT * FROM ssm_supportunits WHERE slno = '".$lastslno."'";
		$result = runmysqlqueryfetch($query);
		echo($result['slno']."^".$result['heading']."^".$result['remarks']);
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
				case 'heading': $orderbyfield = 'heading'; break;
				case 'remarks': $orderbyfield = 'remarks'; break;
			}
			switch ($selection)
			{
				case 'heading': $textfield = "heading LIKE '%".$searchcriteria."%'"; break;
				case 'remarks': $textfield = "remarks LIKE '%".$searchcriteria."%'"; break;
			}
			$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Category Heading</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td></tr>';
			
			$query = "SELECT * FROM ssm_supportunits WHERE ".$textfield." ORDER BY ".$orderbyfield;
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
					$grid .= "<td nowrap='nowrap' class='td-border-grid' >".$fetch[$i]."</td>";
				}
				$grid .= '</tr>';
			}
			$grid .= '</table>';
			$fetchcount = mysqli_num_rows($result);
			$query = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_supportunits");
			echo($grid."|^^|"."Filtered ".$fetchcount ." records found from ".$query['count']).".";
		}
	}
	break;
}
?>