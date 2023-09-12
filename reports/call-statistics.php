<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/call-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Reports > Call Statistics</td>
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
                            <td valign="top"><label><input name='check[]' type='checkbox' value='Call'
                                  checked="checked" />
                                Calls</label><label>
                                <input name='check[]' type='checkbox' value='Email' checked="checked" />
                                Emails</label><label>
                                <input name='check[]' type='checkbox' value='Skype' checked="checked" />
                                Skype </label><label>
                                <input type='checkbox' name='check[]' value='Error' />
                                Errors </label><label>
                                <input type='checkbox' name='check[]' value='Onsite' />
                                Onsite</label><label>
                                <input name='check[]' type='checkbox' value='Reference' />
                                References</label><label>
                                <input name='check[]' type='checkbox' value='Inhouse' />
                                Inhouse</label><label>
                                <input name='check[]' type='checkbox' value='Requirement' />
                                Requirements</label>
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
                            <td valign="top">
                              <input name="fromdate" type="text" class="swifttext" id="DPC_fromdate" size="30"
                                autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">To Date:</td>
                            <td valign="top"><input name="todate" type="text" class="swifttext" id="DPC_todate"
                                size="30" autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Entered By:</td>
                            <td valign="top">
                              <select name="userid" id="userid" class="swiftselect">
                                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                                  <option value="">ALL</option>
                                <?php } ?>
                                <?php include('../inc/useridselectionreports.php'); ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Caller Type:</td>
                            <td valign="top"><label>
                                <input name='customer' type='checkbox' id='customer' value='Customer'
                                  checked="checked" />
                                Customers </label><label>
                                <input name='dealer' type='checkbox' id='dealer' value='Dealer' checked="checked" />
                                Dealers</label>
                              <label>
                                <input name='employee' type='checkbox' id='employee' value='employee'
                                  checked="checked" />
                                Employees</label><label>
                                <input name='ssmuser' type='checkbox' id='ssmuser' value='SSMUser' checked="checked" />
                                SSM Users</label>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Category:</td>
                            <td valign="top"><select name="category" id="category" class="swiftselect">
                                <option value="" selected="selected">ALL</option>
                                <option value="BLR">Bangalore</option>
                                <option value="CSD">CSD</option>
                                <option value="KKG">KKG</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Support Unit:</td>
                            <td valign="top">
                              <select name="supportunit" class="swiftselect" id="supportunit">
                                <option value="">ALL</option>
                                <?php include('../inc/supportunit.php'); ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Anonymous:</td>
                            <td valign="top"><label>
                                <input type="radio" name="anonymous" id="databasefield11" value="yes" /> Yes</label>
                              <label>
                                <input type="radio" name="anonymous" id="databasefield12" value="no" /> No</label>
                              <label>
                                <input type="radio" name="anonymous" id="databasefield13" value="" checked="checked" />
                                Both</label>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Report on:</td>
                            <td valign="top"><label>
                                <input name="reporton" type="radio" id="reporton0" value="statistics"
                                  checked="checked" />
                                Statistics</label>
                              <label>
                                <input type="radio" name="reporton" id="reporton1" value="details" />
                                Details</label>
                              <label></label>
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
                                onClick="formsubmit('view');" />
                              &nbsp;&nbsp;&nbsp;
                              <input name="toexcel" type="submit" class="swiftchoicebutton-orange" id="toexcel"
                                value="To Excel" onClick="formsubmit('toexcel');" />
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
      <td id="processingbar"></td>
    </tr>
    <tr>
      <td style="padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
          <tr>
            <td class="header-line" style="padding:0">&nbsp;&nbsp;View Data:</td>
            <td align="right" class="header-line" style="padding-right:7px;"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2" valign="top">
              <div id="displaystatsreport" style="overflow:auto; height:300px; width:1060PX; padding:2px;"
                align="center"></div>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding:0">&nbsp;</td>
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