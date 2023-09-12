<?php
include('../functions/phpfunctions.php');
	if($_POST['customername'] <> '' || $_POST['customerid'] <> '' || $_POST['e-customerid'] <> '')
	{
		if(isset($_POST['submit']))
		{
			$message = '';
			$e-customerid = $_POST['e-customerid'];
			$customername = $_POST['customername'];
			$customerid = $_POST['customerid'];
		
			$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_callregister WHERE customerid = '".$e-customerid."'");
			if($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_callregister set customername='".$customername."' where customerid = '".$customerid."' and callertype = 'customer';");
			
			$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_emailregister WHERE customerid = '".$e-customerid."'");
			if($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_emailregister set customername='".$customername."' where customerid = '".$customerid."' and callertype = 'customer';");
		
			$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_inhouseregister WHERE customerid = '".$e-customerid."'");
			if($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_inhouseregister set customername='".$customername."' where customerid = '".$customerid."' and callertype = 'customer';");
			
			$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_onsiteregister WHERE customerid = '".$e-customerid."'");
			if($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_onsiteregister set customername='".$customername."' where customerid = '".$customerid."' and callertype = 'customer';");
			
			/*$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_skyperegister WHERE customerid = '".$e-customerid."'");
			if($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_skyperegister set customername='".$customername."' where customerid = '".$customerid."' and callertype = 'customer';");*/
			
			$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_invoice WHERE customerid = '".$e-customerid."'");
			if($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_invoice set customername='".$customername."' where customerid = '".$customerid."';");
			
			
			$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_receipts WHERE customerid = '".$e-customerid."'");
			if($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_receipts set customername='".$customername."' where customerid = '".$customerid."';");
			
		}
	}
	else
	{
		$message = 'All the fields are Mandatory';
	}
?>

<link rel="stylesheet" type="text/css" href="../style/main.css">
<div id="contentdiv" style="display:block;">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Update Username to productname</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
        <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter / Edit / View Details</td>
        <td align="right" class="header-line" style="padding-right:7px"><div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"  align="absmiddle" /></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="maindiv">
          <form method="post" name="submitform" id="submitform" action="">
          <div id="tabgrouponsitec1">
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#F7FAFF">
                      <td valign="top">Customer  Id:</td>
                      <td valign="top"><input name="customerid" type="text" class="swifttext" id="customerid" size="30" /></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#EDF4FF">Customer Name:</td>
                      <td valign="top" bgcolor="#EDF4FF"><input name="customername" type="text" class="swifttext" id="customername" size="30" />
                          <input type="hidden" name="lastslno2" id="lastslno2" value="" />
                          <input type="hidden" name="loggeduser2" id="loggeduser2" value="<?php echo($user); ?>"/>
                          <input type="hidden" name="loggedusertype2" id="loggedusertype2" value="<?php echo($usertype); ?>"/>
                          <input type="hidden" name="loggedreportingauthority2" id="loggedreportingauthority2" value="<?php echo($reportingauthority ); ?>"/></td>
                    </tr>
                </table></td>
                </tr>
              <tr>
                <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
  <tr>
                <td width="68%" height="35" align="left" valign="middle"><div id="form-error"><?php if($message <> '') echo($message); ?></div></td>
                <td width="32%" height="35" align="right" valign="middle"><input name="submit" type="submit" class="swiftchoicebutton" id="submit" value="Submit" />
                  &nbsp;&nbsp;&nbsp;
                  <input name="reset" type="reset" class="swiftchoicebutton" id="reset" value="Reset" /></td>
              </tr>
</table></td>
              </tr>
            </table>
          </div>
          </form>
        </div></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td style="padding:0">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
</div>
