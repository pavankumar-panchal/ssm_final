
<link rel="stylesheet" type="text/css" href="../style/main.css">
<script language="javascript" src="../functions/customer.js" type="text/javascript"></script>
<script language="javascript" src="../functions/getdistrictjs.php"></script>
<script language="javascript" src="../functions/javascripts.php"></script>

<?php $userid = $_COOKIE['userid'];?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td width="23%" valign="top" style="border-right:#1f4f66 1px solid;border-bottom:#1f4f66 1px solid;" ><table width="100%" border="0" cellspacing="0" cellpadding="0" id="mainwrap">
        <tr>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" align="left"class="header-line" style="padding-left:10px" >Customer Selection</td>
              </tr>
              <tr>
                <td colspan="2"><form id="filterform" name="filterform" method="post" action="" onsubmit="return false;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td width="71%" height="34" id="customerselectionprocess" style="padding:0">&nbsp;</td>
                        <td width="29%" style="padding:0"><div align="right"><a onclick="refreshcustomerarray();" style="cursor:pointer; padding-right:10px;"><img src="../images/imax-customer-refresh.jpg" alt="Refresh customer" border="0" title="Refresh customer Data" /></a></div></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left"><input name="detailsearchtext" type="text" class="swifttext" id="detailsearchtext" size="32" onkeyup="customersearch(event);"  autocomplete="off"/>
                          <span style="display:none1">
                          <input name="searchtextid" type="hidden" id="searchtextid"  disabled="disabled"/>
                          </span>
                          <div id="detailloadcustomerlist">
                            <select name="customerlist" size="5" class="swiftselect" id="customerlist" style="width:210px; height:400px" onclick ="selectfromlist();" onchange="selectfromlist();"  >
                            </select>
                          </div></td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
 <tr>
                <td width="45%" style="padding-left:10px;"><strong>Total Count:</strong> </td>
                <td width="55%" id="totalcount">&nbsp;</td>
              </tr>
</table></td>
              </tr>
              
              <tr>
                <td colspan="2" >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
    </table></td>
    <td width="77%" valign="top" style="border-bottom:#1f4f66 1px solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="mainwrap">
        <tr>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr>
                            <td class="sideheading">Masters > Customer Details</td>
                            <td width="15%"> <div align="right">ID Search:</div></td><td width="36%">
                              
                              <div align="left">
                                <input name="searchcustomerid" type="text" class="swifttext" id="searchcustomerid" onkeyup="searchbycustomeridevent(event);" size="30" maxlength="40"  autocomplete="off"/>
                            <img src="../images/search.gif" width="16" height="15" align="absmiddle"  onclick="searchbycustomerid(document.getElementById('searchcustomerid').value);" style="cursor:pointer" /> </div></td>
                            <td width="22%" > &nbsp;<input name="search" type="submit" class="swiftchoicebuttonbig" id="search" value="Advances Search"  onclick="displayDiv('1','filterdiv');" /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                      <td><div id="filterdiv" style="display:none;">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc;">
                            <tr>
                              <td valign="top"><div>
                                  <form action="" method="post" name="searchfilterform" id="searchfilterform" onsubmit="return false;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                    <tr>
                            <td width="100%" align="left" class="header-line" style="padding:0">&nbsp;&nbsp;Filter Data</td>
                          </tr>
                                      <tr>
                                        <td valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFD3A8" style="border:dashed 1px #545429">
