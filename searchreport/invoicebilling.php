
<?php
include('../functions/phpfunctions.php');
ini_set('memory_limit', '1024M');
		$fromdate = $_POST['fromdate']; $todate = $_POST['todate']; $s_customername = $_POST['s_customername'];
		$s_customerid = $_POST['s_customerid']; $s_productname = $_POST['s_productname']; $s_billno = $_POST['s_billno'];
		$s_billdate = $_POST['s_billdate']; $s_registername = $_POST['s_registername']; $s_billedby = $_POST['s_billedby'];
		$s_amount = $_POST['s_amount']; $s_userid = $_POST['s_userid']; $s_complaintid = $_POST['s_complaintid'];
		$orderby = $_POST['orderby'];
		$s_customernamepiece = ($s_customername == "")?(""):(" AND customername='".$s_customername."'");
		$s_customeridpiece = ($s_customerid == "")?(""):(" AND customerid='".$s_customerid."'");
		$s_productnamepiece = ($s_productname == "")?(""):(" AND productname ='".$s_productname."'");
		$s_billnopiece = ($s_billno == "")?(""):(" AND billno='".$s_billno."'");
		$s_billdatepiece = ($s_billdate == "")?(""):(" AND billdate='".$s_billdate."'");
		$s_registernamepiece = ($s_registername == "")?(""):(" AND registername='".$s_registername."'");
		$s_billedbypiece = ($s_billedby == "")?(""):(" AND billedby='".$s_billedby."'");
		$s_amountpiece = ($s_amount == "")?(""):(" AND amount='".$s_amount."'");
		$s_useridpiece = ($s_userid == "")?(""):(" AND userid='".$s_userid."'");
		$s_complaintidpiece = ($s_complaintid == "")?(""):(" AND complaintid='".$s_complaintid."'");	
		
		switch($orderby)
		{
			case 'customername': $orderbyfield = 'customername'; break;
			case 'customerid': $orderbyfield = 'customerid'; break;
			case 'productname': $orderbyfield = 'productname'; break;
			case 'billno': $orderbyfield = 'billno'; break;
			case 'billdate': $orderbyfield = 'billdate'; break;
			case 'registername': $orderbyfield = 'registername'; break;
			case 'billedby': $orderbyfield = 'billedby'; break;
			case 'amount': $orderbyfield = 'amount'; break;
			case 'userid': $orderbyfield = 'userid'; break;
			case 'complaintid': $orderbyfield = 'complaintid'; break;		
		}
$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
    <td><table  border="1" bordercolor = "#FFFFFF" cellspacing="0" cellpadding="0">
<tr bgcolor="#F79646"><td><font color="#FFFFFF">Sl No</font></td><td><font color="#FFFFFF">Customer Name</font></td><td><font color="#FFFFFF">Customer Id</font></td><td><font color="#FFFFFF">Date</font></td><td><font color="#FFFFFF">Time</font></td><td><font color="#FFFFFF">Product Name</font></td><td><font color="#FFFFFF">Product Version</font></td><td><font color="#FFFFFF">Bill Date</font></td><td><font color="#FFFFFF">Register Name</font></td><td><font color="#FFFFFF">Bill Number</font></td><td><font color="#FFFFFF">Bill Given To</font></td><td><font color="#FFFFFF">Amount</font></td><td><font color="#FFFFFF">Tax</font></td><td><font color="#FFFFFF">Total Amount</font></td><td><font color="#FFFFFF">Billed By</font></td><td><font color="#FFFFFF">Remarks</font></td><td><font color="#FFFFFF">User Name</font></td><td><font color="#FFFFFF">Complaint Id</font></td><td><font color="#FFFFFF">Authorized</font></td><td><font color="#FFFFFF">Authorized Group</font></td><td><font color="#FFFFFF">Team Leader Remarks</font></td><td><font color="#FFFFFF">Authorized Person</font></td><td><font color="#FFFFFF">Authorized Date &amp; Time</font></td><td><font color="#FFFFFF">Flag</font></td></tr>';
		$query = "SELECT * FROM ssm_invoice WHERE date BETWEEN '".changedateformat($fromdate)."' AND '".changedateformat($todate)."'".$s_customernamepiece.$s_customeridpiece.$s_productnamepiece.$s_billnopiece.$s_billdatepiece.$s_registernamepiece.$s_billedbypiece.$s_amountpiece.$s_useridpiece.$s_complaintidpiece." ORDER BY `date` DESC , ".$orderbyfield;
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
				if($i == 3)
				$grid .= '<td><font color="#000000">'.changedateformat($fetch[$i]).'</font></td>';
				elseif($i == 5)
				{
					$pfetch = runmysqlqueryfetch("Select ssm_products.slno as slno, ssm_products.productname as productname from  ssm_products WHERE ssm_products.slno = '".$fetch[$i]."'");	
					$grid .= "<td><font color='#000000'>".wordwrap($pfetch['productname'], 75, "<br />\n")."</font></td>";			
				}
				elseif($i == 16)
				{
					$ufetch = runmysqlqueryfetch("Select ssm_users.username as username from  ssm_users WHERE ssm_users.slno = '".$fetch[$i]."'");	
					$grid .= "<td><font color='#000000'>".wordwrap($ufetch['username'], 75, "<br />\n")."</font></td>";			
				}
				elseif($i == 19 && $fetch[$i] <> '')
				{
					$gfetch = runmysqlqueryfetch("Select ssm_category.categoryheading as categoryheading from  ssm_category WHERE ssm_category.slno = '".$fetch[$i]."'");	
					$grid .= "<td><font color='#000000'>".wordwrap($gfetch['categoryheading'], 75, "<br />\n")."</font></td>";			
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
		$filebasename = "S_IB".$localdate."-".$localtime.".xls";
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
