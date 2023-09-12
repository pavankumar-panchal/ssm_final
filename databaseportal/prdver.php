<?php
include('../functions/phpfunctions.php');
if ($_POST['productversion'] <> '' || $_POST['productversionold'] <> '') {
  if (isset($_POST['submit'])) {
    $message = '';
    $productversionold = $_POST['productversionold'];
    $productversion = $_POST['productversion'];


    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_callregister WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_callregister set ssm_callregister.productversion='" . $productversion . "' where ssm_callregister.productversion = '" . $productversionold . "' AND ssm_callregister.productname = '" . $productcode . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_emailregister WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_emailregister set ssm_emailregister.productversion='" . $productversion . "' where ssm_emailregister.productversion = '" . $productversionold . "' AND ssm_emailregister.productname = '" . $productcode . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_errorregister WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_errorregister set ssm_errorregister.productversion='" . $productversion . "' where ssm_errorregister.productversion = '" . $productversionold . "' AND ssm_errorregister.productname = '" . $productcode . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_inhouseregister WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_inhouseregister set ssm_inhouseregister.productversion='" . $productversion . "' where ssm_inhouseregister.productversion = '" . $productversionold . "' AND ssm_inhouseregister.productname = '" . $productcode . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_invoice WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_invoice set ssm_invoice.productversion='" . $productversion . "' where ssm_invoice.productversion = '" . $productversionold . "' AND ssm_invoice.productname = '" . $productcode . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_onsiteregister WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_onsiteregister set ssm_onsiteregister.productversion='" . $productversion . "' where ssm_onsiteregister.productversion = '" . $productversionold . "' AND ssm_onsiteregister.productname = '" . $productcode . "';");


    /*$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_referenceregister WHERE productversion = '".$productversionold."'");
       if($fetch['count'] <> 0)
       $query = runmysqlquery("update ssm_referenceregister set ssm_referenceregister.productversion='".$productversion."' where ssm_referenceregister.productversion = '".$productversionold."' AND ssm_referenceregister.productname = '".$productcode."';");*/

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_requirementregister WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_requirementregister set ssm_requirementregister.productversion='" . $productversion . "' where ssm_requirementregister.productversion = '" . $productversionold . "' AND ssm_requirementregister.productname = '" . $productcode . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_skyperegister WHERE productversion = '" . $productversionold . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_skyperegister set ssm_skyperegister.productversion='" . $productversion . "' where ssm_skyperegister.productversion = '" . $productversionold . "' AND ssm_skyperegister.productname = '" . $productcode . "';");
  }
} else {
  $message = 'All the fields are Mandatory';
}
?>

<link rel="stylesheet" type="text/css" href="../style/main.css">
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Update Username to productversionold</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td style="padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
          <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
            <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter / Edit / View Details</td>
            <td align="right" class="header-line" style="padding-right:7px">
              <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                  align="absmiddle" /></div>
            </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
              <div id="maindiv">
                <form method="post" name="submitform" id="submitform" action="">
                  <div id="tabgrouponsitec1">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr bgcolor="#f7faff">
                              <td valign="top">Product Code:</td>
                              <td valign="top"><input name="productcode" type="text" class="swifttext" id="productcode"
                                  size="30" /></td>
                            </tr>
                            <tr bgcolor="#f7faff">
                              <td valign="top">Old Version:</td>
                              <td valign="top"><input name="productversionold" type="text" class="swifttext"
                                  id="productversionold" size="30" />
                                <input type="hidden" name="lastslno" id="lastslno" value="" />
                                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                <input type="hidden" name="loggedusertype" id="loggedusertype"
                                  value="<?php echo ($usertype); ?>" />
                                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                  value="<?php echo ($reportingauthority); ?>" />
                              </td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">New Version:</td>
                              <td valign="top"><input name="productversion" type="text" class="swifttext"
                                  id="productversion" size="30" /></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                            <tr>
                              <td width="68%" height="35" align="left" valign="middle">
                                <div id="form-error">
                                  <?php if ($message <> '')
                                    echo ($message); ?>
                                </div>
                              </td>
                              <td width="32%" height="35" align="right" valign="middle"><input name="submit"
                                  type="submit" class="swiftchoicebutton" id="submit" value="Submit" />
                                &nbsp;&nbsp;&nbsp;
                                <input name="reset" type="reset" class="swiftchoicebutton" id="reset" value="Reset" />
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </div>
                </form>
              </div>
            </td>
          </tr>

        </table>
      </td>
    </tr>
    <tr>
      <td style="padding:0">&nbsp;</td>
    </tr>
    <tr>
      <td></td>
    </tr>
  </table>
</div>