<tr>
  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4" style=" border-right:1px solid #CCCCCC">
    <tr>
      <td width="18%" align="left" valign="middle">Text: </td>
      <td width="82%" colspan="3" align="left" valign="top"><input name="searchcriteria" type="text" id="searchcriteria" size="30" maxlength="50" class="swifttext"  autocomplete="off" value=""/></td>
    </tr>
    <tr valign="top" style="padding:1px"><td height="2"></td>
      <td style="font-size:9px; color:#999999; padding:1px" height="2">(Leave Empty for all)</td>
    </tr>
    <tr>
      <td colspan="2" style="padding:3px"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 1px #004000">
          <tr>
            <td colspan="2"><strong>Look in:</strong></td>
          </tr>
          <tr>
            <td width="47%"><label>
              <input type="radio" name="databasefield" id="databasefield0" value="slno"/>
              Customer ID</label></td>
            <td width="53%"><label>
              <input type="radio" name="databasefield" id="databasefield5" value="place" />
              Place</label></td>
          </tr>
          <tr>
            <td><label>
              <input type="radio" name="databasefield" id="databasefield1" value="businessname" checked="checked"/>
              Business Name</label></td>
            <td><label>
              <input type="radio" name="databasefield" value="phone" id="databasefield4" />
              Phone</label>
              / Cell</td>
          </tr>
          <tr>
            <td><label>
              <input type="radio" name="databasefield" value="contactperson" id="databasefield3" />
              Contact Person</label></td>
            <td><label>
              <input type="radio" name="databasefield" value="emailid" id="databasefield6" />
              Email</label></td>
          </tr>
          <tr>
            <td colspan="2" height="5"></td>
          </tr>
          <tr >
            <td colspan="2" style="border-top:solid 1px #999999"  height="5"  ></td>
          </tr>
          <tr>
            <td width="47%"><label>
              <input type="radio" name="databasefield" value="cardid" id="databasefield9" />
              Card ID</label>            </td>
            <td width="53%"><label>
              <input type="radio" name="databasefield" value="computerid" id="databasefield8" />
              Computer ID</label></td>
          </tr>
          <tr>
            <td><label>
              <input type="radio" name="databasefield" value="scratchnumber" id="databasefield7" />
              Pin No</label>            </td>
            <td><label>
              <input type="radio" name="databasefield" value="softkey" id="databasefield10" />
              Softkey</label></td>
          </tr>
          <tr>
            <td><label>
              <input type="radio" name="databasefield" value="billno" id="databasefield11" />
              Bill No</label></td>
            <td></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td  colspan="2" height="5"></td>
    </tr>
    <tr>
      <td align="left" valign="top" height="10">Region:</td>
      <td align="left" valign="top" height="10"> <select name="region2" class="swiftselect" id="region2">
          <option value="">ALL</option>
          <?php 
											include('../inc/region.php');
											?>
        </select>      </td>
    </tr>
    <tr>
      <td align="left" valign="top" height="10" >State:</td>
      <td align="left" valign="top" height="10"><select name="state2" class="swiftselect" id="state2" onchange="getdistrict('districtcodedisplaysearch',this.value);" onkeyup="getdistrict('districtcodedisplaysearch',this.value);">
          <option value="">ALL</option>
          <?php include('../inc/state.php'); ?>
      </select></td>
    </tr>
    <tr>
      <td height="10"> District :</td>
      <td align="left" valign="top"  id="districtcodedisplaysearch" height="10"><select name="district2" class="swiftselect" id="district2" style="width:200px;">
          <option value="">ALL</option>
      </select></td>
    </tr>

  </table></td>
  <td width="50%" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="4">
                                                 <tr>
                                                   <td colspan="3" valign="top" style="padding:0"></td>
                                                 </tr>
                                                 <tr>
                                                   <td colspan="3" valign="top"><strong>Products: </strong></td>
                                                 </tr>
                                                 <tr>
                                                   <td colspan="3" valign="top" bgcolor="#FFFFFF" style="border:solid 1px #A8A8A8"><div style="height:220px; overflow:scroll">
                                                     <?php include('../inc/productdetails.php'); ?>
                                                   </div></td>
                                                 </tr>
                                                 <tr>
                                                   <td width="8%"><input type="checkbox" checked="checked" name="selectall" id="selectall" value="selectall" onclick="selectdeselectall();"/></td>
                                                   <td><strong>
                                                     <label for="selectall">Select All</label>
                                                   </strong></td>
                                                 </tr>
                                                 <tr >
                                                   <td colspan="2" height="5" >&nbsp;</td>
                                                  </tr>
                                                 <tr >
                                                   <td >&nbsp;</td>
                                                   <td height="20" ><input name="filter" type="button" class="swiftchoicebutton-red" id="filter" value="Filter" onclick="refreshcustomerarray();" />&nbsp;&nbsp;
