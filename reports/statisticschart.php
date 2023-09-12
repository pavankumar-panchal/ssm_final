<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type='text/javascript' src='../functions/annotatedtimeline-adv.js?dummy = <?php echo (rand()); ?>'></script>
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Reports > Statistics Chart</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td style="padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
          <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
            <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter the Details</td>
            <td align="right" class="header-line" style="padding-right:7px">
              <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                  align="absmiddle" /></div>
            </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
              <div id="maindiv">
                <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Registers:</td>
                            <td valign="top"><label>
                                <input name="register[]" type="checkbox" id="call" value="call" checked="checked">
                                Calls </label>
                              <label>
                                <input name="register[]" type="checkbox" id="email" value="email" checked="checked">
                                Emails-Customer </label>
                              <label>
                                <input type="checkbox" name="register[]" id="emailnc" value="emailnc">
                                Emails-NonCustomer </label>
                              <label>
                                <input type="checkbox" name="register[]" id="error" value="error">
                                Errors </label>
                              <label>
                                <input type="checkbox" name="register[]" id="inhouse" value="inhouse">
                                Inhouse </label>
                              <label>
                                <input type="checkbox" name="register[]" id="onsite" value="onsite">
                                Onsite </label>
                              <label>
                                <input type="checkbox" name="register[]" id="reference" value="reference">
                                Reference </label>
                              <label>
                                <input type="checkbox" name="register[]" id="requirement" value="requirement">
                                Requirement </label>
                              <label>
                                <input type="checkbox" name="register[]" id="skype" value="skype">
                                Skype </label>
                              <input type="hidden" name="lastslno" id="lastslno" value="" />
                              <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                              <input type="hidden" name="loggedusertype" id="loggedusertype"
                                value="<?php echo ($usertype); ?>" />
                              <input type="hidden" name="endtime" id="endtime" value="" />
                              <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                value="<?php echo ($reportingauthoritytype); ?>" />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">From Date:</td>
                            <td valign="top"><input name="fromdate" type="text" class="swifttext" id="DPC_fromdate"
                                size="30" autocomplete="off" style="background:#FEFFE6;"
                                value="<?php datetimelocal('d-m-Y'); ?>" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">To Date:</td>
                            <td valign="top"><input name="todate" type="text" class="swifttext" id="DPC_todate"
                                size="30" autocomplete="off" style="background:#FEFFE6;"
                                value="<?php datetimelocal('d-m-Y'); ?>" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Entered By:</td>
                            <td valign="top"><select name="userid" id="userid" class="swiftselect">
                                <option value="">ALL</option>
                                <?php include('../inc/useridselectionreports.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Status:</td>
                            <td valign="top"><input name="status" type="text" class="swifttext" id="status" size="30"
                                autocomplete="off" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Caller Type:</td>
                            <td valign="top" bgcolor="#EDF4FF"><label>
                                <input type='checkbox' name='customer' id='customer' value='Customer' />
                                Customers </label><label>
                                <input type='checkbox' name='dealer' id='dealer' value='Dealer' />
                                Dealers</label>
                              <label>
                                <input type='checkbox' name='employee' id='employee' value='employee' />
                                Employees</label><label>
                                <input type='checkbox' name='ssmuser' id='ssmuser' value='SSMUser' />
                                SSM Users</label>
                              &nbsp;&nbsp;&nbsp;[Not Available for Email Non Customers, Errors, References,
                              Requirements]
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Category:</td>
                            <td valign="top" bgcolor="#F7FAFF"><select name="category" id="category"
                                class="swiftselect">
                                <option value="" selected="selected">ALL</option>
                                <option value="BLR">Bangalore</option>
                                <option value="CSD">CSD</option>
                                <option value="KKG">KKG</option>
                              </select>
                              &nbsp;&nbsp;&nbsp;[Not Available for Email Non Customers, Errors, References,
                              Requirements]</td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Support Unit:</td>
                            <td valign="top"><select name="supportunit" class="swiftselect" id="supportunit">
                                <option value="">ALL</option>
                                <?php include('../inc/supportunit.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Anonymous:</td>
                            <td valign="top" bgcolor="#F7FAFF"><label>
                                <input type="radio" name="anonymous" id="anonymousdatabasefield11" value="yes" />
                                Yes</label>
                              <label>
                                <input type="radio" name="anonymous" id="anonymousdatabasefield12" value="no" />
                                No</label>
                              <label>
                                <input type="radio" name="anonymous" id="anonymousdatabasefield13" value=""
                                  checked="checked" />
                                Both</label>
                            </td>
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
                              <input name="view" type="submit" class="swiftchoicebutton" id="view" value="View"
                                onClick="gettimelinedata()" />
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
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
      <td>
        <div id='chart_div' style='width: 700px; height: 240px;'></div>
      </td>
    </tr>
  </table>
</div>

<div id="nameloaddiv" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Call Register > Get Customer</td>
    </tr>
    <tr>
      <td>
        <div id="gc-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/nameload.php'); ?>
  </table>
</div>


<div id="questionload" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Call Register > Get Problems and Solutions</td>
    </tr>
    <tr>
      <td>
        <div id="gq-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/questionload.php'); ?>
  </table>
</div>