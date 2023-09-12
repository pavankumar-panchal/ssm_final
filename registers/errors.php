<?php
$month = date('m');
if ($month >= '04')
  $date = '01-04-' . date('Y');
else {
  $year = date('Y') - '1';
  $date = '01-04-' . $year; //echo($date);
}

?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/errorregister.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Registers > Errors</td>
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
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Anonymous:</td>
                            <td valign="top" bgcolor="#f7faff"><label>
                                <input name="anonymous" type="radio" id="databasefield12"
                                  onclick="formsubmitcustomer();" value="yes" />
                                Yes</label>
                              <label>
                                <input name="anonymous" type="radio" id="databasefield13"
                                  onclick="formsubmitcustomer();" value="no" checked="checked" />
                                No</label>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Reported By:</td>
                            <td valign="top"><label>
                                <input name="customername" type="text" class="swifttext" id="customername" size="30"
                                  autocomplete="off" readonly="readonly" style="background:#FEFFE6;" />
                                <span id="getcustomerlink" style="visibility:visible;"><a href="javascript:void(0);"
                                    onClick="getcustomer(); getcustomerfunc();registernameload('error')"
                                    style="cursor:pointer"><img src="../images/userid-bg.gif" width="14" height="16"
                                      border="0" align="absmiddle" /></a></span>
                                <input type="hidden" name="lastslno" id="lastslno" value="" />
                                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                <input type="hidden" name="loggedusertype" id="loggedusertype"
                                  value="<?php echo ($usertype); ?>" />
                                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                  value="<?php echo ($reportingauthority); ?>" />
                                <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                                  value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                                <input type="hidden" name="customerid" id="customerid" value="" />
                                <input type="hidden" name="errorreportgrid" id="errorreportgrid" value="" />
                              </label></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Date:</td>
                            <td valign="top"><input name="date" type="text" class="swifttext" id="date" size="30"
                                autocomplete="off" readonly="readonly" value="<?php echo (datetimelocal('d-m-Y')); ?>"
                                style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Time:</td>
                            <td valign="top">
                              <input name="time" type="text" class="swifttext" id="time" size="30" autocomplete="off"
                                readonly="readonly" value="<?php echo (datetimelocal('H:i:s')); ?>"
                                style="background:#FEFFE6;" />
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">State:</td>
                            <td valign="top">
                              <select name="state" id="state" class="swiftselect" autocomplete="off" disabled="disabled"
                                style="background:#FEFFE6;">

                                <?php include('../inc/state.php'); ?>
                              </select>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Product group:</td>
                            <td valign="top">
                              <?php include('../inc/productgroup.php');
                              productname('productgroup', '');
                              ?>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Product Name(<font color="#FF0000">Optional</font>)</td>
                            <td valign="top"><span id="productnamedisplay">
                                <select name="productname" class="swiftselect" id="productname">
                                  <option value="">Make A Selection</option>
                                </select></span></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Product Version:</td>
                            <td valign="top"><span id="productversiondisplay"><select name="productversion"
                                  id="productversion" class="swiftselect">
                                  <option value="">Make A Selection</option>
                                </select> </span> </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Database:</td>
                            <td valign="top"><select name="database" id="database" class="swiftselect">
                                <option value="">Make A Selection</option>
                                <option value="access">MS Access</option>
                                <option value="sql">MS SQL</option>
                                <option value="mysql">MySQL</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Error Reported:</td>
                            <td valign="top"><textarea name="errorreported" cols="45" class="swifttextarea"
                                id="errorreported"></textarea>
                              <a href="javascript:void(0);" style="cursor:pointer"
                                onclick="getquestionfunc(); getquestion();"><img src="../images/get-problem.gif"
                                  width="22" height="22" border="0" align="top" /></a>
                            </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Error understood by you:</td>
                            <td valign="top"><textarea name="errorunderstood" cols="45" class="swifttextarea"
                                id="errorunderstood"></textarea></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Reported To:</td>
                            <td valign="top"><input name="reportedto" type="text" class="swifttext" id="reportedto"
                                size="30" autocomplete="off" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Error File:</td>
                            <td valign="top"><input name="errorfile" type="text" class="swifttext" id="errorfile"
                                size="30" autocomplete="off" readonly="readonly" style="background:#FEFFE6;" />
                              <img id="myfileuploadimage" src="../images/fileattach.jpg" border="0" align="absmiddle"
                                onclick="fileuploaddivid('downloadlinkfile','errorfile','fileuploaddiv','430px','20%')" />
                              <span id="downloadlinkfile"></span>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td width="50%" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Status:</td>
                            <td valign="top"><select name="status" id="status" class="swiftselect">
                                <option value="solved">Solved</option>
                                <option value="unsolved" selected="selected">Un Solved</option>
                                <option value="rejected">Rejected</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Solved Date:</td>
                            <td valign="top"><input name="solveddate" type="text" class="swifttext" id="DPC_solveddate"
                                size="30" autocomplete="off" style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Solution Given:</td>
                            <td valign="top"><textarea name="solutiongiven" cols="45" class="swifttextarea"
                                id="solutiongiven"></textarea></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Solution Entered Time:</td>
                            <td valign="top"><input name="solutionenteredtime" type="text" class="swifttext"
                                id="solutionenteredtime" size="30" readonly="readonly" value="" autocomplete="off"
                                style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Solution File:</td>
                            <td valign="top"><input name="solutionfile" type="text" class="swifttext" id="solutionfile"
                                size="30" autocomplete="off" readonly="readonly" style="background:#FEFFE6;" />
                              <img src="../images/fileattach.jpg" name="myfileuploadimage1" border="0" align="absmiddle"
                                id="myfileuploadimage1"
                                onclick="fileuploaddivid('downloadlinkfile1','solutionfile','fileuploaddiv','330px','65%')" />
                              <span id="downloadlinkfile1"></span>
                            </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Remarks:</td>
                            <td valign="top"><textarea name="remarks" cols="45" class="swiftselect"
                                id="remarks"></textarea></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Entered By:</td>
                            <td valign="top"><input name="userid" type="text" class="swifttext" id="userid" size="30"
                                readonly="readonly" value="<?php echo ($loggedusername); ?>" autocomplete="off"
                                style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Error ID:</td>
                            <td valign="top"><input name="errorid" type="text" class="swifttext" id="errorid" size="30"
                                readonly="readonly" autocomplete="off" style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Team Leader Remarks:</td>
                            <td valign="top" id="teamleaderremarks"></td>
                          </tr>

                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="right" valign="middle"
                        style="padding-right:15px; border-top:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                          <tr>
                            <td width="60%" height="35" align="left" valign="middle">
                              <div id="form-error"></div>
                            </td>
                            <td width="40%" height="35" align="right" valign="middle"><input name="new" type="reset"
                                class="swiftchoicebutton" id="new" value="New"
                                onclick="setradiovalue(document.getElementById('submitform').anonymous, 'no'); newentry(); formsubmitcustomer(); clearinnerhtml(); gettime();" />
                              &nbsp;&nbsp;&nbsp;
                              <input name="save" type="submit" class="swiftchoicebutton" id="save" value="Save"
                                onclick="formsubmit('save')" />
                              &nbsp;&nbsp;&nbsp;
                              <input name="delete" type="submit" class="swiftchoicebuttondisabled" id="delete"
                                value="Delete" onclick="formsubmit('delete')" disabled="disabled" />
                              &nbsp;&nbsp;&nbsp;
                              <input name="errorreport" type="submit" class="swiftchoicebuttondisabled" id="errorreport"
                                value="Error Report" onclick="formsubmit('errorreport')"
                                disabled="disabled" />&nbsp;&nbsp;&nbsp;
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
                <form action="" method="post" name="filterform" id="filterform" onSubmit="return false;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="50%" valign="top" style="border-right:1px solid #d1dceb;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">From Date:</td>
                            <td valign="top"><input name="fromdate" type="text" class="swifttext" id="DPC_fromdate"
                                size="30" autocomplete="off" style="background:#FEFFE6;"
                                value="<?php echo ($date); ?>" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">To Date:</td>
                            <td valign="top"><label></label><label>
                                <input name="todate" type="text" class="swifttext" id="DPC_todate" size="30"
                                  autocomplete="off" style="background:#FEFFE6;"
                                  value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                              </label></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Anonymous:</td>
                            <td valign="top"><label></label>
                              <label>
                                <input type="radio" name="s_anonymous" id="databasefield9" value="yes" />
                                Yes</label>
                              <label>
                                <input type="radio" name="s_anonymous" id="databasefield10" value="no" />
                                No</label>
                              <label>
                                <input type="radio" name="s_anonymous" id="databasefield11" value=""
                                  checked="checked" />
                                Both</label>
                              <label></label>
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
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Reported By:</td>
                            <td valign="top" bgcolor="#EDF4FF"><label></label>
                              <label>
                                <input name="s_customername" type="text" class="swifttext" id="s_customername"
                                  size="30" />
                              </label>
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
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Error Reported:</td>
                            <td valign="top" bgcolor="#EDF4FF"><input name="s_errorreported" type="text"
                                class="swifttext" id="s_errorreported" value="" size="30" /> </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Reported To:</td>
                            <td valign="top" bgcolor="#F7FAFF"><input name="s_reportedto" type="text" class="swifttext"
                                id="s_reportedto" size="30" autocomplete="off" /> </td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Error File:</td>
                            <td valign="top" bgcolor="#EDF4FF"><input name="s_errorfile" type="text" class="swifttext"
                                id="s_errorfile" size="30" autocomplete="off" /> </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top" bgcolor="#F7FAFF">Status:</td>
                            <td valign="top" bgcolor="#F7FAFF"><select name="s_status" id="s_status"
                                class="swiftselect">
                                <option value="" selected>All</option>
                                <option value="solved">Solved</option>
                                <option value="unsolved">Un Solved</option>
                              </select></td>
                          </tr>
                        </table>
                      </td>
                      <td width="50%" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td valign="top">Solved Date:</td>
                            <td valign="top"><input name="s_solveddate" type="text" class="swifttext"
                                id="DPC_s_solveddate" size="30" autocomplete="off" style="background:#FEFFE6;" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Solution Given:</td>
                            <td valign="top"><input name="s_solutiongiven" type="text" class="swifttext"
                                id="s_solutiongiven" value="" size="30" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#f7faff">Solution File:</td>
                            <td valign="top"><input name="s_solutionfile" type="text" class="swifttext"
                                id="s_solutionfile" size="30" autocomplete="off" /></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Remarks:</td>
                            <td valign="top"><input name="s_remarks" type="text" class="swifttext" id="s_remarks"
                                value="" size="30" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Entered By:</td>
                            <td valign="top"><select name="s_userid" id="s_userid" class="swiftselect">
                                <option value="" selected="selected">All</option>
                                <?php include('../inc/useridselection.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Error ID:</td>
                            <td valign="top"><input name="s_errorid" type="text" class="swifttext" id="s_errorid"
                                size="30" maxlength="40" autocomplete="off" /></td>
                          </tr>
                          <tr bgcolor="#f7faff">
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
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#EDF4FF">Support Unit:</td>
                            <td valign="top" bgcolor="#EDF4FF"><select name="s_supportunit" class="swiftselect"
                                id="s_supportunit">
                                <option value="">ALL</option>
                                <?php include('../inc/supportunit.php'); ?>
                              </select></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top" bgcolor="#F7FAFF">Order By:</td>
                            <td valign="top" bgcolor="#F7FAFF"><select name="orderby" class="swiftselect" id="orderby">
                                <option value="customername">Customer Name</option>
                                <option value="productgroup">Product Group</option>
                                <option value="productname">Product Name</option>
                                <option value="errorreported" selected="selected">Error Reported</option>
                                <option value="reportedto">Reported To</option>
                                <option value="errorfile">Error File</option>
                                <option value="status">Status</option>
                                <option value="solveddate">Solved Date</option>
                                <option value="solutiongiven">Solution Given</option>
                                <option value="remarks">Remarks</option>
                                <option value="userid">User ID</option>
                                <option value="errorid">Error ID</option>
                                <option value="time">Time</option>
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
      <td class="content-header">Email Register > Get Problems and Solutions</td>
    </tr>
    <tr>
      <td>
        <div id="gq-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/questionload.php'); ?>
  </table>
</div>
<div id="fileuploaddiv" style="display:none;">
  <?php include('../inc/fileuploadform.php'); ?>
</div>