<input type="button" name="reset_form" value="Reset" class="swiftchoicebutton" onclick="resetDefaultValues(this.form);">
&nbsp;&nbsp;
<input name="close" type="button" class="swiftchoicebutton" id="close" value="Close" onclick="document.getElementById('filterdiv').style.display='none';" /></td>
                                                  </tr>
                                                 
                                             </table></td></tr>   
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td colspan="2" height="35" align="left" valign="middle"><div id="filter-form-error"></div></td>
                                              
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                  </form>
                                </div></td>
                            </tr>
                          </table>
                        </div></td>
                    </tr>
                    <tr>
                      <td height="5">&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; border-top:none;">
                          <tr>
                            <td align="left" class="header-line" style="padding:0">&nbsp;&nbsp;Enter / Edit / View Details</td>
                            <td align="right" class="header-line" style="padding-right:7px"></td>
                          </tr>
                          <tr>
                            <td colspan="2" valign="top"><div id="maindiv">
                                <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                    <tr>
                                      <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                          <tr>
                                            <td align="left" bgcolor="#F7FAFF">Business Name [Company]:</td>
                                            <td align="left" bgcolor="#F7FAFF"><input name="businessname" type="text" class="swifttext-mandatory" id="businessname" size="70" maxlength="100"  autocomplete="off" />
                                              <input type="hidden" name="lastslno" id="lastslno" />                                             </td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr>
                                      <td width="50%" valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top">Contact Person:</td>
                                            <td align="left" valign="top" bgcolor="#f7faff"><input name="contactperson" type="text" class="swifttext-mandatory" id="contactperson" size="30" autocomplete="off" /></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">Address:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><textarea name="address" cols="27" class="swifttextarea" id="address"></textarea>
                                              <br /></td>
                                          </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Place:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><input name="place" type="text" class="swifttext-mandatory" id="place" size="30" autocomplete="off" /></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">State:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><select name="state" class="swiftselect-mandatory" id="state" onchange="getdistrict('districtcodedisplay',this.value);" onkeyup="getdistrict('districtcodedisplay',this.value);">
                                                <option value="">Select A State</option>
                                                <?php include('../inc/state.php'); ?>
                                              </select></td>
                                          </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">District:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF" id="districtcodedisplay"><select name="district" class="swiftselect-mandatory" id="district" style="width:230px;">
                                                <option value="">Select A State First</option>
                                              </select></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">Pin Code:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><input name="pincode" type="text" class="swifttext-mandatory" id="pincode" size="30" maxlength="10"  autocomplete="off"/></td>
                                          </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Region:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><select name="region" class="swiftselect-mandatory" id="region">
                                                <option value="">Select A Region</option>
                                                <?php 
											include('../inc/region.php');
											?>
                                              </select></td>
                                          </tr>

                                          <tr bgcolor="#edf4ff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Current Dealer:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><select name="currentdealer" class="swiftselect-mandatory" id="currentdealer" style="width:180px;">
                                                <option value="">Make A Selection</option>
                                                <?php 
											include('../inc/firstdealer.php');
											?>
                                              </select></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Disable Login:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><label>
                                              <input type="checkbox" name="disablelogin" id="disablelogin" />
                                              </label></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Corporate Order:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><label>
                                              <input type="checkbox" name="corporateorder" id="corporateorder" />
                                              </label></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Active Customer:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF" id="activecustomer">&nbsp;</td>
                                          </tr>
                                      </table></td>
                                      <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top">STD Code:</td>
                                            <td align="left" valign="top"><input name="stdcode" type="text" class="swifttext" id="stdcode" size="30" maxlength="10"  autocomplete="off"/></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">Phone:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><input name="phone" type="text" class="swifttext-mandatory" id="phone" size="30" maxlength="80" autocomplete="off" /></td>
                                          </tr>
                                           <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">Fax:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><input name="fax" type="text" class="swifttext" id="fax" size="30" maxlength="10"  autocomplete="off"/></td>
                                           </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Cell:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><input name="cell" type="text" class="swifttext-mandatory" id="cell" size="30" maxlength="80" autocomplete="off" />
                                              <br /></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">Email:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><input name="emailid" type="text" class="swifttext-mandatory" id="emailid" size="30" maxlength="300" autocomplete="off" /></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Website:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><input name="website" type="text" class="swifttext" id="website" size="30" maxlength="80" autocomplete="off" />
                                              <br /></td>
                                          </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">Type:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><select name="type" class="swiftselect" id="type">
                                                <option value="" selected="selected">Type Selection</option>
                                                  <?php 
											include('../inc/custype.php');
											?>
                                              </select></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Category:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><select name="category" class="swiftselect" id="category">
                                                <option value="">Category Selection</option>
                                                <?php 
											include('../inc/category.php');
											?>
                                              </select></td>
                                          </tr>
                                          <tr bgcolor="#f7faff">
                                            <td align="left" valign="top" bgcolor="#F7FAFF">Remarks:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF"><textarea name="remarks" cols="27" class="swifttextarea" id="remarks"></textarea></td>
                                          </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td align="left" valign="top" bgcolor="#EDF4FF">Customer ID:</td>
                                            <td align="left" valign="top" bgcolor="#EDF4FF"><input name="customerid" type="text" class="swifttext" id="customerid" style="background:#FEFFE6;" size="30" maxlength="40" readonly="readonly"  autocomplete="off"/>                                            </td>
                                          </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td colspan="2" height="25px"><div id="displaypassworddfield" style="display:none"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="26%" height="19" align="left" valign="top" bgcolor="#F7FAFF">Password:</td>
                                            <td width="74%" align="left" valign="top" bgcolor="#F7FAFF" id="passwordfield"><input name="password" type="password" class="swifttext" id="password" size="30" readonly="readonly" style="background:#FEFFE6;" /></td>
  </tr>
