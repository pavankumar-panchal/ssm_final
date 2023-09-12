<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand());?>">
<script language="javascript" src="../functions/editprofile.js?dummy = <?php echo (rand());?>" type="text/javascript"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Profile > Complete your Profile</td>
  </tr>
  <tr>
    <td><div align="center"><img src="../images/warn.gif" border="0" align="absmiddle" />&nbsp;<strong><font color="#FF0000">Your profile is incomplete. Kindly update your profile to use Saral SSM further</font></strong><font color="#FF0000">.</font></div></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
        <td class="header-line" style="padding:0">&nbsp;&nbsp;Complete your profile Details</td>
        <td align="right" class="header-line" style="padding-right:7px"><div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"  align="absmiddle" /></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="maindiv">
          <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="50%" valign="top" style="border-right:1px solid #d1dceb;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">Full Name:</td>
                      <td valign="top"><input name="fullname" type="text" class="swifttext" id="fullname" size="30"  autocomplete="off" value=""/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Gender:</td>
                      <td valign="top"><select name="gender" id="gender" class="swiftselect">
                          <?php if($d_gender == '') { ?>
                          <option value="" selected="selected">Make A Selection</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        <?php } elseif($d_gender == 'male') { ?>
                          <option value="">Make A Selection</option>
                          <option value="male" selected="selected">Male</option>
                          <option value="female">Female</option>
                        <?php } elseif($d_gender == 'female') { ?>
                          <option value="">Make A Selection</option>
                          <option value="male">Male</option>
                          <option value="female" selected="selected">Female</option>
						<?php } ?>
                      </select></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Mobile:</td>
                      <td valign="top"><input name="mobile" type="text" class="swifttext"  id="mobile" size="30"  autocomplete="off" value=""/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Designation:</td>
                      <td valign="top"><input name="designation" type="text"  class="swifttext" id="designation" size="30"  autocomplete="off" value=""/></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Date of Birth:</td>
                      <td valign="top"><input name="dob" type="text"  class="swifttext" id="DPC_dob" size="30" maxlength="10"  autocomplete="off" value=""  /></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Present Address:</td>
                      <td valign="top"><textarea name="presentaddress" cols="45" class="swifttextarea" id="presentaddress" autocomplete="off"><?php echo($d_presentaddress); ?></textarea></td>
                    </tr>
                </table></td>
                <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr bgcolor="#f7faff">
                      <td valign="top">Permanent Address:</td>
                      <td valign="top"><textarea name="permanentaddress" cols="45" class="swifttextarea" id="permanentaddress" autocomplete="off"><?php echo($d_permanentaddress); ?></textarea></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Date of joining:</td>
                      <td valign="top"><input name="doj" type="text"  class="swifttext" id="DPC_doj" size="30" maxlength="10" autocomplete="off" value=""  /></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Personal Email:</td>
                      <td valign="top"><input name="personalemail" type="text" class="swifttext" id="personalemail" size="30"  autocomplete="off" value=""/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Official Email:</td>
                      <td valign="top"><input name="officialemail" type="text" class="swifttext" id="officialemail" size="30" autocomplete="off"  value="" /></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top">Contact Number:<br />
[In case of Emergency]</td>
                      <td valign="top"><input name="emergencynumber" type="text" class="swifttext"  id="emergencynumber" size="30"  autocomplete="off" value=""/></td>
                    </tr>
                    <tr bgcolor="#edf4ff">
                      <td valign="top">Remarks [Details of Person in case of Emergency]:</td>
                      <td valign="top"><input name="emergencyremarks" type="text" class="swifttext"  id="emergencyremarks" size="30"  autocomplete="off" value=""/></td>
                    </tr>
                </table></td>
              </tr>
              
              <tr>
                <td colspan="2" align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="35"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="71%" id="form-error">&nbsp;</td>
                    <td width="29%"><div align="right">
  <input name="update" type="submit" class="swiftchoicebutton" id="update" value="Update" onclick="formsubmit('update','yes');" />
  &nbsp;&nbsp;&nbsp;
  <input name="clear" type="reset" class="swiftchoicebutton" id="clear" value="Reset" onclick="datagrid();" />
                    </div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </form>
        </div></td>
      </tr>

    </table></td>
  </tr>
</table>
