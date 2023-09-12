<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand());?>">
<link media="screen" rel="stylesheet" href="../style/colorbox.css?dummy=<?php echo (rand());?>"  />
<script language="javascript" src="../functions/colorbox.js?dummy=<?php echo (rand());?>" ></script>
<script language="javascript" src="../functions/customer.js?dummy = <?php echo (rand());?>" type="text/javascript"></script>
<script language="javascript" src="../functions/getdistrictjs.php?dummy = <?php echo (rand());?>"></script>
<script language="javascript" src="../functions/getdistrictfunction.php?dummy = <?php echo (rand());?>"></script>
<!--<script language="javascript" src="../functions/javascripts.php?dummy = <?php echo (rand());?>"></script>-->
<!--<script language="javascript" src="../functions/javascripts.js?dummy=<?php echo (rand());?>"></script>-->
<?php //$userid = $_COOKIE['userid'];
$userid = imaxgetcookie('ssmuserid');?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td valign="top" ><table width="85%"  border="0" cellspacing="0" cellpadding="5" >
        <tr>
          <td valign="top"><table width="92%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" align="left"class="header-line" style="padding-left:10px" >Customer Selection</td>
              </tr>
              <tr>
                <td colspan="2"><form id="filterform" name="filterform" method="post" action="" onsubmit="return false;">
                    <table width="90%" border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td width="73%" height="34" id="customerselectionprocess" style="padding:0" align="left">&nbsp;</td>
                        <td width="27%" ><div align="right"><a onclick="refreshcustomerarray();" style="cursor:pointer; padding-right:15px;"><img src="../images/imax-customer-refresh.jpg" alt="Refresh customer" border="0" title="Refresh customer Data" /></a></div></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" ><input name="detailsearchtext" type="text" class="swifttext" id="detailsearchtext" size="27" onkeyup="customersearch(event);"  autocomplete="off"/>
                          <span style="display:none">
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
                <td width="45%" style="padding-left:10px;"><strong>Total Count:</strong></td>
                <td width="55%" id="totalcount">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
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
                      <td><form id="searchform" name="searchform" onsubmit="return false;">
                          <table width="100%" border="0" align="right" cellpadding="3" cellspacing="0">
                            <tr>
                              <td width="24%" class="sideheading">Masters > Customer Details</td>
                              <td width="39%" align="top"><div align="right"><font color="#FF6B24">Customer ID?</font></div></td>
                              <td width="21%" valign="top"><div align="left" style="padding:2px">
                                  <input name="searchcustomerid" type="text" class="swifttext" id="searchcustomerid" onkeypress="searchbycustomeridevent(event);" size="20" maxlength="20"  autocomplete="off"/>
                                  <img src="../images/search.gif" width="16" height="15" align="absmiddle"  onclick="searchbycustomerid(document.getElementById('searchcustomerid').value);" style="cursor:pointer" /> </div></td>
                              <td width="15%" align="left" ><input name="search" type="button" class="swiftchoicebuttonbig" id="search" value="Advanced Search"  onclick="displayDiv('1','filterdiv')"  /></td>
                            </tr>
                          </table>
                        </form></td>
                    </tr>
                    <tr>
                      <td style="padding-top:3px"><div id="filterdiv" style="display:none;">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc;">
                            <tr>
                              <td valign="top"><div>
                                  <form action="" method="post" name="searchfilterform" id="searchfilterform" onsubmit="return false;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                      <tr>
                                        <td width="100%" align="left" class="header-line" style="padding:0">&nbsp;&nbsp;Search Option</td>
                                      </tr>
                                      <tr>
                                        <td valign="top" ><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFD3A8" style="border:dashed 1px #545429">
<tr>
  <td width="57%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4" style=" border-right:1px solid #CCCCCC">
    <tr>
      <td colspan="3" align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="9%" align="left" valign="middle">Text: </td>
    <td width="91%" colspan="3" align="left" valign="top"><input name="searchcriteria" type="text" id="searchcriteria" size="35" maxlength="35" class="swifttext"  autocomplete="off" value=""/>
        <span style="font-size:9px; color:#999999; padding:1px">(Leave Empty for all)</span></td>
    <td>&nbsp;</td>
  </tr>
