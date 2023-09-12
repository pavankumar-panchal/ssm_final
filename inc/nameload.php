<tr>
  <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
            <tr>
              <td class="header-line" style="padding:0">&nbsp;&nbsp;Search / Get / View Details</td>
              <td align="right" class="header-line" style="padding-right:7px"></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><form action="" method="post" name="nameloadform" id="nameloadform" onsubmit="javascript:return nameloadsearch('nameloadform');">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td width="37%" valign="top">Select the Name [Dealer/Customer/OutStation Employee]:</td>
                            <td width="63%" valign="top"><label>
                              <input name="database" type="radio" id="database0" value="invcustomer" checked="checked" onclick="javascript:nameloadsearch('nameloadform');" />
                              Customer</label>
                              <label>
                              <input type="radio" name="database" value="dealer" id="database1"  onclick="javascript:nameloadsearch('nameloadform');"/>
                              Dealer</label>
                              <label>
                              <input type="radio" name="database" value="employee" id="database2"  onclick="javascript:nameloadsearch('nameloadform');"/>
                              Employees</label><label>
                              <input type="radio" name="database" value="ssmuser" id="database3"  onclick="javascript:nameloadsearch('nameloadform');"/>
                              SSM Users</label></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Search Text: </td>
                            <td valign="top"><input name="searchcriteria" type="text" id="searchcriteria" size="50" maxlength="25" onkeyup="javascript:return nameloadsearch('nameloadform')"  class="swifttext"  autocomplete="off"/></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td colspan="2" valign="top">In:
                              <label>
                              <input type="radio" name="databasefield" id="databasefield0" value="id" onclick="javascript:nameloadsearch('nameloadform');"/>
                              ID</label>
                              <label>
                              <input type="radio" name="databasefield" id="databasefield1" value="name" checked="checked"  onclick="javascript:nameloadsearch('nameloadform');"/>
                              Name</label>
                              <label>
                              <input type="radio" name="databasefield" id="databasefield2" value="category"  onclick="javascript:nameloadsearch('nameloadform');"/>
                              Category</label>
                              <label>
                              <input type="radio" name="databasefield" value="contactperson" id="databasefield3" onclick="javascript:nameloadsearch('nameloadform');" />
                              Contact Person</label>
                              <label>
                              <input type="radio" name="databasefield" value="phone" id="databasefield4" onclick="javascript:nameloadsearch('nameloadform');" />
                              Phone</label>
                              <label>
                              <input type="radio" name="databasefield" id="databasefield5" value="place" onclick="javascript:nameloadsearch('nameloadform');" />
                              Place</label>
                              <label>
                              <input type="radio" name="databasefield" value="email" id="databasefield6" onclick="javascript:nameloadsearch('nameloadform');" />
                              Email</label>
                              <label>
                              <input type="radio" name="databasefield" value="scratchnumber" id="databasefield7" onclick="javascript:nameloadsearch('nameloadform');" />
                              Scratch Card</label>
                              <label>
                              <input type="radio" name="databasefield" value="computerid" id="databasefield8" onclick="javascript:nameloadsearch('nameloadform');" />
                              Computer ID</label></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Order By:</td>
                            <td valign="top"><select name="orderby" id="orderby" onchange="javascript:nameloadsearch('nameloadform');" class="swiftselect">
                                <option value="id">Customer ID</option>
                                <option value="name" selected="selected">Name</option>
                                <option value="contact1">Contact 1</option>
                                <option value="contact2">Contact 2</option>
                                <option value="phone1">Phone 1</option>
                                <option value="phone2">Phone 2</option>
                                <option value="place">Place</option>
                                <option value="email">Email</option>
                              </select>
                              </select></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                </form></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td style="padding:0">&nbsp;</td>
      </tr>
      <tr>
        <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
            <tr>
              <td class="header-line" style="padding:0">&nbsp;&nbsp;View Filtered Records: <span id="wait-box"></span></td>
              <td align="right" class="header-line" style="padding-right:7px;"></td>
            </tr>
            <tr>
              <td colspan="2" valign="top" align="center"><div id="nameloadgrid1" style="overflow:auto; height:150px; width:1060PX; padding:2px;" align="center"></div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td style="padding:0">&nbsp;</td>
      </tr>
      <tr>
        <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
            <tr>
              <td class="header-line" style="padding:0">&nbsp;&nbsp;View Registration Details: </td>
              <td align="right" class="header-line" style="padding-right:7px;"></td>
            </tr>
            <tr>
              <td colspan="2" valign="top" align="center"><div id="nameloadgrid2" style="overflow:auto; height:100px; width:1060PX; padding:2px;" align="center"></div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td style="padding:0">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="35">
        <input type="hidden" name="hiddendbinfo" value="" id="hiddendbinfo" /><input type="hidden" name="hiddenregisterinfo" value="" id="hiddenregisterinfo" />
          <input type="hidden" id="selectvaluehidden" name="selectvaluehidden" value=""  />
          <button class="swiftchoicebutton" id="nameload-select" value="" type="button" onclick="loadpasscuidname('selectvaluehidden');getcontentdivfunc(); customerrecords('nameloadform');" href="javascript:void(0);">Select</button>
          <button class="swiftchoicebutton" id="nameload-close" type="button" onclick="getcontentdivfunc();" href="javascript:void(0);">Cancel</button></td>
      </tr>
    </table></td>
</tr>
