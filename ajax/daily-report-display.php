<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="../js/jquery-1.4.2.min.js?dummy=<?php echo (rand());?>" language="javascript"></script>
<script src="../js/jquery-ui.min.js"></script> 
<style>
	#text
		{
			background: rgb(240,249,255); /* Old browsers */
			background: -moz-linear-gradient(top,  rgba(240,249,255,1) 99%, rgba(161,219,255,1) 99%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(99%,rgba(240,249,255,1)), color-stop(99%,rgba(161,219,255,1))); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  rgba(240,249,255,1) 99%,rgba(161,219,255,1) 99%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  rgba(240,249,255,1) 99%,rgba(161,219,255,1) 99%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  rgba(240,249,255,1) 99%,rgba(161,219,255,1) 99%); /* IE10+ */
			background: linear-gradient(to bottom,  rgba(240,249,255,1) 99%,rgba(161,219,255,1) 99%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0f9ff', endColorstr='#a1dbff',GradientType=0 ); /* IE6-9 */
			border:1px solid #FFFFFF;
			color:#000;
			width:375px;
		}
</style>

</head>
<body>
<form method="post">
<?php
include('../functions/phpfunctions.php');
$type = $_POST['type'];
$serial = "1";
switch($type)
{
	case 'callsdatalist':
	{
		$compliantidid = $_POST['compliantidid'];
		$query9 = "select  *, CONCAT(`date`,' ',`time`) as times  from ssm_callregister 
		where compliantid = '".$compliantidid."'";
		$result9 = runmysqlquery($query9);
		while($fetchrecord9 = mysqli_fetch_array($result9))
		{
			$customername = $fetchrecord9['customername'];
			$customerid = $fetchrecord9['customerid'];
			$date = $fetchrecord9['times'];
			$compliantid = $fetchrecord9['compliantid'];
			$personname = $fetchrecord9['personname'];
			$category = $fetchrecord9['category'];
			$callertype = $fetchrecord9['callertype'];
			$productname = $fetchrecord9['productname'];
			$productversion = $fetchrecord9['productversion'];
			$problem = $fetchrecord9['problem'];
			$stremoteconnection = $fetchrecord9['stremoteconnection'];
			$remarks = $fetchrecord9['remarks'];
			$authorized = $fetchrecord9['authorized'];
			$authorizedgroup = $fetchrecord9['authorizedgroup'];
			$teamleaderremarks = $fetchrecord9['teamleaderremarks'];
			$authorizedperson = $fetchrecord9['authorizedperson'];
			$authorizeddatetime = $fetchrecord9['authorizeddatetime'];
			$endtime = $fetchrecord9['endtime'];
			$i_n = '';
			if($i_n%2 == 0)
			{
				$color = "#edf4ff";
			
			}
			else
			{
				$color = "#f7faff";
			}
			$calls = '<table cellpadding="3" align="center" width="80%" cellspacing="0" style="border:1px solid #6393df;">
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Customer Name</td>
							<td colspan="3" id="text">'.$customername.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Customer ID</td>
							<td id="text">'.$customerid.'</td>
							<td nowrap ="nowrap" class="td-border-grid">Date</td>
							<td id="text">'.$date.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">PersonName</td>
							<td id="text">'.$personname.'</td>
							<td nowrap ="nowrap" class="td-border-grid">Category</td>
							<td id="text">'.$category.'</td>
						</tr>
						<tr class="headerclass" bgcolor='.$color.'>
							<td nowrap ="nowrap" class="td-border-grid">CallerType</td>
							<td id="text">'.$callertype.'</td>
							<td nowrap ="nowrap" class="td-border-grid">ProductName</td>
							<td id="text">'.$productname.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">ProductVersion</td>
							<td id="text">'.$productversion.'</td>
							<td nowrap ="nowrap" class="td-border-grid">Problem</td>
							<td id="text">'.$problem.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">TeamLeaderremarks</td>
							<td id="text">'.$teamleaderremarks.'</td>
							<td nowrap ="nowrap" class="td-border-grid">Remarks</td>
							<td id="text" >'.$remarks.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Authorized</td>
							<td id="text">'.$authorized.'</td>
							<td nowrap ="nowrap" class="td-border-grid">AuthorizedGroup</td>
							<td id="text">'.$authorizedgroup.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">AuthorizedDateTime</td>
							<td id="text">'.$authorizeddatetime.'</td>
							<td nowrap ="nowrap" class="td-border-grid">AuthorizedPerson</td>
							<td id="text">'.$authorizedperson.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">StreRmoteConnection</td>
							<td id="text">'.$stremoteconnection.'</td>
							<td nowrap ="nowrap" class="td-border-grid">EndTime</td>
							<td id="text">'.$endtime.'</td>
						</tr></table>';
		}
		echo $calls;
	}
	break;
	case 'chatsdatalist':
	{	
		$skypeidid = $_POST['skypeidid'];
		$query4 = "select * , CONCAT(`date`,' ',`time`) as times from ssm_skyperegister where skypeid = '".$skypeidid."'";
		$result4 = runmysqlquery($query4);
		while($fetchrecord4 = mysqli_fetch_array($result4))
		{
			$customername = $fetchrecord4['customername'];
			$customerid = $fetchrecord4['customerid'];
			$date = $fetchrecord4['times'];
			$sender = $fetchrecord4['sender'];
			$category = $fetchrecord4['category'];
			$callertype = $fetchrecord4['callertype'];
			$productname = $fetchrecord4['productname'];
			$productversion = $fetchrecord4['productversion'];
			$problem = $fetchrecord4['problem'];
			$attachment = $fetchrecord4['attachment'];
			$conversation = substr($fetchrecord4['conversation'],24);
			$remarks = $fetchrecord4['remarks'];
			$authorized = $fetchrecord4['authorized'];
			$authorizedgroup = $fetchrecord4['authorizedgroup'];
			$teamleaderremarks = $fetchrecord4['teamleaderremarks'];
			$authorizedperson = $fetchrecord4['authorizedperson'];
			$authorizeddatetime = $fetchrecord4['authorizeddatetime'];
			$publishrecord = $fetchrecord4['publishrecord'];
			$oldcustomerid = $fetchrecord4['oldcustomerid'];
			$short = substr($fetchrecord4['conversation'],0,25);
			
			$chats = '<table border="0" align="center" cellpadding="3" cellspacing="0" style="border:1px solid #6393df;" >
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">CustomerName</td>
							<td id="text" colspan="3">'.$customername.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">CustomerId</td>
							<td id="text" style="width:300px;">'.$customerid.'</td>
							<td nowrap ="nowrap" class="td-border-grid">Date&Time</td>
							<td id="text">'.$date.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">OldCustomerId</td>
							<td id="text">'.$oldcustomerid.'</td>
							<td nowrap ="nowrap" class="td-border-grid">Sender</td>
							<td id="text">'.$sender.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Category</td>
							<td id="text">'.$category.'</td>
							<td nowrap ="nowrap" class="td-border-grid">CallerType</td>
							<td id="text">'.$callertype.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">ProductName</td>
							<td id="text">'.$productname.'</td>
							<td nowrap ="nowrap" class="td-border-grid">ProductVersion</td>
							<td id="text">'.$productversion.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Remarks</td>
							<td id="text">'.$remarks.'</td>
							<td nowrap ="nowrap" class="td-border-grid">TeamLeaderRemarks</td>
							<td id="text">'.$teamleaderremarks.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Attachment</td>
							<td id="text">'.$attachment.'</td>
							<td nowrap ="nowrap" class="td-border-grid">Authorized</td>
							<td id="text">'.$authorized.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">PublishRecord</td>
							<td id="text">'.$publishrecord.'</td>
							<td nowrap ="nowrap" class="td-border-grid">AuthorizedGroup</td>
							<td id="text">'.$authorizedgroup.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">AuthorizedDateTime</td>
							<td id="text">'.$authorizeddatetime.'</td>
							<td nowrap ="nowrap" class="td-border-grid">AuthorizedPerson</td>
							<td id="text">'.$authorizedperson.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Problem</td>
							<td id="text" colspan="3">'.$problem.'</td>
						</tr>
						<tr class="headerclass">
							<td nowrap ="nowrap" class="td-border-grid">Conversation</td>
							<td colspan="3" id="text">'.$conversation.'</td>
					</tr></table>';
		}
		echo $chats;
	}
	break;
	case 'emaildatalist':
	{
		$compliantidlist = $_POST['compliantidlist'];
		$query6 = "select * , CONCAT(`date`,' ',`time`) as times from ssm_emailregister 
		where compliantid = '".$compliantidlist."'";
		$result6 = runmysqlquery($query6);
		while($fetchrecord6 = mysqli_fetch_array($result6))
		{
			$customername = $fetchrecord6['customername'];
			$customerid = $fetchrecord6['customerid'];
			$date = $fetchrecord6['times'];
			$personname = $fetchrecord6['personname'];
			$category = $fetchrecord6['category'];
			$callertype = $fetchrecord6['callertype'];
			$productname = $fetchrecord6['productname'];
			$productversion = $fetchrecord6['productversion'];
			$emailid = $fetchrecord6['emailid'];
			$subject = $fetchrecord6['subject'];
			$errorfile = $fetchrecord6['errorfile'];
			$forwrdto = $fetchrecord6['forwrdto'];
			$content = $fetchrecord6['content'];
			$thankingemail = $fetchrecord6['thankingemail'];
			$remarks = $fetchrecord6['remarks'];
			$authorized = $fetchrecord6['authorized'];
			$authorizedgroup = $fetchrecord6['authorizedgroup'];
			$teamleaderremarks = $fetchrecord6['teamleaderremarks'];
			$authorizedperson = $fetchrecord6['authorizedperson'];
			$authorizeddatetime = $fetchrecord6['authorizeddatetime'];
			$publishrecord = $fetchrecord6['publishrecord'];
			$oldcustomerid = $fetchrecord6['oldcustomerid'];
			
			$mails .= '<table border="0" align="center"  cellpadding="3" cellspacing="0" style="border:1px solid #6393df;">
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">CustomerName</td>
								<td id="text" colspan="3">'.$customername.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">Customerid</td>
								<td id="text">'.$customerid.'</td>
								<td nowrap ="nowrap" class="td-border-grid">Date&Time</td>
								<td id="text">'.$date.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">PublishRecord</td>
								<td id="text">'.$publishrecord.'</td>
								<td  nowrap ="nowrap" class="td-border-grid">PersonName</td>
								<td id="text">'.$personname.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">Category</td>
								<td id="text">'.$category.'</td>
								<td nowrap ="nowrap" class="td-border-grid">CallerType</td>
								<td id="text">'.$callertype.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">ProductName</td>
								<td id="text">'.$productname.'</td>
								<td nowrap ="nowrap" class="td-border-grid">ProductVersion</td>
								<td id="text">'.$productversion.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">EmailId</td>
								<td id="text">'.$emailid.'</td>
								<td nowrap ="nowrap" class="td-border-grid">Subject</td>
								<td id="text">'.$subject.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">ErrorFile</td>
								<td id="text">'.$errorfile.'</td>
								<td  nowrap ="nowrap" class="td-border-grid">ForwardTo</td>
								<td id="text">'.$forwrdto.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">Content</td>
								<td id="text">'.$content.'</td>
								<td nowrap ="nowrap" class="td-border-grid">ThankinGemail</td>
								<td id="text">'.$thankingemail.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">Remarks</td>
								<td id="text">'.$remarks.'</td>
								<td nowrap ="nowrap" class="td-border-grid">TeamLeaderRemarks</td>
								<td id="text">'.$teamleaderremarks.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">Authorized</td>
								<td id="text">'.$authorized.'</td>
								<td nowrap ="nowrap" class="td-border-grid">AuthorizedGroup</td>
								<td id="text">'.$authorizedgroup.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">AuthorizedDateTime</td>
								<td id="text">'.$authorizeddatetime.'</td>
								<td nowrap ="nowrap" class="td-border-grid">AuthorizedPerson</td>
								<td id="text">'.$authorizedperson.'</td>
							</tr>
							<tr class="headerclass">
								<td nowrap ="nowrap" class="td-border-grid">OldCustomerId</td>
								<td id="text" colspan="3">'.$oldcustomerid.'</td>
							</tr>
						</table>';
		}
		echo $mails;
	}
	break;
}
?>
</form>
<div id="popup-detail" align="center"></div>

</body>
</html>