</table>
</td>
      </tr>
    <tr valign="top" >
      <td style="padding:1px" height="2">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding:3px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33%" valign="top"><table width="93%" border="0" cellspacing="0" cellpadding="3" style="border:solid 1px #004000">
      <tr>
        <td><strong>Look in:</strong></td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" id="databasefield0" value="slno"/></label>
          <label for="databasefield0">Customer ID</label>        </td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" id="databasefield1" value="businessname" checked="checked"/></label>
          <label for="databasefield1">Business Name</label>        </td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" value="contactperson" id="databasefield3" /></label>
         <label for="databasefield3" >Contact Person</label>        </td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" id="databasefield5" value="place" /></label>
          <label for="databasefield5">Place</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" value="phone" id="databasefield4" /></label>
          <label for="databasefield4">Phone / Cell</label>
         </td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" value="emailid" id="databasefield6" /></label>
          <label for="databasefield6">Email</label></td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
      <tr >
        <td style="border-top:solid 1px #999999"  height="5"  ></td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" value="cardid" id="databasefield9" /></label>
          <label for="databasefield9">Card ID</label>        </td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" value="scratchnumber" id="databasefield7" /></label>
         <label for="databasefield7" >Pin No</label>        </td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="databasefield" value="billno" id="databasefield11" /></label>
          <label for="databasefield11">Bill No</label></td>
      </tr>
      <tr>
        <td colspan="2"><label>
          <input type="radio" name="databasefield" value="computerid" id="databasefield8" /></label>
          <label for="databasefield8">Computer ID</label></td>
      </tr>
      <tr>
        <td colspan="2"><label>
          <input type="radio" name="databasefield" value="softkey" id="databasefield10" /></label>
          <label for="databasefield10">Softkey</label></td>
      </tr>
    </table></td>
    <td width="67%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="6" style="border-left:solid 1px #cccccc; border-bottom:solid 1px #cccccc; border-top:solid 1px #cccccc ">
    <tr>
      <td colspan="2"><strong>Selections</strong>:</td>
    </tr>
      <tr>
        <td width="21%" height="10" align="left" valign="top">Region:</td>
        <td width="79%" height="10" align="left" valign="top"><select name="region2" class="swiftselect" id="region2" style="width:180px;">
            <option value="">ALL</option>
            <?php 
											include('../inc/region.php');
											?>
                                                                  </select></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="left" valign="top" height="10" >State:</td>
                                                                <td align="left" valign="top" height="10"><select name="state2" class="swiftselect" id="state2" onchange="getdistrictfilter('districtcodedisplaysearch',this.value);" onkeyup="getdistrictfilter('districtcodedisplaysearch',this.value);" style="width:180px;">
                                                                    <option value="">ALL</option>
                                                                    <?php include('../inc/state.php'); ?>
                                                                  </select></td>
                                                              </tr>
                                                              <tr>
                                                                <td height="10"> District:</td>
                                                                <td align="left" valign="top"  id="districtcodedisplaysearch" height="10"><select name="district2" class="swiftselect" id="district2" style="width:180px;">
                                                                    <option value="">ALL</option>
                                                                  </select></td>
                                                              </tr>
                                                              <tr>
                                                                <td height="10"> Dealer:</td>
                                                                <td align="left" valign="top"   height="10"><select name="currentdealer2" class="swiftselect" id="currentdealer2" style="width:180px;">
                                                                    <option value="">ALL</option>
                                                                    <?php include('../inc/firstdealer.php');?>
                                                                  </select></td>
                                                              </tr>
                                                              <tr>
                                                                <td height="10"> Branch:</td>
                                                                <td align="left" valign="top"   height="10"><select name="branch2" class="swiftselect" id="branch2" style="width:180px;">
                                                                    <option value="">ALL</option>
                                                                    <?php include('../inc/branch.php');?>
                                                                  </select></td>
                                                              </tr>
                                                              <tr>
                                                                <td height="10"> Type:</td>
                                                                <td align="left" valign="top"   height="10"><select name="type2" class="swiftselect" id="type2" style="width:180px;">
                                                                    <option value="">ALL</option>
                                                                    <option value="Not Selected">Not Selected</option>
                                                                    <?php include('../inc/custype.php');?>
                                                                  </select></td>
                                                              </tr>
                                                              <tr>
                                                                <td height="10"> Category:</td>
                                                                <td align="left" valign="top"   height="10"><select name="category2" class="swiftselect" id="category2" style="width:180px;">
                                                                    <option value="">ALL</option>
                                                                    <option value="Not Selected">Not Selected</option>
                                                                    <?php include('../inc/businesscategory.php');?>
                                                                  </select></td>
                                                              </tr>
                                                            </table></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td height="35" align="left" valign="middle" ><div id="filter-form-error"></div></td>
                                                  </tr>
                                                </table></td>
                                              <td width="43%" valign="top" style="padding-left:3px"><table width="99%" border="0" cellspacing="0" cellpadding="4">
                                                  <tr>
                                                    <td colspan="3" valign="top" style="padding:0"></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="3" valign="top"><strong>Products: </strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="3" valign="top" bgcolor="#FFFFFF" style="border:solid 1px #A8A8A8"><div style="height:230px; overflow:scroll" align="left">
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
                                                    <td colspan="2" height="34" >&nbsp;</td>
                                                  </tr>
                                                  <tr >
                                                    <td colspan="2" height="27" >&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td height="20" colspan="2" ><input name="filter" type="button" class="swiftchoicebutton-red" id="filter" value="Search" onclick="searchcustomerarray();" />
                                                      &nbsp;
                                                      <input type="button" name="reset_form" value="Reset" class="swiftchoicebutton" onclick="resetDefaultValues(this.form);">
                                                      &nbsp;
                                                      <input name="close" type="button" class="swiftchoicebutton" id="close" value="Close" onclick="document.getElementById('filterdiv').style.display='none';" /></td>
                                                  </tr>
                                                </table></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"></td>
                                      </tr>
                                    </table>
                                  </form>
                                </div></td>
                            </tr>
                          </table>
                        </div></td>
                    </tr>
                    <tr>
                      <td height="5"></td>
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
                                  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                      <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                              <tr>
                                                <td width="2%" height="25" class="producttabheadnone"></td>
                                                <td width="18%" onclick="tabopen5('1','tabg1')" class="producttabheadactive" id="tabg1h1" style="cursor:pointer;"><div align="center"><strong>General Details</strong></div></td>
                                                <td width="2%" class="producttabheadnone"></td>
                                                <td width="18%" onclick="tabopen5('2','tabg1')" class="producttabhead" id="tabg1h2" style="cursor:pointer;"><div align="center"><strong>Contact Details</strong></div></td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%" class="producttabhead" ></td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%"  class="producttabhead" >&nbsp;</td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%"  class="producttabhead">&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td><div style="display:block;"  align="justify" id="tabg1c1" >
                                              <table width="100%" border="0" cellspacing="0" cellpadding="2" class="productcontent" height="350px">
                                                <tr>
                                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                      <tr>
                                                        <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                            <tr>
                                                              <td align="left" bgcolor="#F7FAFF">Business Name [Company]:</td>
                                                              <td align="left" bgcolor="#F7FAFF"><input name="businessname" type="text" class="swifttext-mandatory" id="businessname" size="76" maxlength="100"  autocomplete="off" />
                                                                  <input type="hidden" name="lastslno" id="lastslno" />
                                                              </td>
                                                            </tr>
                                                        </table></td>
                                                      </tr>
                                                     <tr>
                                                                <td  colspan="2" valign="top" style="padding:0px" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                      <td width="20%" align="left" bgcolor="#edf4ff" style="padding:4px">Address:</td>
                                                                      <td width="80%" align="left" bgcolor="#edf4ff" style="padding-bottom:3px; padding-right:3px; padding-top:3px; padding-left:1px"><input name="address" type="text" class="swifttext" id="address" size="88" maxlength="200"  autocomplete="off" /></td>
                                                                  </tr>
                                                                  </table></td>
                                                              </tr>
                                                      <tr>
                                                        <td width="51%" valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                            <tr>
                                                              <td bgcolor="#F7FAFF">Place:</td>
                                                              <td bgcolor="#F7FAFF"><input name="place" type="text" class="swifttext-mandatory" id="place" size="30" maxlength="100"  autocomplete="off"/></td>
                                                            </tr>
                                                            <tr>
                                                              <td width="38%" bgcolor="#edf4ff">State:</td>
                                                              <td width="62%" bgcolor="#edf4ff"><select name="state" class="swiftselect-mandatory" id="state" onchange="getdistrict('districtcodedisplay',this.value);" onkeyup="getdistrict('districtcodedisplay',this.value);"  style="width:200px;">
                                                                  <option value="">Select A State</option>
                                                                  <?php include('../inc/state.php'); ?>
                                                              </select></td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#F7FAFF">District:</td>
                                                              <td bgcolor="#F7FAFF" id="districtcodedisplay"><select name="district" class="swiftselect-mandatory" id="district" style="width:200px;">
                                                                  <option value="">Select A State First</option>
                                                              </select></td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#edf4ff">Pin Code:</td>
                                                              <td bgcolor="#edf4ff"><input name="pincode" type="text" class="swifttext-mandatory" id="pincode" size="30" maxlength="10"  autocomplete="off"/></td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#F7FAFF">STD Code:</td>
                                                              <td bgcolor="#F7FAFF"><input name="stdcode" type="text" class="swifttext" id="stdcode" size="30" maxlength="10"  autocomplete="off"/></td>
                                                            </tr>
                                                            <tr>
                                                              <td  bgcolor="#edf4ff">Fax:</td>
                                                              <td  bgcolor="#edf4ff"><input name="fax" type="text" class="swifttext" id="fax" size="30" maxlength="80"  autocomplete="off"/></td>
                                                            </tr>

                                                            <tr bgcolor="#f7faff">
                                                              <td align="left" valign="top" bgcolor="#f7faff">Disable Login:</td>
                                                              <td align="left" valign="top" bgcolor="#f7faff" id="disablelogin"></td>
                                                            </tr>
                                                            <tr bgcolor="#edf4ff">
                                                              <td height="19" align="left" valign="top" bgcolor="#edf4ff">Created Date:</td>
                                                              <td align="left" valign="top" bgcolor="#edf4ff" id="createddate">Not Available</td>
                                                            </tr>
                                                              <tr bgcolor="#edf4ff">
                                                                <td align="left" valign="top" bgcolor="#F7FAFF">Satisfactory Call Status :</td>
                                                                <td align="left" valign="top" bgcolor="#F7FAFF " id="satisfactorycall">Not Available </td>
                                                              </tr>
                                                              <tr>
                                                                <td bgcolor="#edf4ff">Website</td>
                                                                <td bgcolor="#edf4ff"><input name="website" type="text" class="swifttext" id="website" size="30" maxlength="80" autocomplete="off" /></td>
                                                              </tr>
                                                              <tr>
                                                                <td  bgcolor="#F7FAFF">Type:</td>
                                                                <td  bgcolor="#F7FAFF"><select name="type" class="swiftselect" id="type" style="width:200px">
                                                                    <option value="" selected="selected">Type Selection</option>
                                                                    <?php 
											include('../inc/custype.php');
											?>
                                                                  </select></td>
                                                              </tr>
                                                              <tr>
                                                                <td bgcolor="#edf4ff">Category:</td>
                                                                <td bgcolor="#edf4ff"><select name="category" class="swiftselect" id="category"  style="width:200px">
                                                                    <option value="">Category Selection</option>
                                                                    <?php 
											include('../inc/businesscategory.php');
											?>
                                                                  </select></td>
                                                              </tr>
                                                              <tr bgcolor="#edf4ff">
                                                                <td align="left" valign="top" bgcolor="#F7FAFF">Region:</td>
                                                                <td align="left" valign="top" bgcolor="#F7FAFF"><input name="region" type="text" class="swifttext-mandatory" id="region" size="30" maxlength="80" autocomplete="off"  readonly="readonly" style="background:#FEFFE6" /></td>
                                                              </tr>
                                                              <tr bgcolor="#edf4ff">
                                                                <td align="left" valign="top" bgcolor="#edf4ff">Branch:</td>
                                                                <td align="left" valign="top" bgcolor="#edf4ff"><input name="branch" type="text" class="swifttext-mandatory" id="branch" size="30" maxlength="80" autocomplete="off"  readonly="readonly" style="background:#FEFFE6" /></td>
                                                              </tr>
                                                            </table></td>
                                                          <td width="49%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                              <tr>
                                                                <td bgcolor="#edf4ff">Remarks:</td>
                                                                <td bgcolor="#edf4ff"><textarea name="remarks" cols="27" class="swifttextarea" id="remarks"></textarea></td>
                                                              </tr>
                                                              <tr bgcolor="#f7faff">
                                                                <td align="left" valign="top" bgcolor="#F7FAFF">Corporate Order:</td>
                                                                <td align="left" valign="top" bgcolor="#F7FAFF" id="corporateorder"></td>
                                                              </tr>
                                                              <tr>
                                                                <td bgcolor="#F7FAFF">Customer ID:</td>
                                                                <td bgcolor="#F7FAFF"><input name="customerid" type="text" class="swifttext" id="customerid" style="background:#FEFFE6;" size="30" maxlength="40" readonly="readonly"  autocomplete="off"/></td>
                                                              </tr>
                                                              <tr bgcolor="#edf4ff">
                                                                <td align="left" valign="top" bgcolor="#edf4ff">Last Password:</td>
                                                                <td align="left" valign="top" bgcolor="#EDF4FF"><span id="initialpassworddfield" style="display:block">
                                                                  <input name="lastpassword" type="text" class="swifttext" id="lastpassword" size="30" readonly="readonly" style="background:#FEFFE6; color:#000000" autocomplete="off" />
                                                                  </span> <span id="displayresetpwd" style="display:none">
                                                                  <input name="initialpassword" type="text" class="swifttext" id="initialpassword" size="30" readonly="readonly" style="background:#FEFFE6; color:#FF0000;" autocomplete="off"/>
                                                                  </span></td>
                                                              </tr>
                                                              <tr bgcolor="#F7FAFF">
                                                                <td align="left" valign="top" bgcolor="#F7FAFF">Current Dealer:</td>
                                                                <td align="left" valign="top" bgcolor="#F7FAFF"><input name="currentdealer" type="text" class="swifttext" id="currentdealer" style="background:#FEFFE6;" size="30" maxlength="40" readonly="readonly"  autocomplete="off"/></td>
                                                              </tr>
                                                              <tr bgcolor="#F7FAFF">
                                                                <td align="left" valign="top" bgcolor="#F7FAFF">GSTIN:</td>
                                                                <td align="left" valign="top" bgcolor="#F7FAFF">
                                                                    <input name="gst_no" type="text" id="gst_no" class="swiftselect type_enter focus_redclass" size="27" onkeyup="changeToUpperCase(this)"/>
                                                                    <span id="state_gst" style="visibility:hidden"></span>
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                      <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                                                          <tr>
                                                                            <td height="19" align="left" valign="top" bgcolor="#edf4ff">Active Customer:</td>
                                                                            <td align="left" valign="top" bgcolor="#edf4ff" id="activecustomer">&nbsp;</td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td bgcolor="#f7faff">Company Closed:</td>
                                                                            <td bgcolor="#f7faff"><input type="checkbox" name="companyclosed" id="companyclosed" /></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td bgcolor="#edf4ff">Promotional SMS:</td>
                                                                            <td bgcolor="#edf4ff"><input type="checkbox" name="promotionalsms" id="promotionalsms" /></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td bgcolor="#f7faff">Promotional Email:</td>
                                                                            <td bgcolor="#f7faff"><input type="checkbox" name="promotionalemail" id="promotionalemail" /></td>
                                                                          </tr>
                                                                        </table></td>
                                                                      <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                          <tr>
                                                                            <td height="15px" valign="top"  bgcolor="#F7FAFF"><div align="center"><strong>2019-20 Summary</strong></div></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td><div id="salessummary">
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="4" class="table-border-grid">
                                                                                  <tr class="tr-grid-header">
                                                                                    <td width="22%" class="td-border-grid">&nbsp;</td>
                                                                                    <td width="24%" class="td-border-grid" align="center"><strong>Bill</strong></td>
                                                                                    <td width="25%" class="td-border-grid" align="center"><strong>PIN</strong></td>
                                                                                    <td width="29%" class="td-border-grid" align="center"><strong>Regn</strong></td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff"><strong>TDS</strong></td>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff">&nbsp;</td>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff">&nbsp;</td>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff">&nbsp;</td>
                                                                                  </tr>
                                                                                  <!--<tr>
                                                                                    <td class="td-border-grid"  bgcolor="#F7FAFF"><strong>SVI</strong></td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff"><strong>SVH</strong></td>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff">&nbsp;</td>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff">&nbsp;</td>
                                                                                    <td class="td-border-grid"  bgcolor="#edf4ff">&nbsp;</td>
                                                                                  </tr>
                                                                                  -->
                                                                                  <tr>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF"><strong>STO</strong></td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF"><strong>SPP</strong></td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                    <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                     <td class="td-border-grid" bgcolor="#F7FAFF"><strong>GST</strong></td>
                                                                                     <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                     <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                     <td class="td-border-grid" bgcolor="#F7FAFF">&nbsp;</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                     <td class="td-border-grid" bgcolor="#edf4ff"><strong>SAC</strong></td>
                                                                                     <td class="td-border-grid" bgcolor="#edf4ff">&nbsp;</td>
                                                                                     <td class="td-border-grid" bgcolor="#edf4ff">&nbsp;</td>
                                                                                     <td class="td-border-grid" bgcolor="#edf4ff">&nbsp;</td>
                                                                                  </tr>
                                                                                </table>
                                                                              </div></td>
                                                                          </tr>
                                                                        </table></td>
                                                                    </tr>
                                                                  </table></td>
                                                              </tr>
                                                            </table></td>
                                                        </tr>
                                                        <span  style="display:none" id="short_url" ></span>
                                                      </table></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              <div style="display:none;" align="justify" id="tabg1c2">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="2" class="productcontent" height="350px">
                                                  <tr>
                                                    <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="0"  >
                                                        <tr>
                                                          <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                              <tr>
                                                                <td ><table width="100%" border="0" cellspacing="0" cellpadding="5" style="color:#646464; font-weight:bold">
                                                                    <tr>
                                                                      <td width="2%">&nbsp;</td>
                                                                      <td width="16%" ><div align="center">Type</div></td>
                                                                      <td width="19%"><div align="center">Name</div></td>
                                                                      <td width="21%"><div align="center">Phone</div></td>
                                                                      <td width="14%"><div align="center">Cell</div></td>
                                                                      <td width="25%"><div align="center">Email Id</div></td>
                                                                      <td width="3%">&nbsp;</td>
                                                                    </tr>
                                                                  </table></td>
                                                              </tr>
                                                              <tr>
                                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="3"  id="adddescriptionrows">
                                                                    <tr id="removedescriptionrow1">
                                                                      <td width="5%"><div align="left"><strong>1</strong></div></td>
                                                                      <td width="11%"><div align="center">
                                                                          <select name="selectiontype1" id="selectiontype1" style="width:120px" class="swiftselect-mandatory">
                                                                            <option value="" selected="selected" >--Select--</option>
                                                                            <option value="general" >General</option>
                                                                            <option value="gm/director">GM/Director</option>
                                                                            <option value="hrhead">HR Head</option>
                                                                            <option value="ithead/edp">IT-Head/EDP</option>
                                                                            <option value="softwareuser" >Software User</option>
                                                                            <option value="financehead">Finance Head</option>
                                                                            <option value="others" >Others</option>
                                                                          </select>
                                                                        </div></td>
                                                                      <td width="16%"><div align="center">
                                                                          <input name="name1" type="text" class="swifttext" id="name1"  style="width:150px"  maxlength="70"  autocomplete="off"/>
                                                                        </div></td>
                                                                      <td width="18%"><div align="center">
                                                                          <input name="phone1" type="text"class="swifttext" id="phone1" style="width:140px" maxlength="100"  autocomplete="off" />
                                                                        </div></td>
                                                                      <td width="15%"><div align="center">
                                                                          <input name="cell1" type="text" class="swifttext" id="cell1" style="width:100px"  maxlength="10"  autocomplete="off"/>
                                                                        </div></td>
                                                                      <td width="27%"><div align="center">
                                                                          <input name="emailid1" type="text" class="swifttext" id="emailid1" style="width:190px"  maxlength="200"  autocomplete="off"/>
                                                                        </div></td>
                                                                      <td width="8%"><font color = "#FF0000"><strong><a id="removerowdiv1" onclick ="removedescriptionrows('removedescriptionrow1','1')" style="cursor:pointer;">X</a></strong></font>
                                                                        <input type="hidden" name="contactslno1" id="contactslno1" /></td>
                                                                    </tr>
                                                                  </table></td>
                                                              </tr>
                                                              <tr>
                                                                <td><div align="left" id="adddescriptionrowdiv">
                                                                    <div align="right"><a onclick="adddescriptionrows();" style="cursor:pointer" class="r-text">Add one More &gt;&gt;</a></div>
                                                                  </div></td>
                                                              </tr>
                                                            </table></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                </table>
                                              </div></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr>
                                      <td align="right" valign="middle" style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="70">
                                          <tr>
                                            <td height="25" colspan="2" align="left" valign="middle"><div id="form-error"></div></td>
                                          </tr>
                                          <tr>
                                            <td width="50%" height="35" align="left" valign="middle" id="profilepending"></td>
                                            <td width="50%" height="25" align="right" valign="middle"><input name="save" type="button" class="swiftchoicebutton" id="save" value="Save" onclick="formsubmit('save');" />
                                              &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </td>
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
                      <td><form id="detailsform" name="detailsform" method="post" action="">
                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border: #FFA6A6 1px solid">
                            <tr>
                              <td valign="top"><div align="left" style="display:block;background-color: #FFDFDF; height:20px; padding-top:5px;" id="detailsdiv"  >
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="20%" ><a onclick="generatercidetails('')" class="resendtext"><strong style="padding-left:3px; cursor:pointer">View RCI  Details</strong></a></td>
                                      <td width="80%"><a onclick="generateinvoicedetails('')" class="resendtext"><strong style="padding-left:3px;cursor:pointer">View Invoice Details</strong></a></td>
                                    </tr>
                                  </table>
                                </div>
                                <div id="rcidetailsgridc1" style="width:890px; display:none" align="center">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr class="header-line">
                                      <td width="45%"><span style="padding-left:4px;">RCI Details</span></td>
                                      <td width="24%"><span id="rcidetailsgridwb1" style="text-align:center">&nbsp;</span></td>
                                      <td width="31%"><div align="right"><a onclick="closedetailsdiv();" style="padding-right:4px;" class="close-text">Close(x)</a></div></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" align="center"><div style="overflow:auto;padding:0px; height:150px; width:890px; background-color: #FEE8D8">
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td align="center"><div id="rcidetailsgridc1_1" > </div></td>
                                            </tr>
                                            <tr>
                                              <td ><div id="rcidetailsgridc1link" style="height:20px;  padding:2px;" align="centre"> </div></td>
                                            </tr>
                                          </table>
                                        </div></td>
                                    </tr>
                                  </table>
                                </div>
                                </div>
                                <div id="rcidetailsresultgrid" style="overflow:auto; display:none; height:150px; width:890px; padding:2px;" align="center">&nbsp;</div>
                                <div id="invoicedetailsgridc1" style="width:824px; display:none" align="center">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr class="header-line">
                                      <td width="45%"><span style="padding-left:4px;">Invoice Details</span></td>
                                      <td width="24%"><span id="invoicedetailsgridwb1" style="text-align:center">&nbsp;</span></td>
                                      <td width="31%"><div align="right"><a onclick="closedetailsdiv();" style="padding-right:4px;" class="close-text">Close(x)</a></div></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" align="center"><div style="overflow:auto;padding:0px; height:150px; width:890px; background-color: #FEE8D8">
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td align="center"><div id="invoicedetailsgridc1_1" > </div></td>
                                            </tr>
                                            <tr>
                                              <td ><div id="invoicedetailsgridc1link" style="height:20px;  padding:2px;" align="centre"> </div></td>
                                            </tr>
                                          </table>
                                        </div></td>
                                    </tr>
                                  </table>
                                </div>
                                </div>
                                <div id="invoicedetailsresultgrid" style="overflow:auto; display:none; height:150px; width:704px; padding:2px;" align="center">&nbsp;</div></td>
                            </tr>
                          </table>
                        </form></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="140" height="15" align="center" id="tabgroupgridh1" onclick="gridtabcus4('1','tabgroupgrid','&nbsp; &nbsp;Current Registrations');" style="cursor:pointer" class="grid-active-tabbigclass">Registration</td>
                                  <td width="2"></td>
                                  <td width="140" height="15" align="center" id="tabgroupgridh2" onclick="gridtabcus4('2','tabgroupgrid','&nbsp; &nbsp;Card Details');" style="cursor:pointer" class="grid-tabbigclass">Attached Cards</td>
                                  <td width="2"></td>
                                  <td width="2"></td>
                                  <td width="140" height="15" align="center" id="tabgroupgridh3" onclick="gridtabcus4('3','tabgroupgrid','&nbsp; &nbsp;Outgoing Calls');" style="cursor:pointer" class="grid-tabbigclass">Outgoing Calls</td>
                                  <td width="2"></td>
                                  <td>&nbsp;</td>
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
                                  <td colspan="4" align="center" valign="top"><div id="tabgroupgridc1" style="overflow:auto; height:150px; width:890px; padding:2px;" align="center">
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
                                    
                                   <div id="tabgroupgridc2" style="overflow:auto; height:150px; width:820px; padding:2px; display:none;" align="center"></div><div id="tabgroupgridc3" style="overflow:auto; height:150px; width:820px; padding:2px; display:none;" align="center"></div></td>
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
<div style="display:none">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><!--  width:709px; -->
      <td><div id="surrendergrid" style='background:#fff; font-size:11px;'>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCCCCC">
            <tr class="header-line">
              <td width="45%"><span style="padding-left:4px;">Surrender Details</span></td>
              <td width="24%"><span id="surrendergridwb1" style="text-align:center">&nbsp;</span></td>
              <td width="31%"><div align="right"></div></td>
            </tr>
            <tr>
              <td colspan="3"><div style="overflow:auto;padding:0px; height:290px; width:709px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center"><div id="surrendergridc7" > </div></td>
                    </tr>
                    <tr>
                      <td ><div id="surrendergridc1link" style="height:20px;  padding:2px;" align="centre"> </div></td>
                    </tr>
                  </table>
                </div></td>
            </tr>
          </table>
          <!--<div id="surrendergridc7" style="overflow:auto; height:150px; width:704px; padding:2px; display:none;" align="center">No datas found to be displayed.</div>-->
          
          <div id="surrenderresultgrid" style="overflow:auto; display:none; height:150px; width:704px; padding:2px;" align="center">&nbsp;</div>
          <div align="right" style="padding-top:15px; padding-right:25px">
            <input type="button" value="Close" id="closecolorboxbutton1"  onclick="$().colorbox.close();" class="swiftchoicebutton"/>
          </div>
        </div></td>
    </tr>
  </table>
</div>
<script>
refreshcustomerarray();
</script> 
