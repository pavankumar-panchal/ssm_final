<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand());?>">
<script language="javascript" src="../functions/callregister.js?dummy = <?php echo (rand());?>" type="text/javascript"></script>
<div id="contentdiv" style="display:block;">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Reports > Day</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
        <td class="header-line" style="padding:0">&nbsp;&nbsp;Enter / Edit / View Details</td>
        <td align="right" class="header-line" style="padding-right:7px"><div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"  align="absmiddle" /></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="maindiv">
          <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">Registers:</td>
                      <td valign="top"><label><input name='check[]' type='checkbox' value='Call'/>
Calls</label><label>
  <input type='checkbox' name='check[]' value='Email'/>
Emails</label><label>
<input type='checkbox' name='check[]' value='Skype'/>
Skype </label><label>
<input type='checkbox' name='check[]2' value='Error'/>
Errors </label><label>
<input type='checkbox' name='check[]3' value='Onsite'/>
Onsite</label><label>
<input name='check[]3' type='checkbox' id="check[]" value='Reference'/>
References</label><label>
<input name='check[]3' type='checkbox' id="check[]" value='Inhouse'/>
Inhouse</label><label>
<input name='check[]3' type='checkbox' id="check[]" value='Requirement'/>
Requirements</label><a href="javascript:void(0);" onClick="getcustomer(); getcustomerfunc(); registernameload('call')" style="cursor:pointer"> <img src="../images/userid-bg.gif" width="14" height="16" border="0" align="absmiddle" /></a>
                        <input type="hidden" name="lastslno" id="lastslno" value="" />
                          <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo($user); ?>"/>
                          <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo($usertype); ?>"/>
                          <input type="hidden" name="endtime" id="endtime" value=""/>
                          <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority" value="<?php echo($reportingauthoritytype ); ?>"/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">From Date:</td>
                      <td valign="top"><input name="fromdate2" type="text" class="swifttext" id="fromdate2" size="30" autocomplete="off" onclick="displayDatePicker('fromdate');" onkeypress="datemakereadonly(event,this);" readonly="readonly" style="background:#FEFFE6;" /></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">To Date:</td>
                      <td valign="top"><input name="todate2" type="text" class="swifttext" id="todate2" size="30" autocomplete="off"  onclick="displayDatePicker('todate');" onkeypress="datemakereadonly(event,this);" readonly="readonly" style="background:#FEFFE6;" /></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Entered By:</td>
                      <td valign="top"><select name="userid" id="userid" class="swiftselect">
                        <option value="" selected="selected">All</option>
                        <?php include('../inc/useridselectionreports.php'); ?>
                      </select></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Caller Type:</td>
                      <td valign="top"><label>
                        <input type='checkbox' name='dealer' id='dealer' value='Dealer'/>
Dealer</label>
                        <label>
                        <input type='checkbox' name='customer' id='customer' value='Customer'/>
Customer </label>
                        <label>
                        <input type='checkbox' name='osemployee' id='osemployee' value='OSEmployee'/>
Outstation Employee</label></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Category:</td>
                      <td valign="top"><select name="category"  id="category" class="selectlist">
                        <option value="" selected="selected">ALL</option>
                        <option value="KKG">KKG</option>
                        <option value="CSD">CSD</option>
                        <option value="BLR">Bangalore</option>
                      </select></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#f7faff">&nbsp;</td>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">&nbsp;</td>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">&nbsp;</td>
                      <td valign="top">&nbsp;</td>
                    </tr>
                </table></td>
                </tr>
              <tr>
                <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
  <tr>
                <td width="68%" height="35" align="left" valign="middle"><div id="form-error"></div></td>
                <td width="32%" height="35" align="right" valign="middle"><input name="new" type="reset" class="swiftchoicebutton" id="new" value="New" onClick="newentry();clearinnerhtml(); " />
&nbsp;&nbsp;&nbsp;
<input name="save" type="submit" class="swiftchoicebutton" id="save" value="Save" onClick="formsubmit('save')" />
&nbsp;&nbsp;&nbsp;
<input name="delete" type="submit" class="swiftchoicebuttondisabled" id="delete" value="Delete"  onclick="formsubmit('delete')" disabled="disabled"/></td>
              </tr>
