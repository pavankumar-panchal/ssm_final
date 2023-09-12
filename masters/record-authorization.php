<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if ($usertype <> 'TEAMLEADER' && $usertype <> 'MANAGEMENT' && $usertype <> 'ADMIN')
  header("location:../index.php");

$fetch = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_callregister WHERE authorized = 'no' ORDER BY slno;");
$calls = $fetch['count'];
$fetch1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_emailregister WHERE authorized = 'no' ORDER BY slno;");
$emails = $fetch1['count'];
$fetch2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister WHERE authorized = 'no' ORDER BY slno;");
$errors = $fetch2['count'];
$fetch3 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_inhouseregister WHERE authorized = 'no' ORDER BY slno;");
$inhouse = $fetch3['count'];
$fetch4 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE authorized = 'no' ORDER BY slno;");
$onsite = $fetch4['count'];
$fetch5 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_referenceregister WHERE authorized = 'no' ORDER BY slno;");
$references = $fetch5['count'];
$fetch6 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister WHERE authorized = 'no' ORDER BY slno;");
$requirements = $fetch6['count'];
$fetch7 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_skyperegister WHERE authorized = 'no' ORDER BY slno;");
$skype = $fetch7['count'];
$fetch8 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_invoice WHERE authorized = 'no' ORDER BY slno;");
$invoices = $fetch8['count'];
$fetch9 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_receipts WHERE authorized = 'no' ORDER BY slno;");
$receipts = $fetch9['count'];

