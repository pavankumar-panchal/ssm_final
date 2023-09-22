<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/onsite-statistics.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Reports > Onsite Statistics</td>
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
              <div align="right">
                <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" align="absmiddle" />
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
              <div id="maindiv">
                <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td valign="top" style="border-right:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">From Date:</td>
                            <td valign="top">
                              <input name="fromdate" type="text" class="swifttext" id="DPC_fromdate" size="30"
                                autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                              <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value="" /> <br />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">To Date:</td>
                            <td valign="top">
                              <input name="todate" type="text" class="swifttext" id="DPC_todate" size="30"
                                autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Service Charge:</td>
                            <td valign="top" bgcolor="#F7FAFF">
                              <input type="checkbox" name="servicecharge" id="servicecharge"
                                onClick="javascript:enableoutstandingbills();" />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Solved By:</td>
                            <td valign="top">
                              <select name="solvedby" id="solvedby" class="swiftselect">
                                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                                  <option value="">ALL</option>
                                  <?php include('../inc/useridselectionreports.php');
                                } else { ?>
                                  <?php include('../inc/useridselectionreports.php');
                                } ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Solved Through:</td>
                            <td valign="top" bgcolor="#F7FAFF"><label>
                                <input name="stremoteconnection" type="checkbox" id="stremoteconnection" value="" />
                                Remote Connection </label>
                              <label>
                                <input name="marketingperson" type="checkbox" id="marketingperson" value="" />
                                Marketing Person </label>
                              <label>
                                <input name="onsitevisit" type="checkbox" id="onsitevisit" value="" checked="checked" />
                                Onsite Visit </label>
                              <br />
                              <label>
                                <input name="overphone" type="checkbox" id="overphone" value="" />
                                Over Phone </label>
                              <label>
                                <input name="mail" type="checkbox" id="mail" value="" />
                                Mail </label>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#EDF4FF">Anonymous:</td>
                            <td valign="top" bgcolor="#EDF4FF"><label>
                                <input type="radio" name="anonymous" id="databasefield11" value="yes" /> Yes</label>
                              <label>
                                <input type="radio" name="anonymous" id="databasefield12" value="no" /> No</label>
                              <label>
                                <input type="radio" name="anonymous" id="databasefield13" value="Both"
                                  checked="checked" />
                                Both</label>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Reports on:</td>
                            <td valign="top" bgcolor="#F7FAFF"><label>
                                <input type="radio" name="reporton" id="reporton0" value="statistics" />
                                Statistics</label>
                              <label>
                                <input type="radio" name="reporton" id="reporton1" value="details" />
                                Details</label>
                              <label></label>
                              <label>
                                <input type="radio" name="reporton" id="reporton3" value="pending visits"
                                  checked="checked" />
                                Pending Visits</label>
                            </td>
                          </tr>

                        </table>
                      </td>
                      <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Customer Name:</td>
                            <td valign="top">
                              <input name="customername" type="text" class="swifttext" id="customername" size="30"
                                autocomplete="off" />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Product group:</td>
                            <td valign="top">
                              <span id="filterprdgroupdisplay">
                                <?php include('../inc/productgroup.php');
                                productname('s_productgroup', '');
                                ?>
                                <!-- Details are in javascript.js page as a function prdgroup();-->
                              </span>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Product Name:</td>
                            <td valign="top">

                              <select name="productname" id="productname" class="swiftselect">
                                <option value="">ALL</option>
                                <?php include('../inc/productfilter.php'); ?>
                              </select>

                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Status:</td>
                            <td valign="top">
                              <select name="status" class="swiftselect" id="status">
                                <option value="">ALL</option>
                                <option value="notyetattended" selected="selected">Un Attended</option>
                                <option value="postponed">Postponed</option>
                                <option value="inprocess">In Process</option>
                                <option value="solved">Solved</option>
                                <option value="skipped">Skipped</option>
                                <option value="unsolved">Un Solved</option>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Registered By:</td>
                            <td valign="top">
                              <select name="userid" id="userid" class="swiftselect">
                                <?php if ($usertype == 'MANAGEMENT' || $usertype == 'ADMIN' || $usertype == 'TEAMLEADER') { ?>
                                  <option value="">ALL</option>
                                  <?php include('../inc/useridselectionreports.php');
                                } else { ?>
                                  <?php include('../inc/useridselectionreports.php');
                                } ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Support Unit:</td>
                            <td valign="top">
                              <select name="supportunit" class="swiftselect" id="supportunit">
                                <option value="">ALL</option>
                                <?php include('../inc/supportunit.php'); ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Complaint Id:</td>
                            <td valign="top"><input name="complaintid" type="text" class="swifttext" id="complaintid"
                                size="30" autocomplete="off" /></td>
                          </tr>

                        </table>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2" align="right" valign="middle"
                        style="padding-right:15px; border-top:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                          <tr>
                            <td width="68%" height="35" align="left" valign="middle">
                              <div id="form-error"></div>
                            </td>
                            <td width="32%" height="35" align="right" valign="middle">
                              <input name="view" type="submit" class="swiftchoicebutton" id="view" value="View"
                                onClick="formsubmit('toview');" />
                              &nbsp;&nbsp;&nbsp;&nbsp;
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
            <td colspan="2" valign="top">
              <div id="displaystatsreport" style="overflow:auto; height:300px; width:1060PX; padding:2px;"
                align="center"></div>
            </td>
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