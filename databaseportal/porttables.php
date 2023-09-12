<?php
if ($usertype <> 'ADMIN')
  header("location:../index.php");
else {
  if ($_POST['fromtable'] <> '' || $_POST['fromtablefields'] <> '' || $_POST['totable'] <> '' || $_POST['totablefields'] <> '') {
    if (isset($_POST['submit'])) {
      $message = '';
      $table_name = $_POST['fromtable'];
      $table_name_value = $_POST['fromtablefields'];
      $backup_table_name = $_POST['totable'];
      $backup_table_name_value = $_POST['totablefields'];
      $sql = "SELECT * from $table_name";
      $result = runmysqlquery($sql);
      backup_table_data($table_name, $backup_table_name, $table_name_value, $backup_table_name_value);
    }
  } else {
    $message = 'All the fields are Mandatory';
  }
  ?>

  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <div id="contentdiv" style="display:block;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td class="content-header">Attendance > Advanced</td>
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
                  <form method="post" name="submitform" id="submitform" action="">
                    <div id="tabgrouponsitec1">
                      <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr bgcolor="#f7faff">
                                <td valign="top">From Table Name:</td>
                                <td valign="top"><input name="fromtable" type="text" class="swifttext" id="fromtable"
                                    size="30" />
                                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                                  <input type="hidden" name="loggedusertype" id="loggedusertype"
                                    value="<?php echo ($usertype); ?>" />
                                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                                    value="<?php echo ($reportingauthority); ?>" />
                                </td>
                              </tr>
                              <tr bgcolor="#edf4ff">
                                <td valign="top">From Table Fields</td>
                                <td valign="top"><input name="fromtablefields" type="text" class="swifttext"
                                    id="fromtablefields" size="60" /></td>
                              </tr>
                              <tr bgcolor="#f7faff">
                                <td valign="top">Destination Table Name:</td>
                                <td valign="top"><input name="totable" type="text" class="swifttext" id="totable"
                                    size="30" /></td>
                              </tr>
                              <tr bgcolor="#EDF4FF">
                                <td valign="top">Destination Table Fields:</td>
                                <td valign="top"><input name="totablefields" type="text" class="swifttext"
                                    id="totablefields" size="60" /></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="35">
                              <tr>
                                <td width="68%" height="35" align="left" valign="middle">
                                  <div id="form-error">
                                    <?php if ($message <> '')
                                      echo ($message); ?>
                                  </div>
                                </td>
                                <td width="32%" height="35" align="right" valign="middle"><input name="submit"
                                    type="submit" class="swiftchoicebutton" id="submit" value="Submit" />
                                  &nbsp;&nbsp;&nbsp;
                                  <input name="reset" type="reset" class="swiftchoicebutton" id="reset" value="Reset" />
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
    </table>
  </div>
<?php } ?>