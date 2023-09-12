<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
include('../inc/checktype.php');
if($_POST['type'] == 'gridtoform')
{
	$textfield = $_POST['textfield'];
	$subselection = $_POST['subselection'];
	$orderby = $_POST['orderby'];
	
	if(strlen($textfield) > 0)
	{
		switch($orderby)
		{
			case "customerid":
				$orderbyfield = "ssm_invoice.customerid";
				break;
			case "userid":
				$orderbyfield = "ssm_invoice.userid";
				break;
			default:
				$orderbyfield = "ssm_invoice.customername";
				break;
		}
		switch($subselection)
		{
			case "customerid":
				$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno 
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno 
				WHERE ssm_invoice.customerid LIKE '%".$textfield."%' ORDER BY  `date` DESC ,".$orderbyfield;
				break;
			case "registername":
			echo	$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno 
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno 
				WHERE ssm_invoice.registername LIKE '%".$textfield."%' ORDER BY `date` DESC , ".$orderbyfield;
				break;
			case "userid":
				$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno  
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				WHERE ssm_invoice.userid LIKE '%".$textfield."%' ORDER BY `date` DESC , ".$orderbyfield;
				break;
			case "date":
				$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno 
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno 
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				WHERE ssm_invoice.date LIKE '%".$textfield."%' ORDER BY `date` DESC , ".$orderbyfield;
				break;
			case "productname":
				$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno  
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				WHERE ssm_invoice.productname LIKE '%".$textfield."%' ORDER BY `date` DESC , ".$orderbyfield;
				break;
			case "billno":
				$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno 
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno 
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				WHERE ssm_invoice.billno LIKE '%".$textfield."%' ORDER BY `date` DESC , ".$orderbyfield;
				break;
			case "billdate":
				$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno 
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno 
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				WHERE ssm_invoice.billdate LIKE '%".$textfield."%' ORDER BY `date` DESC , ".$orderbyfield;
				break;
			default:
				$query = "SELECT ssm_invoice.customername as customername,ssm_invoice.customerid as customerid,
				ssm_invoice.date as date ,ssm_invoice.time as time, 
				ssm_invoice.productgroup as productgroup,ssm_products.productname AS productname,
				ssm_invoice.productversion as productversion,inv_mas_state.statename as state,
				ssm_invoice.billdate as billdate,ssm_invoice.registername as registername,
				ssm_invoice.billno as billno,ssm_invoice.billto as billto,ssm_invoice.amount as amount,
				ssm_invoice.tax as tax ,ssm_invoice.tamount as tamount ,s2.username as billedby,
				ssm_invoice.remarks  as remarks,s1.username AS userid,ssm_invoice.complaintid AS complaintid,
				ssm_invoice.authorized as authorized,ssm_invoice.authorizedgroup as authorizedgroup,
				ssm_invoice.teamleaderremarks as teamleaderremarks,
				ssm_invoice.authorizedperson as authorizedperson, ssm_invoice.authorizeddatetime as authorizeddatetime,
				ssm_invoice.flag as flag, ssm_invoice.publishrecord as publishrecord
				FROM ssm_invoice
				LEFT JOIN ssm_products on ssm_invoice.productname = ssm_products.slno
				left join ssm_users as s1 on ssm_invoice.userid = s1.slno 
				left join ssm_users as s2 on ssm_invoice.billedby = s2.slno 
				left join inv_mas_state on inv_mas_state.statecode = ssm_invoice.state
				WHERE ssm_invoice.customername LIKE '%".$textfield."%' ORDER BY `date` DESC , ".$orderbyfield;
				break;
		}
		$grid = '<form name="gridformcustomer" id="gridformcustomer">
					<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		
		$grid .= '<tr class="tr-grid-header">
					<td nowrap = "nowrap" class="td-border-grid">Select</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Customer Id</td>
					<td nowrap = "nowrap" class="td-border-grid">Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Product Version</td>
					<td nowrap = "nowrap" class="td-border-grid">State</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Date</td>
					<td nowrap = "nowrap" class="td-border-grid">Register Name</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Number</td>
					<td nowrap = "nowrap" class="td-border-grid">Bill Given To</td>
					<td nowrap = "nowrap" class="td-border-grid">Amount</td>
					<td nowrap = "nowrap" class="td-border-grid">Tax</td>
					<td nowrap = "nowrap" class="td-border-grid">Total Amount</td>
					<td nowrap = "nowrap" class="td-border-grid">Billed By</td>
					<td nowrap = "nowrap" class="td-border-grid">Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Entered By</td>
					<td nowrap = "nowrap" class="td-border-grid">Compliant Id</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Group</td>
					<td nowrap = "nowrap" class="td-border-grid">Team Leader Remarks</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Person</td>
					<td nowrap = "nowrap" class="td-border-grid">Authorized Date&Time</td>
					<td nowrap = "nowrap" class="td-border-grid">Flag</td>
					<td nowrap = "nowrap" class="td-border-grid">Publish Record</td>
					</tr>';
		
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_array($result))
		{
			$i_n++;
			$color;
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			}
			else
			{
					$color = "#f7faff";
			}
			static $count = 0;
			$count++;
			$radioid = 'invoiceloadcustomerradio'.$count;
			$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadinvoiceregistersetselect(\''.$fetch['customername'].'\',\''.$fetch['customerid'].'\',\''.$fetch['billno'].'\',\''.changedateformat($fetch['billdate']).'\'); " bgcolor='.$color.'>';
			
			$grid .= "<td nowrap='nowrap'><input type='radio' name='invoiceloadcustomerradio' value=".$fetch['customerid']." id=".$radioid." onclick=\"loadinvoiceregistersetselect('".$fetch['customername']."','".$fetch['customerid']."','".$fetch['billno']."','".$fetch['billdate']."');\" /></td>
		
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['customername']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['customerid']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".changedateformat($fetch['date'])."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['time']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['productgroup']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['productname']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['productversion']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['state']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['billdate']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['registername']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['billno']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['billto']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['amount']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['tax']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['tamount']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['billedby']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['userid']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['complaintid']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorized']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizedgroup']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['teamleaderremarks']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizedperson']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['authorizeddatetime']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['flag']."</td>
					<td nowrap='nowrap' class='td-border-grid'>".$fetch['publishrecord']."</td>";
			$grid .= '</tr>';
		}
		$grid .= '</table></form>';
		echo($grid);
	}
}
?>