</table></div></td>
                                          </tr>
                                          <tr bgcolor="#edf4ff">
                                            <td height="19" align="left" valign="top" bgcolor="#F7FAFF">Created Date:</td>
                                            <td align="left" valign="top" bgcolor="#F7FAFF" id="createddate">Not Available</td>
                                          </tr>
                                          <!--<tr bgcolor="#edf4ff">
                                            <td height="19" valign="top" bgcolor="#F7FAFF">&nbsp;</td>
                                            <td valign="top" bgcolor="#F7FAFF" id="passwordfield2">&nbsp;</td>
                                          </tr>-->
                                        </table></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="70px"><table width="98%" border="0" cellspacing="0" cellpadding="0" height="70">
                                          <tr>
                                            <td height="25" colspan="2" align="left" valign="middle"><div id="form-error"></div></td>
                                          </tr>
                                          <tr>
                                            <td width="43%" height="40" align="left" valign="middle" class="resendtext"><?php if($userid == 1){ ?><div id="resendmail" style="display:none"><a   onclick="resendwelcomeemail();">Resend welcome Email</a></div><?php } ?></td>
                                            <td width="57%" height="35" align="right" valign="middle"><?php if($permissionarray[15] == 'no'){ ?><input name="new" type="button" class= "swiftchoicebuttondisabled" id="new" value="New" onclick="newentry(); document.getElementById('form-error').innerHTML = '';" /><?php } else {?>
                                            <input name="new" type="button" class= "swiftchoicebutton" id="new" value="New" onclick="newentry(); document.getElementById('form-error').innerHTML = '';cleargrid();" /><?php }?>  &nbsp;
                                              &nbsp;<?php if($permissionarray[15] == 'no'){ ?>
                                              <input name="save" type="button" class="swiftchoicebuttondisabled" id="save" value="Save" onclick="formsubmit('save');" /><?php } else {?> <input name="save" type="button" class="swiftchoicebutton" id="save" value="Save" onclick="formsubmit('save');" />
                                            <?php }?>  &nbsp;
                                              <input name="delete" type="submit" class="swiftchoicebuttondisabled" id="delete" value="Delete" disabled="disabled" onclick="formsubmit('delete');"/>
                                              &nbsp;
                                             </td>
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
                      <td></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="140" height="15" align="center" id="tabgroupgridh1" onclick="gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations'); displayelement('tabgroupgridc1','transferscratchcarddiv');clearcarddetails();" style="cursor:pointer" class="grid-active-tabbigclass">Registration</td>
                                <td width="2"></td>
                                <td width="140" height="15" align="center" id="tabgroupgridh2" onclick="gridtabcus4('2','tabgroupgrid','&nbsp; &nbsp;Card Details'); displayelement('tabgroupgridc2','transferscratchcarddiv');" style="cursor:pointer" class="grid-tabbigclass">Attached Cards</td>
                                <td width="2"></td>
                                <td><br/>
                                  &nbsp;</td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; border-top:none;">
                              <tr>
                                <td width="37%" align="left" class="header-line" style="padding:0"><div id="tabdescription">&nbsp; &nbsp;Current Registrations</div></td>
                                <td width="51%" align="left" class="header-line" style="padding:0"><span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span><span id="tabgroupgridwb3"></span></td>
                                <td width="4%" align="left" class="header-line" style="padding:0">&nbsp;</td>
                                <td width="8%" align="left" class="header-line" style="padding:0">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="4" align="center" valign="top"><div id="tabgroupgridc1" style="overflow:auto; height:150px; width:820px; padding:2px;" align="center">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td><div id="tabgroupgridc1_1" align="center"></div></td>
                                      </tr>
                                      <tr>
                                        <td><div id="tabgroupgridc1link" style="height:20px; padding:2px;"> </div></td>
                                      </tr>
                                    </table>
                                  <div id="regresultgrid" style="overflow:auto; display:none; height:150px; width:820px; padding:2px;" align="center">&nbsp;</div>
                                </div>
                                    <div id="tabgroupgridc2" style="overflow:auto; height:150px; width:820px; padding:2px; display:none;" align="center">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><div id="tabgroupgridc2_1"></div></td>
                                        </tr>
                                        <tr>
                                          <td><div id="tabgroupgridc2linksearch" style="height:20px; padding:2px;"> </div></td>
                                        </tr>
                                      </table>
                                    </div>
                                 
                                  </td>
                              </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<script>
refreshcustomerarray();

</script>