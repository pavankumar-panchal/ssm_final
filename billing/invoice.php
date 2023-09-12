<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <script language="javascript" src="../functions/invoiceregister.js" type="text/javascript"></script>
  <script>
    $(document).ready(function () {
      //prdgroup();
    });
  </script>

  <div id="contentdiv" style="display:block;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td class="content-header">Billing > Invoice</td>
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
                  <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
                    <div id="tabgrouponsitec1">
                      <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr bgcolor="#f7faff">
                                <td valign="top">Registered Name:</td>
                                <td valign="top">
                                  <input name="customername" type="text" class="swifttext" id="customername" size="30"
                                    readonly="readonly" value="" autocomplete="off" style="background:#FEFFE6;" />
                                  <span id="getcustomerlink" style="visibility:visible;"> <a href="javascript:void(0);"
                                      onClick="getregisterdata(); getcustomerfunc();registernameload('invoice');"
                                      style="cursor:pointer">
                                      <img src="../images/userid-bg.gif" width="14" height="16" border="0"
                                        align="absmiddle" /></a></span>
                                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                                  <input type="hidden" name="cusid" id="cusid" value="" />
                                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                  <input type="hidden" name="loggedusertype" id="loggedusertype"
                                    value="<?php echo ($usertype); ?>" />
                                  <input type="hidden" name="endtime" id="endtime" value="" />
                                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                    value="<?php echo ($reportingauthority); ?>" />
                                  <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                                    value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                                </td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Customer ID:</td>
                                <td valign="top">
                                  <input name="customerid" type="text" class="swifttext" id="customerid" size="30"
                                    readonly="readonly" value="" autocomplete="off" style="background:#FEFFE6;" />
                                </td>
                              </tr>

                              <tr bgcolor="#f7faff">
                                <td valign="top">Product Group:</td>
                                <td valign="top">
                                  <input name="productgroup" type="text" class="swifttext" id="productgroup" size="30"
                                    readonly="readonly" autocomplete="off" style="background:#FEFFE6;" />
                                </td>
                              </tr>

                              <tr bgcolor="#edf4ff">
                                <td valign="top">Product Name:</td>
                                <td valign="top">
                                  <input name="productname" type="text" class="swifttext" id="productname" size="30"
                                    readonly="readonly" autocomplete="off" style="background:#FEFFE6;" />
                                </td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Product Version:</td>
                                <td valign="top">
                                  <input name="productversion" type="text" class="swifttext" id="productversion" size="30"
                                    readonly="readonly" autocomplete="off" style="background:#FEFFE6;" />
                                </td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">State:</td>
                                <td valign="top">
                                  <select name="state" id="state" class="swifttext" autocomplete="off" readonly="readonly"
                                    maxlength="10" style="background:#FEFFE6;">
                                    <?php include('../inc/state.php'); ?>
                                  </select>
                                </td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Bill Number:</td>
                                <td valign="top">
                                  <input name="billno" type="text" class="swifttext" id="billno" size="30" maxlength="10"
                                    readonly="readonly" autocomplete="off" style="background:#FEFFE6;" />
                                </td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Bill Date:</td>
                                <td valign="top" bgcolor="#edf4ff">
                                  <input name="billdate" type="text" class="swifttext" id="billdate" size="30"
                                    maxlength="10" readonly="readonly" autocomplete="off"
                                    onBlur="this.value = datestringupdate(this.value)" style="background:#FEFFE6;" />
                                </td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Register Name:</td>
                                <td valign="top">
                                  <input name="registername" type="text" class="swifttext" id="registername" size="30"
                                    maxlength="10" readonly="readonly" autocomplete="off" style="background:#FEFFE6;" />
                                </td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Complaint ID:</td>
                                <td valign="top">
                                  <input name="complaintid" type="text" class="swifttext" id="complaintid" size="30"
                                    maxlength="10" readonly="readonly" autocomplete="off" style="background:#FEFFE6;" />
                                </td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Date:</td>
                                <td valign="top">
                                  <input name="date" type="text" class="swifttext" id="date" size="30" maxlength="10"
                                    value="<?php echo ($localdate); ?>" readonly="readonly" autocomplete="off"
                                    style="background:#FEFFE6;" />
                                </td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Time:</td>
                                <td valign="top">
                                  <input name="time" type="text" class="swifttext" id="time" size="30" maxlength="10"
                                    value="<?php echo ($localtime); ?>" readonly="readonly" autocomplete="off"
                                    style="background:#FEFFE6;" />
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td width="50%" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr bgcolor="#f7faff">
                                <td valign="top">Bill Given To:</td>
                                <td valign="top"><input name="billto" type="text" class="swifttext" id="billto" size="30"
                                    autocomplete="off" /></td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Billed By:</td>
                                <td valign="top"><select name="billedby" class="swiftselect" id="billedby"
                                    readonly="readonly">
                                    <option value="" selected="selected">Select</option>
                                    <?php include('../inc/useridselection.php'); ?>
                                  </select></td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Amount:</td>
                                <td valign="top"><input name="amount" type="text" class="swifttext" id="amount" size="30"
                                    maxlength="10" onKeyPress="javascript:invoicetotalamount();"
                                    onChange="javascript:invoicetotalamount();" style="text-align:right"
                                    autocomplete="off" /></td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Tax Amount:</td>
                                <td valign="top"><input name="tax" type="text" class="swifttext" id="tax" size="30"
                                    onKeyPress="javascript:invoicetotalamount();"
                                    onChange="javascript:invoicetotalamount();" style="text-align:right"
                                    autocomplete="off" /></td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Total Amount:</td>
                                <td valign="top"><input name="tamount" type="text" class="swifttext" id="tamount"
                                    size="30" style="text-align:right;background:#FEFFE6;" autocomplete="off"
                                    readonly="readonly" /></td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top" bgcolor="#edf4ff">Remarks:</td>
                                <td valign="top"><textarea name="remarks" cols="45" class="swifttextarea"
                                    id="remarks"></textarea></td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">User ID:</td>
                                <td valign="top"><input name="userid" type="text" class="swifttext" id="userid" size="30"
                                    readonly="readonly" value="<?php echo ($loggedusername); ?>" autocomplete="off"
                                    style="background:#FEFFE6;" /></td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">Team leader Remarks:</td>
                                <td valign="top" id="teamleaderremarks">&nbsp;</td>
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
                                    onclick="newentry();clearinnerhtml();gettime(); " />
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
                  <form action="" method="post" name="filterform" id="filterform" onSubmit="return false;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr bgcolor="#f7faff">
                              <td valign="top">From Date:</td>
                              <td valign="top"><input name="fromdate" type="text" class="swifttext" id="DPC_fromdate"
                                  size="30" autocomplete="off" style="background:#FEFFE6;" /></td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">To Date:</td>
                              <td valign="top"><input name="todate" type="text" class="swifttext" id="DPC_todate"
                                  size="30" autocomplete="off" style="background:#FEFFE6;" /> </td>
                            </tr>
                            <tr bgcolor="#f7faff">
                              <td valign="top">Customer Name:</td>
                              <td valign="top"><input name="s_customername" type="text" class="swifttext"
                                  id="s_customername" size="30" /> </td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">Customer ID:</td>
                              <td valign="top"><input name="s_customerid" type="text" class="swifttext" id="s_customerid"
                                  size="30" autocomplete="off" /> </td>
                            </tr>
                            <tr bgcolor="#f7faff">
                              <td valign="top" bgcolor="#EDF4FF">Product group:</td>
                              <td valign="top" bgcolor="#EDF4FF">
                                <span id="filterprdgroupdisplay">
                                  <?php include('../inc/productgroup.php');
                                  productname('s_productgroup', '');
                                  ?>
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
                            <tr bgcolor="#f7faff">
                              <td valign="top" bgcolor="#EDF4FF">State:</td>
                              <td valign="top" bgcolor="#EDF4FF">
                                <select name="s_state" id="s_state" class="swifttext">
                                  <?php include('../inc/state.php'); ?>
                                </select>
                              </td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">Bill Number:</td>
                              <td valign="top"><input name="s_billno" type="text" class="swifttextarea" id="s_billno"
                                  value="" size="30" /></td>
                            </tr>
                            <tr bgcolor="#f7faff">
                              <td valign="top">Bill Date:</td>
                              <td valign="top"><input name="s_billdate" type="text" class="swifttext" id="DPC_s_billdate"
                                  size="30" maxlength="10" autocomplete="off" style="background:#FEFFE6;" /></td>
                            </tr>
                          </table>
                        </td>
                        <td width="50%" valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="3">
                            <tr bgcolor="#f7faff">
                              <td valign="top">Register Name:</td>
                              <td valign="top"><input name="s_registername" type="text" class="swifttext"
                                  id="s_registername" size="30" autocomplete="off" /></td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">Billed By:</td>
                              <td valign="top"><select name="s_billedby" id="s_billedby" class="swiftselect">
                                  <option value="" selected="selected">All</option>
                                  <?php include('../inc/useridselection.php'); ?>
                                </select></td>
                            </tr>
                            <tr bgcolor="#f7faff">
                              <td valign="top">Amount:</td>
                              <td valign="top"><input name="s_amount" type="text" class="swifttext" id="s_amount" value=""
                                  size="30" autocomplete="off" /></td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">Entered By:</td>
                              <td valign="top"><select name="s_userid" id="s_userid" class="swiftselect">
                                  <option value="" selected="selected">All</option>
                                  <?php include('../inc/useridselection.php'); ?>
                                </select></td>
                            </tr>
                            <tr bgcolor="#f7faff">
                              <td valign="top">Compliant ID:</td>
                              <td valign="top"><input name="s_complaintid" type="text" class="swifttext"
                                  id="s_complaintid" size="30" maxlength="40" autocomplete="off" /></td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top">Flags:</td>
                              <td valign="top"><label>
                                  <input type="radio" name="flagdatabasefield" id="flagdatabasefield0" value="yes" />
                                  Yes </label>
                                <label>
                                  <input type="radio" name="flagdatabasefield" id="flagdatabasefield1" value="no" />
                                  No</label><label><input type="radio" name="flagdatabasefield" id="flagdatabasefield2"
                                    value="" checked="checked" />
                                  Both</label>
                              </td>
                            </tr>
                            <tr bgcolor="#edf4ff">
                              <td valign="top" bgcolor="#F7FAFF">Order By:</td>
                              <td valign="top" bgcolor="#F7FAFF"><select name="orderby" class="swiftselect" id="orderby">
                                  <option value="callertype">Caller Type</option>
                                  <option value="category">Category</option>
                                  <option value="complaintid" selected="selected">Compliant ID</option>
                                  <option value="customerid">Customer ID</option>
                                  <option value="customername">Registered Name</option>
                                  <option value="date">Date</option>
                                  <option value="userid">Entered By</option>
                                  <option value="problem">Problem</option>
                                  <option value="productname">Product Name</option>
                                  <option value="status">Status</option>
                                  <option value="solvedby">Solved BY</option>
                                  <option value="billno">Bill Number</option>
                                  <option value="billdate">Bill Date</option>
                                  <option value="acknowledgementno">Acknowledgement Number</option>
                                </select></td>
                            </tr>
                          </table>
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
                              <td width="15%" height="35" align="right" valign="middle"><input name="view" type="submit"
                                  class="swiftchoicebutton" id="view" value="View" onclick="formfilter('view'); " />
                                &nbsp;&nbsp;&nbsp; <img src="../images/toexcel.png" border="0" align="absmiddle"
                                  onclick="formfilter('toexcel');" style="cursor:pointer" /></td>
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
                <table width="114%" border="0" cellspacing="0" cellpadding="0">
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
                  id="tabgroupgridwb3"></span><span id="tabgroupgridwb4"></span></td>
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
        <td class="content-header">Invoice > Get Onsite/Inhouse Records</td>
      </tr>
      <tr>
        <td>
          <div id="gc-form-error"></div>
        </td>
      </tr>
      <?php include('../inc/invoiceregisterload.php'); ?>
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
<?php } ?>