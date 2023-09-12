<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <!--<script language="javascript" src="../functions/invoiceregister.js" type="text/javascript"></script>
-->
  <div id="contentdiv" style="display:block;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td class="content-header">Attendance > Advanced</td>
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
                  <form method="post" name="submitform" id="submitform" action="../reports-excel/attendancereport.php">
                    <div id="tabgrouponsitec1">
                      <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr bgcolor="#f7faff">
                                <td valign="top">From Date:</td>
                                <td valign="top"><input name="fromdate" type="text" class="swifttext" id="DPC_fromdate"
                                    size="30" autocomplete="off" value="<?php echo date('01-m-Y'); ?>"
                                    style="background:#FEFFE6;" />
                                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                  <input type="hidden" name="loggedusertype" id="loggedusertype"
                                    value="<?php echo ($usertype); ?>" />
                                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                    value="<?php echo ($reportingauthority); ?>" />
                                </td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">To Date:</td>
                                <td valign="top"><input name="todate" type="text" class="swifttext" id="DPC_todate"
                                    size="30" autocomplete="off" value="<?php echo date('d-m-Y'); ?>"
                                    style="background:#FEFFE6;" /></td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">User Name:</td>
                                <td valign="top"><select name="userid" id="userid" class="swiftselect">
                                    <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                                      <!--                      <option value="">ALL</option>
-->
                                      <?php include('../inc/useridselectionreports.php');
                                    } else { ?>
                                      <?php include('../inc/useridselectionreports.php');
                                    } ?>
                                  </select></td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Include Holidays:</td>
                                <td valign="top"><input name="holidays" type="checkbox" id="holidays" checked></td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Include Working Days:</td>
                                <td valign="top"><input name="workingdays" type="checkbox" id="workingdays" checked></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                              <tr>
                                <td width="68%" height="35" align="left" valign="middle">
                                  <div id="form-error"></div>
                                </td>
                                <td width="32%" height="35" align="right" valign="middle">
                                  <input name="generate" type="submit" class="swiftchoicebutton" id="generate"
                                    value="Generate" />
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
<?php } ?>