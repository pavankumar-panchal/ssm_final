<?php
	include('../functions/phpfunctions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../js/jquery-1.4.2.min.js?dummy=<?php echo (rand());?>" language="javascript"></script>
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="../js/jquery-ui.min.js"></script> 
<script type="text/javascript" language="javascript" src="../functions/daily-report.js"></script>
<body>
<table border="0" align="center" cellpadding="3" cellspacing="0" style="border:1px solid #6393df;">
<?php
	$serial = "1";
	$slno = $_POST['slno'];
	$custname = $_POST['customername'];
	$query1 = "select distinct(ssm_callregister.customername) from ssm_callregister 
	where ssm_callregister.customername = '".$custname."'  and  ssm_callregister.userid = '".$slno."'
	union
	select distinct(ssm_emailregister.customername) from ssm_emailregister 
	where ssm_emailregister.customername = '".$custname."'  and   ssm_emailregister.userid = '".$slno."'
	union
	select distinct(ssm_skyperegister.customername) from ssm_skyperegister 
	where ssm_skyperegister.customername = '".$custname."'  and  ssm_skyperegister.userid = '".$slno."' ";
	
	$result1 = runmysqlquery($query1);
	while($fetchrecord1 = mysqli_fetch_array($result1))
	{
		$customername = $fetchrecord1['customername'];
		echo "<tr>
				<td align='center' colspan='4'  class='headername'>".$customername."</td>
			</tr>";
		echo "<tr class='tr-grid-header'>
				<td nowrap ='nowrap' class='td-border-grid' width='10%'><strong>Sl.no.</strong></td>
				<td nowrap ='nowrap' class='td-border-grid' width='10%'><strong>ComplaintID</strong></td>
				<td nowrap ='nowrap' class='td-border-grid' width='10%'><strong>Calltype</strong></td>
				<td nowrap ='nowrap' class='td-border-grid' width='10%'><strong>Status</strong></td>
			</tr>";
		
		$query2 = "select ssm_callregister.customername,ssm_callregister.status,ssm_callregister.calltype,
		ssm_callregister.compliantid from ssm_callregister where  ssm_callregister.customername = '".$customername."'  and 
		ssm_callregister.userid = '".$slno."' "; 
		$result2 = runmysqlquery($query2);
		$i_n = 0 ;
		while($fetchrecord2 = mysqli_fetch_array($result2))
		 {
			$i_n++;
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			}
			else
			{
				$color = "#f7faff";
			}
			$calltype = $fetchrecord2['calltype'];
			$status =  $fetchrecord2['status'];
			$compliantidid = $fetchrecord2['compliantid'];
			$customername = $fetchrecord2['customername'];
			echo '<tr bgcolor='.$color.'>
					<td>'.$serial++.'</td>
					<td><a id="calldata" name="callsdata" title="callsdata list"  href="#"  
onclick="JavaScript:callingdatalist(\''.$compliantidid.'\');">'.$compliantidid.'</a></td>
					<td>Call('.$calltype.')</td>
					<td>'.$status.'</td>
				</tr>';
	 	  }
		  
		$query3 = "select ssm_skyperegister.customername,ssm_skyperegister.status,ssm_skyperegister.skypeid 
		from ssm_skyperegister 
		where ssm_skyperegister.customername = '".$customername."'  and ssm_skyperegister.userid = '".$slno."' "; 
		$result3 = runmysqlquery($query3);
		while($fetchrecord3 = mysqli_fetch_array($result3))
		 {
			$i_n++;
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			}
			else
			{
				$color = "#f7faff";
			}
			$status =  $fetchrecord3['status'];
			$skypeidid = $fetchrecord3['skypeid'];
			$customername = $fetchrecord3['customername'];
			echo '<tr bgcolor='.$color.'>
					<td>'.$serial++.'</td>
					<td><a id="calldata" name="chatsdata" title="chatsdata list"  href="#" 
onclick="JavaScript:chatsdatalist(\''.$skypeidid.'\');">'.$skypeidid.'</a></td>
					<td>Chat</td>
					<td>'.$status.'</td>
				</tr>';
	 	  }
		  
		  
		$query5 = "select ssm_emailregister.customername,ssm_emailregister.status ,ssm_emailregister.compliantid 
		from ssm_emailregister 
		where  ssm_emailregister.customername ='".$customername."'  and ssm_emailregister.userid = '".$slno."' "; 
		$result5 = runmysqlquery($query5);
		while($fetchrecord5 = mysqli_fetch_array($result5))
		 {	
		 	$i_n++;
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			}
			else
			{
				$color = "#f7faff";
			}
			$status =  $fetchrecord5['status'];
			$compliantidid = $fetchrecord5['compliantid'];
			$customername = $fetchrecord5['customername'];
			echo '<tr bgcolor='.$color.'>
					<td>'.$serial++.'</td>
					<td><a id="calldata" name="emaildata" title="emaildata list" href="#" 
onclick="JavaScript:emaildatalist(\''.$compliantidid.'\');">'.$compliantidid.'</a></td>
					<td>Mail</td>
					<td>'.$status.'</td>
				</tr>';
	 	  }
	}
?>
</table>
<div id="popup-error" align="center"></div>
</body>
</html>
