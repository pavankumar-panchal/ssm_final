<?php
include('../functions/phpfunctions.php');
if ($_POST['productid'] <> '' || $_POST['productname'] <> '') {
  if (isset($_POST['submit'])) {
    $message = '';
    $productname = $_POST['productname'];
    $productid = $_POST['productid'];


    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_callregister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_callregister set ssm_callregister.productname='" . $productid . "' where ssm_callregister.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_emailregister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_emailregister set ssm_emailregister.productname='" . $productid . "' where ssm_emailregister.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_errorregister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_errorregister set ssm_errorregister.productname='" . $productid . "' where ssm_errorregister.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_inhouseregister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_inhouseregister set ssm_inhouseregister.productname='" . $productid . "' where ssm_inhouseregister.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_invoice WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_invoice set ssm_invoice.productname='" . $productid . "' where ssm_invoice.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_onsiteregister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_onsiteregister set ssm_onsiteregister.productname='" . $productid . "' where ssm_onsiteregister.productname = '" . $productname . "';");


    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_referenceregister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_referenceregister set ssm_referenceregister.productname='" . $productid . "' where ssm_referenceregister.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_requirementregister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_requirementregister set ssm_requirementregister.productname='" . $productid . "' where ssm_requirementregister.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_skyperegister WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_skyperegister set ssm_skyperegister.productname='" . $productid . "' where ssm_skyperegister.productname = '" . $productname . "';");

    $fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_versions WHERE productname = '" . $productname . "'");
    if ($fetch['count'] <> 0)
      $query = runmysqlquery("update ssm_versions set ssm_versions.productname='" . $productid . "' where ssm_versions.productname = '" . $productname . "';");
  }
} else {
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
                              <td valign="top">Product Name:</td>
                              <td valign="top"><input name="productname" type="text" class="swifttext" id="productname"
                                  size="30" />
                                <input type="hidden" name="lastslno" id="lastslno" value="" />
                                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                <input type="hidden" name="loggedusertype" id="loggedusertype"
                                  value="<?php echo ($usertype); ?>" />
                                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                  value="<?php echo ($reportingauthority); ?>" />
                              </td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">Product Id:</td>
                              <td valign="top"><input name="productid" type="text" class="swifttext" id="productid"
                                  size="30" /></td>
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