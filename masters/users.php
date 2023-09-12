<?php
if($usertype <> 'ADMIN')
{
	header("location:../index.php?a_link=home_dashboard");
}
else
{
?>
<link rel="stylesheet" type="text/css" href="../style/main.css">
<script language="javascript" src="../functions/createuser.js" type="text/javascript"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Masters > Users</td>
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
          <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="50%" valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">User ID:</td>
                      <td valign="top"><input name="username" type="text" class="swifttext" id="username" size="30"  style="background:#FEFFE6;" />
                          <input type="hidden" name="lastslno" id="lastslno" value="" />
                          <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo($user); ?>"/>
                          <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo($usertype); ?>"/>
                          <input type="hidden" name="time" id="time" value=""/>
                          <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority" value="<?php echo($reportingauthority ); ?>"/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Password:</td>
                      <td valign="top"><input name="password" type="password" class="swifttext" id="password" size="30"  style="background:#FEFFE6;"/></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Type:</td>
                      <td valign="top"><select name="type" class="swiftselect" id="type" style="background:#FEFFE6;">
                          <option selected="selected" value="">Make A Selection</option>
                          <option value="ADMIN">Administrator</option>
                          <option value="EXECUTIVE-ONSITE">Executive - Onsite</option>
                          <option value="EXECUTIVE-OTHERS">Executive - Others</option>
                          <option value="GUEST">Guest</option>
                          <option value="HR">HR</option>
                          <option value="MANAGEMENT">Management</option>
                          <option value="TEAMLEADER">Team Leader</option>
                      </select></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Location:</td>
                      <td valign="top"><select name="locationname" class="swiftselect" id="locationname" style="background:#FEFFE6;">
                          <option value="" selected="selected">Make A Selection</option>
                          <?php include('../inc/selectlocation.php'); ?>
                      </select></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Reporting Authority:</td>
                      <td valign="top"><select name="reportingauthority" class="swiftselect" id="reportingauthority">
                          <option value="" selected="selected">Make A Selection</option>
                          <?php include('../inc/reportingauthority.php'); ?>
                        </select>                      </td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Support Unit:</td>
                      <td valign="top"><select name="supportunit" class="swiftselect" id="supportunit" style="background:#FEFFE6;">
                        <option value="" selected="selected">Make A Selection</option>
                        <?php include('../inc/supportunit.php'); ?>
                      </select></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Existing  User:</td>
                      <td valign="top"><select name="existinguser" class="swiftselect" id="existinguser" style="background:#FEFFE6;">
                        <option value="" selected="selected">Make A Selection</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">User Name:</td>
                      <td valign="top"><input name="fullname" type="text" class="swifttext" id="fullname" size="30"  autocomplete="off"/></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Gender:</td>
                      <td valign="top"><select name="gender" id="gender" class="swiftselect">
                        <option value="">Make A Selection</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Mobile:</td>
                      <td valign="top"><input name="mobile" type="text" class="swifttext"  id="mobile" size="30"  autocomplete="off"/></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Designation:</td>
                      <td valign="top" bgcolor="#f7faff"><input name="designation" type="text"  class="swifttext" id="designation" size="30"  autocomplete="off"/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Date of Birth:</td>
                      <td valign="top"><input name="dob" type="text"  class="swifttext" id="DPC_dob" size="30" maxlength="10"  autocomplete="off" /></td>
                    </tr>
                </table></td>
                <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">Present Address:</td>
                      <td valign="top"><textarea name="presentaddress" cols="45" class="swifttextarea" id="presentaddress" autocomplete="off"></textarea></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Permanent Address:</td>
                      <td valign="top"><textarea name="permanentaddress" cols="45" class="swifttextarea" id="permanentaddress" autocomplete="off"></textarea></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Date of joining:</td>
                      <td valign="top"><input name="doj" type="text"  class="swifttext" id="DPC_doj" size="30" maxlength="10" autocomplete="off"  /></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Personal Email:</td>
                      <td valign="top"><input name="personalemail" type="text" class="swifttext" id="personalemail" size="30"  autocomplete="off"/></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Official Email:</td>
                      <td valign="top"><input name="officialemail" type="text" class="swifttext" id="officialemail" size="30" autocomplete="off" /></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Date of Leaving:</td>
                      <td valign="top"><input name="dol" type="text" class="swifttext" id="DPC_dol" size="30" maxlength="10" autocomplete="off"  /></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Contact Number:<br />
                        [In case of Emergency]</td>
                      <td valign="top"><input name="emergencynumber" type="text" class="swifttext"  id="emergencynumber" size="30"  autocomplete="off"/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Emergency Remarks:</td>
                      <td valign="top"><input name="emergencyremarks" type="text" class="swifttext"  id="emergencyremarks" size="30"  autocomplete="off"/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top" bgcolor="#f7faff">Disable Login</td>
                      <td valign="top" bgcolor="#f7faff"><label for="disablelogin"><input type="checkbox" name="disablelogin" id="disablelogin" /></label></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2" align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
  <tr>
                <td width="68%" height="35" align="left" valign="middle"><div id="form-error"></div></td>
                <td width="32%" height="35" align="right" valign="middle"><input name="new" type="reset" class="swiftchoicebutton" id="new" value="New" onclick="newentry();clearinnerhtml(); " />
&nbsp;&nbsp;&nbsp;
<input name="save" type="submit" class="swiftchoicebutton" id="save" value="Save" onclick="formsubmit('save');" />
&nbsp;&nbsp;&nbsp;
<input name="delete" type="submit" class="swiftchoicebuttondisabled" id="delete" value="Delete"  onclick="formsubmit('delete')" disabled="disabled"/></td>
              </tr>
</table>
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
    <td></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr style="cursor:pointer" onClick="showhide('filterdiv','toggleimg1');">
        <td class="header-line" style="padding:0">&nbsp;&nbsp;Filter the Data:</td>
        <td align="right" class="header-line" style="padding-right:7px;"><div align="right"><img src="../images/plus.jpg" border="0" id="toggleimg1" name="toggleimg1"  align="absmiddle" /></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="filterdiv" style="display:none;">
          <form action="" method="post" name="filterform" id="filterform" onsubmit="return false;">
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="50%" valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">Search Text:</td>
                      <td valign="top"><input name="searchcriteria" type="text" class="swifttext" id="searchcriteria" size="40" /></td>
                    </tr>
                </table></td>
                <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">Order By:</td>
                      <td valign="top"><select name="orderby" class="swiftselect" id="orderby">
                          <option value="username" selected="selected">User Name</option>
                          <option value="type">Type</option>
                          <option value="locationname">Location Name</option>
                          <option value="reportingauthority">Reporting Authority</option>
                          <option value="supportunit">Support Unit</option>
                          <option value="existinguser">Existing User</option>
                          <option value="gender">Gender</option>
                      </select></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="35">In:
                  <label>
                    <input type="radio" name="databasefield" id="databasefield0" value="username" checked="checked" />
                    User Name</label>
                  <label>
                    <input type="radio" name="databasefield" id="databasefield1" value="type"  />
                    Type</label>
                  <label>
                    <input type="radio" name="databasefield" value="locationname" id="databasefield2"  />
                    Location Name</label>
                  <label>
                    <input type="radio" name="databasefield" value="reportingauthority" id="databasefield3"  />
                    Reporting Authority</label>
                  <label>
                    <input type="radio" name="databasefield" value="supportunit" id="databasefield4"  />
                    Support Unit</label>
                  <label>
                    <input type="radio" name="databasefield" value="existinguser" id="databasefield5" />
                    Existing User</label>
                  <label>
                    <input type="radio" name="databasefield" value="gender" id="databasefield6"  />
                    Gender</label></td>
              </tr>
              <tr>
                <td colspan="2" align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="35"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
                <td width="85%" height="35" valign="middle"><div id="filter-form-error"></div></td>
                <td width="15%" height="35" align="right" valign="middle"><input name="view" type="submit" class="swiftchoicebutton" id="view" value="View" onclick="formfilter('view'); " />
&nbsp;&nbsp;&nbsp; <img src="../images/toexcel.png"  border="0" align="absmiddle" onclick="formfilter('toexcel');" style="cursor:pointer"/></td>
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
      <tr style="border-left:none; border-right:none;">
        <td style="padding:0; border:none;" width="26%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="84px" align="center" id="tabgroupgridh1" onclick="gridtab2('1','tabgroupgrid');" style="cursor:pointer" class="grid-active-tabclass">Default</td>
              <td width="2">&nbsp;</td>
              <td width="84px" align="center" id="tabgroupgridh2" onclick="gridtab2('2','tabgroupgrid');" style="cursor:pointer" class="grid-tabclass">Filter</td>
              <td width="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
        </table></td>
        <td><span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr>
        <td width="15%" class="header-line" style="padding:0">ViewRecords</td>
        <td width="60%" class="header-line" style="padding:0"></td>
        <td width="25%" class="header-line" style="padding:0"></td>
      </tr>
      <tr>
      	
        <td align="left" valign="top">
        	<table>
            	<tr>
               	     <td  class="exist cat">E.USER</td>
                </tr>
                <tr>
               	    <td height="1px">&nbsp;</td>
                </tr>
                <tr>
               	    <td class="yes cat"></td>
               	    <td>NO</td>
                </tr>
            </table>
        </td>
      	
        <td align="center" valign="top">
        	<div id="tabgroupgridc1" style="overflow:auto; height:300px; width:1000px;" align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                       <td align="center"><div id="tabgroupgridc1_2"></div></td>
                    </tr>
                    <tr>
                        <td><div id="tabgroupgridc1link1" style="padding:2px;" align="left"> </div></td>
                    </tr>
                 </table>
       		</div>
           <div id="tabgroupgridc2" style="overflow:auto; height:300px; width:1000px; display:none" align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><div id="tabgroupgridc1_1"  > </div></td>
                </tr>
                <tr>
                  <td><div id="tabgroupgridc1link" style="padding:2px;" align="left"> </div></td>
                </tr>
              </table>
            </div>
             <div id="regresultgrid" style="overflow:auto; display:none; height:300px; width:1060px;">&nbsp;</div>
		</td>
        
        <td align="right" valign="top">
        	<table>
            	<tr>
               	     <td  class="type category">TYPE</td>
                </tr>
                <tr>
               	    <td height="1px">&nbsp;</td>
                </tr>
                <tr>
               	    <td class="management category"></td><td>MANAGEMENT</td>
                </tr>
                <tr>
               	    <td height="1px">&nbsp;</td>
                </tr>
                <tr>
                	<td class="teamleader category"></td><td>TEAMLEADER</td>
                </tr>
                <tr>
                	<td height="1px">&nbsp;</td>
                </tr>
                <tr>
                	<td class="general category"></td><td>E.OTHERS</td>
                </tr>
                <tr>
                	<td height="1px">&nbsp;</td>
                </tr>
                <tr>
                	<td class="onsite category"></td><td>E.ONSITE</td>
                </tr>
                <tr>
                	<td height="1px">&nbsp;</td>
                </tr>
                <tr>
                	<td class="admin category"></td><td>ADMIN</td>
                </tr>
                <tr>
                	<td height="1px">&nbsp;</td>
                </tr>
                <tr>
                	<td class="guest category"></td><td>GUEST</td>
                </tr>
            </table>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
<?php } ?>