$total = $calls + $emails + $errors + $inhouse + $onsite + $references + $requirements + $skype + $invoices + $receipts;
?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/recordauthorization.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Masters > Record Authorization</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none">
        <tr style="cursor:pointer" onClick="showhide('pendingauthorization','toggleimg');">
          <td class="header-line" style="padding:0">&nbsp;&nbsp;Authorization Summary - You have <strong>
              <?php echo ($total); ?>
            </strong> Records Pending for Authorization</td>
          <td align="right" class="header-line" style="padding-right:7px">
            <div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                align="absmiddle" /></div>
          </td>
        </tr>
        <tr>
          <td valign="top">
            <div id="pendingauthorization" style="display:none;">
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr bgcolor="#f7faff">
                        <td valign="top">Calls:</td>
                        <td valign="top">
                          <?php echo ($calls); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#edf4ff">
                        <td valign="top">Emails:</td>
                        <td valign="top">
                          <?php echo ($emails); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#f7faff">
                        <td valign="top">Errors:</td>
                        <td valign="top">
                          <?php echo ($errors); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#edf4ff">
                        <td valign="top">Inhouse:</td>
                        <td valign="top">
                          <?php echo ($inhouse); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#f7faff">
                        <td valign="top">Onsite:</td>
                        <td valign="top">
                          <?php echo ($onsite); ?>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td width="50%" valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr bgcolor="#f7faff">
                        <td valign="top">Reference:</td>
                        <td valign="top">
                          <?php echo ($references); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#edf4ff">
                        <td valign="top">Requirement:</td>
                        <td valign="top">
                          <?php echo ($requirements); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#f7faff">
                        <td valign="top">Skype:</td>
                        <td valign="top">
                          <?php echo ($skype); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#edf4ff">
                        <td valign="top">Invoice:</td>
                        <td valign="top">
                          <?php echo ($invoices); ?>
                        </td>
                      </tr>
                      <tr bgcolor="#f7faff">
                        <td valign="top">Receipts:</td>
                        <td valign="top">
                          <?php echo ($receipts); ?>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
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
              <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="middle" align="center" style="border-bottom:1px solid #d1dceb; padding:0" height="170">
                      <div id="displayregisters"><img src="../images/warn.gif" border="0" align="absmiddle" />&nbsp;
                        <strong>Make A Selection of record from the grid below</strong>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" style="border-right:1px solid #d1dceb;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr bgcolor="#f7faff">
                                <td valign="top">Category:</td>
                                <td valign="top"><select name="authorizedgroup" class="swiftselect"
                                    id="authorizedgroup">
                                    <option value="" selected="selected">Make A Selection</option>
                                    <?php
                                    include('../inc/authorizinggroup.php');
                                    ?>
                                  </select></td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Authorized:</td>
                                <td valign="top"><label>
                                    <input type="radio" name="authorizedatabasefield" id="authorizedatabasefield0"
                                      value="yes" checked="checked" />
                                    Yes </label>
                                  <label>
                                    <input type="radio" name="authorizedatabasefield" id="authorizedatabasefield1"
                                      value="no" />
                                    No</label>
                                </td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Flag the Entry:</td>
                                <td valign="top"><label>
                                    <input type="radio" name="flagdatabasefield" id="flagdatabasefield0" value="yes" />
                                    Yes </label>
                                  <label>
                                    <input type="radio" name="flagdatabasefield" id="flagdatabasefield1" value="no"
                                      checked="checked" />
                                    No</label>
                                </td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top" bgcolor="#EDF4FF">Publish:</td>
                                <td valign="top" bgcolor="#EDF4FF"><label>
                                    <input type="radio" name="publishdatabaseefield" id="publishdatabasefield0"
                                      value="yes" />
                                    Yes </label>
                                  <label>
                                    <input type="radio" name="publishdatabasefield" id="publishdatabasefield2"
                                      value="no" checked="checked" />
                                    No</label>
                                </td>
                              </tr>

                            </table>
                          </td>
                          <td width="50%" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr bgcolor="#f7faff">
                                <td height="76" valign="top">Remarks:</td>
                                <td valign="top"><textarea name="teamleaderremarks" cols="45" class="swifttextarea"
                                    id="teamleaderremarks"></textarea>
                                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                                  <input type="hidden" name="registervalue" id="registervalue" value="" />
                                </td>
                                <input type="hidden" name="loggedusertype" id="loggedusertype"
                                  value="<?php echo ($usertype); ?>" />
                                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                  value="<?php echo ($reportingauthoritytype); ?>" />
                              </tr>


                            </table>
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
                            <input name="save" type="submit" class="swiftchoicebutton" id="save" value="Save"
                              onclick="formsubmit('save')" />
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="new" type="reset" class="swiftchoicebutton" id="new" value="Clear"
                              onclick="clearinnerhtml(); " />&nbsp;&nbsp;
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
    <td></td>
  </tr>
  <tr>
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
        <tr style="cursor:pointer" onClick="showhide('filterdiv','toggleimg1');">
          <td class="header-line" style="padding:0">&nbsp;&nbsp;Filter the Data:</td>
          <td align="right" class="header-line" style="padding-right:7px;">
            <div align="right"><img src="../images/plus.jpg" border="0" id="toggleimg1" name="toggleimg1"
                align="absmiddle" /></div>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top">
            <div id="filterdiv" style="display:none;">
              <form action="" method="post" name="filterform" id="filterform" onsubmit="return false;">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr bgcolor="#f7faff">
                          <td valign="top">From Date:</td>
                          <td valign="top">
                            <input name="fromdate" type="text" class="swifttext" id="DPC_fromdate" size="30"
                              autocomplete="off" style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>" />
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">To Date:</td>
                          <td valign="top">
                            <input name="todate" type="text" class="swifttext" id="DPC_todate" size="30"
                              autocomplete="off" style="background:#FEFFE6;" value="<?php datetimelocal('d-m-Y'); ?>" />
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Customer Name:</td>
                          <td valign="top">
                            <input name="s_customername" type="text" class="swifttext" id="s_customername" size="30" />
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Customer ID:</td>
                          <td valign="top">
                            <input name="s_customerid" type="text" class="swifttext" id="s_customerid" size="30" />
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Category:</td>
                          <td valign="top">
                            <select name="s_category" id="s_category" class="swiftselect">
                              <option value="" selected="selected">ALL</option>
                              <option value="BLR">Bangalore</option>
                              <option value="CSD">CSD</option>
                              <option value="KKG">KKG</option>
                            </select>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Flag:</td>
                          <td valign="top"><label>
                              <input type="radio" name="s_flagdatabasefield" id="s_flagdatabasefield0" value="yes" />
                              Yes </label>
                            <label>
                              <input type="radio" name="s_flagdatabasefield" id="s_flagdatabasefield1" value="no" />
                              No</label>
                            <label>
                              <input type="radio" name="s_flagdatabasefield" id="s_flagdatabasefield2" value=""
                                checked="checked" />
                              Both</label>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Publish Record:</td>
                          <td valign="top"><label>
                              <input type="radio" name="s_publishdatabasefield" id="s_publishdatabasefield0"
                                value="yes" />
                              Yes </label>
                            <label>
                              <input type="radio" name="s_publishdatabasefield" id="s_publishdatabasefield1"
                                value="no" />
                              No</label> <label>
                              <input type="radio" name="s_publishdatabasefield" id="s_publishdatabasefield1" value=""
                                checked="checked" />
                              Both</label>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Problem:</td>
                          <td valign="top">
                            <input name="s_problem" type="text" class="swifttextarea" id="s_problem" value=""
                              size="30" />
                          </td>
                        </tr>

                      </table>
                    </td>
                    <td width="50%" valign="top">
                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr bgcolor="#f7faff">
                          <td valign="top">Transferred To:</td>
                          <td valign="top">
                            <select name="s_transferredto" id="s_transferredto" class="swiftselect">
                              <option value="" selected="selected">All</option>
                              <option value="none" selected="selected">None</option>
                              <?php include('../inc/useridselection.php'); ?>
                              <option value="registration">Registration Department</option>
                              <option value="others">Others</option>
                            </select>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Authorized:</td>
                          <td valign="top"><label>
                              <input type="radio" name="s_authorizedatabasefield" id="s_authorizedatabasefield0"
                                value="yes" checked="checked" />
                              Yes </label>
                            <label>
                              <input type="radio" name="s_authorizedatabasefield" id="s_authorizedatabasefield1"
                                value="no" />
                              No</label><label>
                              <input type="radio" name="s_authorizedatabasefield" id="s_authorizedatabasefield2"
                                value="" checked="checked" />
                              Both </label>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Status:</td>
                          <td valign="top"><input name="s_status" type="text" class="swifttext" id="s_status"
                              size="30" /></td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top">Entered By:</td>
                          <td valign="top">
                            <select name="s_userid" id="s_userid" class="swiftselect">
                              <option value="" selected="selected">All</option>
                              <?php include('../inc/useridselectionreports.php'); ?>
                            </select>
                          </td>
                        </tr>
                        <tr bgcolor="#edf4ff">
                          <td valign="top" bgcolor="#EDF4FF">Product group:</td>
                          <td valign="top" bgcolor="#EDF4FF">
                            <span id="filterprdgroupdisplay">
                              <?php include('../inc/productgroup.php');
                              productname('s_productgroup', ''); ?>
                              <!-- Details are in javascript.js page as a function prdgroup();-->
                            </span>
                          </td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top" bgcolor="#EDF4FF">Product Name:</td>
                          <td valign="top" bgcolor="#EDF4FF"><select name="s_productname" class="swiftselect"
                              id="s_productname">
                              <option value="">All</option>
                              <?php include('../inc/productfilter.php'); ?>
                            </select>
                          </td>
                        </tr>

                        <!-- <tr bgcolor="#f7faff">
                      <td valign="top">Product Name:</td>
                      <td valign="top"><select name="s_productname" class="swiftselect" id="s_productname">
                        <option value="">All</option>
                        /*<? php /*include('../inc/productname.php');*/?>*/
                      </select></td>
                    </tr>-->
                        <tr bgcolor="#f7faff">
                          <td valign="top">Register ID(Compliant Id, Error ID, etc) :</td>
                          <td valign="top"><input name="s_compliantid" type="text" class="swifttext" id="s_compliantid"
                              size="30" /></td>
                        </tr>
                        <tr bgcolor="#F7FAFF">
                          <td valign="top">Support Unit:</td>
                          <td valign="top"><select name="s_supportunit" class="swiftselect" id="s_supportunit">
                              <option value="">ALL</option>
                              <?php include('../inc/supportunit.php'); ?>
                            </select></td>
                        </tr>
                        <tr bgcolor="#f7faff">
                          <td valign="top" bgcolor="#f7faff">Order By:</td>
                          <td valign="top" bgcolor="#f7faff">
                            <select name="orderby" class="swiftselect" id="orderby">
                              <option value="callertype">Caller Type</option>
                              <option value="category">Category</option>
                              <option value="compliantid" selected="selected">Compliant ID</option>
                              <option value="customerid">Customer ID</option>
                              <option value="customername">Registered Name</option>
                              <option value="date">Date</option>
                              <option value="userid">Entered By</option>
                              <option value="problem">Problem</option>
                              <option value="productname">Product Name</option>
                              <option value="status">Status</option>
                              <option value="transferredto">Transferred To</option>
                              <option value="time">Time</option>
                            </select>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"
                      height="35">In:
                      <label>
                        <input name="databasefield" type="radio" id="databasefield0" value="call" checked="checked" />
                        Call</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="email" />
                        Email</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="error" />
                        Error</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="inhouse" />
                        Inhouse</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="onsite" />
                        Onsite</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="reference" />
                        Reference</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="requirement" />
                        Requirement</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="skype" />
                        Skype</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="invoice" />
                        Invoice</label>
                      <label>
                        <input type="radio" name="databasefield" id="databasefield0" value="receipt" />
                        Receipts</label>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right" valign="middle"
                      style="padding-right:15px; border-top:1px solid #d1dceb;" height="35">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="85%" height="35" valign="middle">
                            <div id="filter-form-error"></div>
                          </td>
                          <td width="15%" height="35" align="right" valign="middle">
                            <input name="view" type="submit" class="swiftchoicebutton" id="view" value="View"
                              onclick="formfilter('view'); " />
                            &nbsp;&nbsp;&nbsp; 
                            <img src="../images/toexcel.png" border="0" align="absmiddle"
                              onclick="formfilter('toexcel');" style="cursor:pointer" />
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
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr style="border-left:none; border-right:none;">
          <td style="padding:0; border:none;" width="26%">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="84px" align="center" id="tabgroupgridh1" onclick="gridtab2('1','tabgroupgrid');"
                  style="cursor:pointer" class="grid-active-tabclass">Default-Calls</td>
                <td width="2">&nbsp;</td>
                <td width="84px" align="center" id="tabgroupgridh2" onclick="gridtab2('2','tabgroupgrid');"
                  style="cursor:pointer" class="grid-tabclass">Filter</td>
                <td width="2">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
          <td><span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td style="padding:0">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
        <tr>
          <td width="10%" class="header-line" style="padding:0">&nbsp;&nbsp;View Records: </td>
          <td width="75%" class="header-line" style="padding:0"></td>
          <td width="15%" class="header-line" style="padding:0"></td>
        </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
            <div id="tabgroupgridc1" style="overflow:auto; height:300px; width:1060PX; padding:2px;" align="center">
            </div>
            <div id="tabgroupgridc2" style="overflow:auto; height:300px; width:1060px; padding:2px; display:none">No
              records to be displayed. Please filter the records from the filter form</div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>