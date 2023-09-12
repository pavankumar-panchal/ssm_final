<?php
session_start();
require_once('../functions/phpfunctions.php');
$month = date('m');
if ($month >= '04')
  $date = '01-04-' . date('Y');
else {
  $year = date('Y') - '1';
  $date = '01-04-' . $year;
}

?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/callregister.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Registers > Calls</td>
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
                <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td colspan="2" style="padding:2px">
                        <table width="50%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="2" style="padding-left:3px">
                              <div class="amctext"><strong>AMC Info:</strong><span style="padding-left:10px"
                                  id="amcdisplayinfo"> Select a Customer</span> </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" style="padding-left:3px">
                              <div id="amcdisplaydiv" style="display:none; width:540px;" class="amcdisplay">
                                <table border="0" cellspacing="0" cellpadding="3">
                                  <tr>
                                    <td style="padding:0px"><strong>&nbsp;&nbsp;Customer Name :</strong> </td>
                                    <td id="customerdisplayname"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">
                                      <div style="padding:5px; overflow:auto; width:510px; height:100px"
                                        id="displayamcdetails" align="center"></div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="25%">&nbsp;</td>
                                    <td width="75%" height="35" align="right" valign="middle"
                                      style="padding-right:10px"><input name="close" type="button"
                                        class="swiftchoicebutton" id="close" value="Close"
                                        onclick="document.getElementById('amcdisplaydiv').style.display = 'none';" />
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
                      <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#EDF4FF">
                            <td valign="top">Call Type:</td>
                            <td valign="top" bgcolor="#EDF4FF"><label>
                                <input name="calltype" type="radio" id="incoming" value="incoming" checked="checked" />
                                Incoming</label>
                              <label>
                                <input name="calltype" type="radio" id="outgoing" value="outgoing" />
                                Outgoing</label>
                            </td>
                          </tr>

                          <tr bgcolor="#f7faff">
                            <td valign="top">Anonymous:</td>
                            <td valign="top" bgcolor="#f7faff"><label>
                                <input name="anonymous" type="radio" id="databasefield9" onclick="formsubmitcustomer();"
                                  value="yes" />
                                Yes</label>
                              <label>
                                <input name="anonymous" type="radio" id="databasefield10"
                                  onclick="formsubmitcustomer();" value="no" checked="checked" />
                                No</label>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Registered Name:</td>
                            <td valign="top" bgcolor="#EDF4FF"><input name="customername" type="text" class="swifttext"
                                id="customername" size="30" autocomplete="off" readonly="readonly"
                                style="background:#FEFFE6;" />
                              <span id="getcustomerlink" style="visibility:visible;"> <a href="javascript:void(0);"
                                  onclick="getcustomer(); getcustomerfunc(); registernameload('call')"
                                  style="cursor:pointer"> <img src="../images/userid-bg.gif" width="14" height="16"
                                    border="0" align="absmiddle" /></a></span>
                              <input type="hidden" name="lastslno" id="lastslno" value="" />
                              <input type="hidden" name="cusid" id="cusid" value="" />
                              <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                              <input type="hidden" name="loggedusertype" id="loggedusertype"
                                value="<?php echo ($usertype); ?>" />
                              <input type="hidden" name="endtime" id="endtime" value="" />
                              <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                value="<?php echo ($reportingauthoritytype); ?>" /><input type="hidden"
                                name="hiddenserverdate" id="hiddenserverdate"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Customer ID:</td>
                            <td valign="top" bgcolor="#F7FAFF"><input name="customerid" type="text" class="swifttext"
                                id="customerid" size="30" autocomplete="off" readonly="readonly"
                                style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Date:</td>
                            <td valign="top" bgcolor="#EDF4FF"><input name="date" type="text" class="swifttext"
                                id="date" size="30" autocomplete="off" readonly="readonly" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Time:</td>
                            <td valign="top" bgcolor="#F7FAFF"><input name="time" type="text" class="swifttext"
                                id="time" size="30" autocomplete="off" readonly="readonly" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('H:i:s')); ?>" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Category:</td>
                            <td valign="top" bgcolor="#EDF4FF"><input name="category" type="text" class="swifttext"
                                id="category" size="30" autocomplete="off" readonly="readonly"
                                style="background:#FEFFE6;" /> </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">State:</td>
                            <td valign="top" bgcolor="#F7FAFF">
                              <select name="state" id="state" class="swiftselect" autocomplete="off" disabled="disabled"
                                style="background:#FEFFE6;">

                                <?php include('../inc/state.php'); ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Caller Type:</td>
                            <td valign="top" bgcolor="#EDF4FF">
                              <input name="callertype" type="text" class="swifttext" id="callertype" size="30"
                                autocomplete="off" readonly="readonly" style="background:#FEFFE6;" />
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Product group:</td>
                            <td valign="top" bgcolor="#F7FAFF">
                              <?php include('../inc/productgroup.php');
                              productname('productgroup', '');
                              ?>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Product Name(<font color="#FF0000">Optional</font>)</td>
                            <td valign="top" bgcolor="#EDF4FF"><span id="productnamedisplay">
                                <select name="productname" class="swiftselect" id="productname">
                                  <option value="">Select a Product</option>
                                </select></span></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Product Version:</td>
                            <td valign="top" bgcolor="#F7FAFF"><span id="productversiondisplay">
                                <select name="productversion" id="productversion" class="swiftselect">
                                  <option value="">Select a Product</option>
                                </select></span></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Person Name:</td>
                            <td valign="top" bgcolor="#EDF4FF"><input name="personname" type="text" class="swifttext"
                                id="personname" size="30" autocomplete="off" /><br /></td>
                          </tr>
                        </table>
                      </td>
                      <td width="50%" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Problem:</td>
                            <td valign="top"><textarea name="problem" cols="45" class="swifttextarea"
                                id="problem"></textarea>
                              <a href="javascript:void(0);" style="cursor:pointer"
                                onclick="getquestionfunc(); getquestion();"><img src="../images/get-problem.gif"
                                  width="22" height="22" border="0" align="top" /></a>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Status:</td>
                            <td valign="top"><select name="status" id="status" class="swiftselect">
                                <option value="" selected="selected">Make A Selection</option>
                                <option value="solved">Solved</option>
                                <option value="unsolved">Un Solved</option>
                                <option value="transferred">Transferred</option>
                                <option value="registration given">Registration Given</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Call Category:</td>
                            <td valign="top"><select name="callcategory" id="callcategory" class="swiftselect">
                                <?php include('../inc/callcategory.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Solved Through:</td>
                            <td valign="top"><label>
                                <input name="stremoteconnection" type="checkbox" id="stremoteconnection" />
                                Remote Connection
                              </label></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#f7faff">Transferred to:</td>
                            <td valign="top" bgcolor="#f7faff">
                              <select name="transferredto" id="transferredto" class="swiftselect">
                                <option value="none" selected="selected">None</option>
                                <?php include('../inc/useridselection.php'); ?>
                                <option value="registration">Registration Department</option>
                                <option value="others">Others</option>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#edf4ff">Remarks:</td>
                            <td valign="top" bgcolor="#edf4ff"><textarea name="remarks" cols="45" class="swifttextarea"
                                id="remarks"></textarea></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#f7faff">Entered By:</td>
                            <td valign="top" bgcolor="#f7faff"><input name="userid" type="text" class="swifttext"
                                id="userid" size="30" readonly="readonly" value="<?php echo ($loggedusername); ?>"
                                autocomplete="off" style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#edf4ff">Complaint ID:</td>
                            <td valign="top" bgcolor="#edf4ff"><input name="compliantid" type="text" class="swifttext"
                                id="compliantid" size="30" maxlength="40" readonly="readonly" autocomplete="off"
                                style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#f7faff">Team Leader Remarks:</td>
                            <td valign="top" bgcolor="#f7faff" id="teamleaderremarks"></td>
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
                            <td width="32%" height="35" align="right" valign="middle"><input name="new" type="reset"
                                class="swiftchoicebutton" id="new" value="New"
                                onclick="setradiovalue(document.getElementById('submitform').anonymous, 'no'); newentry(); formsubmitcustomer(); clearinnerhtml();clearform();  gettime();" />
                              &nbsp;&nbsp;&nbsp;
                              <input name="save" type="submit" class="swiftchoicebutton" id="save" value="Save"
                                onclick="formsubmit('save')" />
                              &nbsp;&nbsp;&nbsp;
                              <input name="delete" type="submit" class="swiftchoicebuttondisabled" id="delete"
                                value="Delete" onclick="formsubmit('delete')" disabled="disabled" />
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
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
                            <td valign="top"><input name="fromdate" type="text" class="swifttext" id="DPC_fromdate"
                                size="30" autocomplete="off" readonly="readonly" style="background:#FEFFE6;"
                                value="<?php echo ($date); ?>" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">To Date:</td>
                            <td valign="top"><input name="todate" type="text" class="swifttext" id="DPC_todate"
                                size="30" autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo (datetimelocal('d-m-Y')); ?>" /></td>
                          </tr>
                          <tr bgcolor="#EDF4FF">
                            <td valign="top">Call Type:</td>
                            <td valign="top" bgcolor="#EDF4FF"><label>
                                <input name="s_calltype" type="radio" id="s_incoming" value="incoming" />
                                Incoming</label>
                              <label>
                                <input name="s_calltype" type="radio" id="s_outgoing" value="outgoing" />
                                Outgoing</label>
                              <input type="radio" name="s_calltype" id="s_calltypeboth" checked="checked" value="" />
                              Both
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Anonymous:</td>
                            <td valign="top"><label></label>
                              <label>
                                <input type="radio" name="s_anonymous" id="databasefield11" value="yes" />
                                Yes</label>
                              <label>
                                <input type="radio" name="s_anonymous" id="databasefield12" value="no" />
                                No</label>
                              <label>
                                <input type="radio" name="s_anonymous" id="databasefield13" value=""
                                  checked="checked" />
                                Both</label>
                              <label></label>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Customer Name:</td>
                            <td valign="top" bgcolor="#EDF4FF"><input name="s_customername" type="text"
                                class="swifttext" id="s_customername" size="30" /> </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Customer ID:</td>
                            <td valign="top" bgcolor="#F7FAFF"><input name="s_customerid" type="text" class="swifttext"
                                id="s_customerid" size="30" autocomplete="off" /> </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Category:</td>
                            <td valign="top" bgcolor="#EDF4FF">
                              <label><input name='categoryblr' type='checkbox' id='categoryblr' value=''
                                  checked="checked" />BLR</label>
                              <label><input name='categorycsd' type='checkbox' id='categorycsd' value=''
                                  checked="checked" />CSD</label>
                              <label><input name='categorykkg' type='checkbox' id='categorykkg' value=''
                                  checked="checked" />KKG </label>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">State:</td>
                            <td valign="top" bgcolor="#EDF4FF">
                              <select name="s_state" id="s_state" class="swiftselect">
                                <?php include('../inc/state.php'); ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Caller Type:</td>
                            <td valign="top" bgcolor="#F7FAFF"><label>
                                <input name='s_customer' type='checkbox' id='s_customer' value='Customer'
                                  checked="checked" />
                                Customers </label><label>
                                <input name='s_dealer' type='checkbox' id='s_dealer' value='Dealer' checked="checked" />
                                Dealers</label>
                              <label>
                                <input name='s_employee' type='checkbox' id='s_employee' value='employee'
                                  checked="checked" />
                                Employees</label><label>
                                <input name='s_ssmuser' type='checkbox' id='s_ssmuser' value='SSMUser'
                                  checked="checked" />
                                SSM Users</label>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#EDF4FF">Product group:</td>
                            <td valign="top" bgcolor="#EDF4FF">
                              <span id="filterprdgroupdisplay">
                                <?php productname('s_productgroup', ''); ?>
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
                              </select></td>
                          </tr>
                        </table>
                      </td>
                      <td width="50%" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Problem:</td>
                            <td valign="top"><input name="s_problem" type="text" class="swifttextarea" id="s_problem"
                                value="" size="30" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Status:</td>
                            <td valign="top"><select name="s_status" id="s_status" class="swiftselect">
                                <option value="" selected="selected">All</option>
                                <option value="solved">Solved</option>
                                <option value="unsolved">Un Solved</option>
                                <option value="transferred">Transferred</option>
                                <option value="registration given">Registration Given</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Call Category:</td>
                            <td valign="top">
                              <select name="s_callcategory" id="s_callcategory" class="swiftselect">
                                <option value="" selected="selected">All</option>
                                <?php include('../inc/callcategory.php'); ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Transferred To:</td>
                            <td valign="top"><select name="s_transferredto" id="s_transferredto" class="swiftselect">
                                <option value="" selected="selected">All</option>
                                <option value="none" selected="selected">None</option>
                                <?php include('../inc/useridselection.php'); ?>
                                <option value="registration">Registration Department</option>
                                <option value="others">Others</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Entered By:</td>
                            <td valign="top"><select name="s_userid" id="s_userid" class="swiftselect">
                                <option value="" selected="selected">All</option>
                                <?php include('../inc/useridselection.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Compliant ID:</td>
                            <td valign="top">
                              <input name=" s_compliantid " type=" text " class=" swifttext " id=" s_compliantid "
                                size=" 30 " maxlength="40" autocomplete="off" />
                            </td>
                          </tr>
                          <tr bgcolor="#F7FAFF">
                            <td valign="top">Flags:</td>
                            <td valign="top"><label>
                                <input type="radio" name="flagdatabasefield" id="flagdatabasefield0" value="yes" />
                                Yes </label>
                              <label>
                                <input type="radio" name="flagdatabasefield" id="flagdatabasefield1" value="no" />
                                No</label>
                              <label><input type="radio" name="flagdatabasefield" id="flagdatabasefield2" value=""
                                  checked="checked" />
                                Both</label>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Support Unit:</td>
                            <td valign="top"><select name="s_supportunit" class="swiftselect" id="s_supportunit">
                                <option value="">ALL</option>
                                <?php include('../inc/supportunit.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#F7FAFF">
                            <td valign="top" bgcolor="#F7FAFF">Order By:</td>
                            <td valign="top" bgcolor="#F7FAFF">
                              <select name="orderby" class="swiftselect" id="orderby">
                                <option value="callertype">Caller Type</option>
                                <option value="category">Category</option>
                                <option value="compliantid" selected="selected">Compliant ID</option>
                                <option value="customerid">Customer ID</option>
                                <option value="customername">Registered Name</option>
                                <option value="date">Date</option>
                                <option value="userid">Entered By</option>
                                <option value="problem">Problem</option>
                                <option value="productgroup">Product Group</option>
                                <option value="productname">Product Name</option>
                                <option value="status">Status</option>
                                <option value="callcategory">Call Category</option>
                                <option value="transferredto">Transferred To</option>
                                <option value="time">Time</option>
                              </select>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="right" valign="middle"
                        style="padding-right:15px; border-top:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="85%" height="35" valign="middle">
                              <div id="filter-form-error"></div>
                            </td>
                            <td width="15%" height="35" align="right" valign="middle">
                              <input name="view" type="submit" class="swiftchoicebutton" id="view" value="View"
                                onclick="formfilter('view'); " />
                              &nbsp;&nbsp;&nbsp; <img src="../images/toexcel.png" border="0" align="absmiddle"
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
          <tr style="border-left:none;border-right:none;">
            <td width="46%" style="padding:0; border:none;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="84px" align="center" id="tabgroupgridh1" onclick="gridtab4('1','tabgroupgrid');"
                    style="cursor:pointer" class="grid-active-tabclass">Default</td>
                  <td width="2">&nbsp;</td>
                  <td width="84px" align="center" id="tabgroupgridh2" onclick="gridtab4('2','tabgroupgrid');"
                    style="cursor:pointer" class="grid-tabclass">Filter</td>
                  <td width="2">&nbsp;</td>
                  <td width="84px" align="center" id="tabgroupgridh3" onclick="gridtab4('3','tabgroupgrid');"
                    style="cursor:pointer" class="grid-tabclass">Flagged Entry</td>
                  <td width="2">&nbsp;</td>
                  <td width="84px" align="center" id="tabgroupgridh4" onclick="gridtab4('4','tabgroupgrid');"
                    style="cursor:pointer" class="grid-tabclass">Customer</td>
                  <td width="2">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td width="54%"><span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span><span
                id="tabgroupgridwb3"></span><span id="tabgroupgridwb4"></span><span id="tabgroupgridwb5"></span></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding:0">
        <table width="100%" border="0" cellspacing="0" cellpadding="0"
          style="border:1px solid #6393df; border-top:none;">
          <tr>
            <td width="10%" class="header-line" style="padding:0">&nbsp;&nbsp;View Records: </td>
            <td width="75%" class="header-line" style="padding:0"></td>
            <td width="15%" class="header-line" style="padding:0"></td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top">
              <div id="tabgroupgridc1" style="overflow:auto; height:300px; width:1060PX; padding:2px;" align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center">
                      <div id="tabgroupgridc1_2"> </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div id="tabgroupgridc1link1" style="padding:2px;" align="left"> </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div id="tabgroupgridc2" style="overflow:auto; height:300px; width:1060px; padding:2px;display:none"
                align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center">
                      <div id="tabgroupgridc1_1"> </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div id="tabgroupgridc1link" style="padding:2px;" align="left"> </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div id="regresultgrid" style="overflow:auto; display:none; height:300px; width:1060px; padding:2px;">
                &nbsp;</div>

              <div id="tabgroupgridc3" style="overflow:auto; height:300px; width:1060px; padding:2px; display:none">No
                records to be displayed. Please filter the records from the filter form</div>
              <div id="tabgroupgridc4" style="overflow:auto; height:300px; width:1060px; padding:2px; display:none">No
                records to be displayed. Please filter the records from the filter form</div>
            </td>
          </tr>
        </table>
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