</table></td>
              </tr>
            </table>
          </form>
        </div></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td style="padding:0">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr style="cursor:pointer" onClick="showhide('filterdiv','toggleimg1');">
        <td class="header-line" style="padding:0">&nbsp;&nbsp;Filter the Data:</td>
        <td align="right" class="header-line" style="padding-right:7px;"><div align="right"><img src="../images/plus.jpg" border="0" id="toggleimg1" name="toggleimg1"  align="absmiddle" /></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="filterdiv" style="display:none">
          <form action="" method="post" name="filterform" id="filterform" onSubmit="return false;">
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="50%" valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">From Date:</td>
                      <td valign="top"><input name="fromdate" type="text" class="swifttext" id="fromdate" size="30" autocomplete="off" onClick="displayDatePicker('fromdate');" onKeyPress="datemakereadonly(event,this);" readonly="readonly" style="background:#FEFFE6;" /></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">To Date:</td>
                      <td valign="top"><input name="todate" type="text" class="swifttext" id="todate" size="30" autocomplete="off"  onclick="displayDatePicker('todate');" onKeyPress="datemakereadonly(event,this);" readonly="readonly" style="background:#FEFFE6;" /></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Customer Name:</td>
                      <td valign="top"><input name="s_customername" type="text" class="swifttext" id="s_customername" size="30" />                        </td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Customer ID:</td>
                      <td valign="top"><input name="s_customerid" type="text" class="swifttext" id="s_customerid" size="30" autocomplete="off"/>                        </td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Category:</td>
                      <td valign="top"><input name="s_category" type="text" class="swifttext" id="s_category" size="30"  autocomplete="off" /></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Caller Type:</td>
                      <td valign="top"><input name="s_callertype" type="text" class="swifttext" id="s_callertype" size="30"  autocomplete="off"  /></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Product Name:</td>
                      <td valign="top"><select name="s_productname" class="swiftselect" id="s_productname">
                        <option value="">All</option>
                        <?php include('../inc/productname.php'); ?>
                      </select></td>
                    </tr>
                </table></td>
                <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">Problem:</td>
                      <td valign="top"><input name="s_problem" type="text" class="swifttextarea" id="s_problem" value="" size="30" /></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Status:</td>
                      <td valign="top"><select name="s_status" id="s_status" class="swiftselect">
                        <option value="" selected="selected">All</option>
                        <option value="solved">Solved</option>
                        <option value="unsolved">Un Solved</option>
                        <option value="transferred">Transferred</option>
                        <option value="registration">Registration Given</option>
                      </select></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Transferred To:</td>
                      <td valign="top"><select name="s_transferredto" id="s_transferredto" class="swiftselect">
                        <option value="" selected="selected">All</option>
                        <?php include('../inc/useridselection.php'); ?>
                        <option value="registration">Registration Department</option>
                        <option value="others">Others</option>
                      </select></td>
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
                      <td valign="top"><input name="s_compliantid" type="text" class="swifttext" id="s_compliantid" size="30" maxlength="40" autocomplete="off"/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Flags</td>
                      <td valign="top"><label>
                            <input type="radio" name="flagdatabasefield" id="flagdatabasefield0" value="yes"/>
Yes </label>
                            <label>
                            <input type="radio" name="flagdatabasefield" id="flagdatabasefield1" value="no"  />
No</label>
                            <label><input type="radio" name="flagdatabasefield" id="flagdatabasefield1" value="" checked="checked"  />
Nor Both</label> </td>
                    </tr>
                    <tr bgcolor="#F7FAFF">
                      <td valign="top">Order By:</td>
                      <td valign="top">
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
                      </select></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2" align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
                <td width="85%" height="35" valign="middle"><div id="filter-form-error"></div></td>
                <td width="15%" height="35" align="right" valign="middle"><input name="view" type="submit" class="swiftchoicebutton" id="view" value="View" onClick="formfilter('view'); " />
&nbsp;&nbsp;&nbsp; <img src="../images/toexcel.png"  border="0" align="absmiddle" onClick="formfilter('toexcel');"/></td>
              </tr></table>
</td>
              </tr>
            </table>
          </form>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="padding:0">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr style="border-left:none;border-right:none;">
        <td style="padding:0; border:none;"><table width="44%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="84px" align="center" id="tabgroupgridh1" onClick="gridtab4('1','tabgroupgrid');" style="cursor:pointer" class="grid-active-tabclass">Default</td>
            <td width="2">&nbsp;</td>
            <td width="84px" align="center" id="tabgroupgridh2" onClick="gridtab4('2','tabgroupgrid');" style="cursor:pointer" class="grid-tabclass">Filter</td>
            <td width="2">&nbsp;</td>
            <td width="84px" align="center" id="tabgroupgridh3" onClick="gridtab4('3','tabgroupgrid');" style="cursor:pointer" class="grid-tabclass">Flagged Entry</td>
            <td width="2">&nbsp;</td>
            <td width="84px" align="center" id="tabgroupgridh4" onClick="gridtab4('4','tabgroupgrid');" style="cursor:pointer" class="grid-tabclass">Customer</td>
            <td width="2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr>
        <td width="10%" class="header-line" style="padding:0">&nbsp;&nbsp;View Records:  </td>
        <td width="75%" class="header-line" style="padding:0"><span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span><span id="tabgroupgridwb3"></span><span id="tabgroupgridwb4"></span></td>
        <td width="15%" class="header-line" style="padding:0"></td>
      </tr>
      <tr>
        <td colspan="3" align="center" valign="top"><div id="tabgroupgridc1" style="overflow:auto; height:300px; width:1060PX; padding:2px;" align="center"></div>
            <div id="tabgroupgridc2" style="overflow:auto; height:300px; width:1060px; padding:2px; display:none">No records to be displayed. Please filter the records from the filter form</div>
            <div id="tabgroupgridc3" style="overflow:auto; height:300px; width:1060px; padding:2px; display:none">No records to be displayed. Please filter the records from the filter form</div>
            <div id="tabgroupgridc4" style="overflow:auto; height:300px; width:1060px; padding:2px; display:none">No records to be displayed. Please filter the records from the filter form</div>
      </tr>
    </table></td>
  </tr>
</table>
</div>


<div id="nameloaddiv" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Call Register > Get Customer</td>
  </tr>
  <tr>
    <td><div id="gc-form-error"></div></td>
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
    <td><div id="gq-form-error"></div></td>
  </tr>
  <? include('../inc/questionload.php'); ?>
</table>
</div>
