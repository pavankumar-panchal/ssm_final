<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername'];
		$s_customerid = $_POST['s_customerid']; $s_billno = $_POST['s_billno']; $s_billdate = $_POST['s_billdate'];
		$s_receiptno = $_POST['s_receiptno']; $s_receiptdate = $_POST['s_receiptdate']; $s_chequeno = $_POST['s_chequeno']; 
		$s_amount = $_POST['s_amount']; $s_userid = $_POST['s_userid']; $orderby = $_POST['orderby'];
		
		$s_customernamepiece = ($s_customername == "")?(""):(" AND customername='".$s_customername."'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND customerid='".$s_customerid."'");
		$s_billdatepiece = ($s_billdate == "")?(""):(" AND billdate ='".$s_billdate."'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND billno ='".$s_billno."'");
		$s_receiptnopiece = ($s_receiptno == "")?(""):(" AND receiptno ='".$s_receiptno."'");
		$s_receiptdatepiece = ($s_receiptdate == "")?(""):(" AND receiptdate ='".$s_receiptdate."'");
		$s_chequenopiece = ($s_chequeno == "")?(""):(" AND chequeno ='".$s_chequeno."'");
		$s_amountpiece = ($s_amount == "")?(""):(" AND amount ='".$s_amount."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND userid ='".$s_userid."'");
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'customername'; break;
			case 'customerid': $orderbyfield = 'customerid'; break;
			case 'billno': $orderbyfield = 'billno'; break;
			case 'billdate': $orderbyfield = 'billdate'; break;
			case 'receiptno': $orderbyfield = 'receiptno'; break;
			case 'receiptdate': $orderbyfield = 'receiptdate'; break;
			case 'chequeno': $orderbyfield = 'chequeno'; break;
			case 'userid': $orderbyfield = 'userid'; break;
		}
$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0"><tr bgcolor="#F79646">
<td><font color = "#FFFFFF">Sl No</font></td><td><font color = "#FFFFFF">Customer Name</font></td><td><font color = "#FFFFFF">Customer ID</font></td><td><font color = "#FFFFFF">Date</font></td><td><font color = "#FFFFFF">Time</font></td><td><font color = "#FFFFFF">Bill Date</font></td><td><font color = "#FFFFFF">Bill Number</font></td><td><font color = "#FFFFFF">Receipt Number</font></td><td><font color = "#FFFFFF">Receipt Date</font></td><td><font color = "#FFFFFF">Cheque / Cash</font></td><td><font color = "#FFFFFF">Cheque Number</font></td><td><font color = "#FFFFFF">Amount</font></td><td><font color = "#FFFFFF">Remarks</font></td><td><font color = "#FFFFFF">User ID</font></td><td><font color = "#FFFFFF">Authorized</font></td><td><font color = "#FFFFFF">Authorized Group</font></td><td><font color = "#FFFFFF">Team Leader Remarks</font></td><td><font color = "#FFFFFF">Authorized Person</font></td><td><font color = "#FFFFFF">Authorized Date&Time</font></td><td><font color = "#FFFFFF">Flag</td></tr>';
		$query = "SELECT * FROM ssm_receipts WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_billdatepiece.$s_billnopiece.$s_receiptnopiece.$s_receiptdatepiece.$s_chequenopiece.$s_amountpiece.$s_useridpiece." ORDER BY `date` DESC , ".$orderbyfield;
		$result = runmysqlquery($query);
		$i_n = 0;
		while($fetch = mysqli_fetch_row($result))
		{
			$i_n++;
			$color;
			if($i_n%2 == 0)
			$color = "#FCD5B4";
		else
			$color = "#FDE9D9";
			$grid .= '<tr nowrap="nowrap" bgcolor='.$color.'>';
			for($i = 0; $i < count($fetch); $i++)
			{
				if($i == 3 || $i == 5 || $i == 8)
				$grid .= '<td><font color="#000000">'.changedateformat($fetch[$i]).'</font></td>';
				elseif($i == 13)
				{
					$ufetch = runmysqlqueryfetch("Select ssm_users.username as username from  ssm_users WHERE ssm_users.slno = '".$fetch[$i]."'");	
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($ufetch['username'], 75, "<br />\n")."</td>";			
				}
				elseif($i == 15 && $fetch[$i] <> '')
				{
					$gfetch = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category WHERE ssm_category.slno = '".$fetch[$i]."'");	
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>".wordwrap($gfetch['categoryheading'], 75, "<br />\n")."</td>";			
				}
				else
				$grid .= '<td><font color="#000000">'.wordwrap($fetch[$i], 100, "<br />\n").'</font></td>';
			}
			$grid .= '</tr>';
		}
		$grid .= '</table>	</td>
  </tr>
</table>';
	
		$localdate = datetimelocal('Ymd');
		$localtime = datetimelocal('His');
		$filebasename = "S_RB".$localdate."-".$localtime.".xls";
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/support/uploads/'.$filebasename;
		$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/uploads/'.$filebasename;
		
		$fp = fopen($filepath,"wa+");
		if($fp)
		{
			fwrite($fp,$grid);
			downloadfile($filepath);
			fclose($fp);
		} 
?>
