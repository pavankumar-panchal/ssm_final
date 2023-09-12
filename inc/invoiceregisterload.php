<tr>
  <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
            <tr>
              <td class="header-line" style="padding:0">&nbsp;&nbsp;Search / Get / View Details</td>
              <td align="right" class="header-line" style="padding-right:7px"></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><form action="" method="post" name="registerloadform" id="registerloadform" onsubmit="javascript:return registerloadsearch('registerloadform');">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td width="37%" valign="top">Select the Register [Onsite/Inhouse]:</td>
                            <td width="63%" valign="top"><label>
                            <input name="database" type="radio" id="database0" value="ssm_onsiteregister" checked="checked" onclick="javascript:registerloadsearch('registerloadform');" />
Onsite </label>
                              <label>
                              <input type="radio" name="database" value="ssm_inhouseregister" id="database1"  onclick="registerloadsearch('registerloadform');"/>
In-house</label>
                           </td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Search Text: </td>
                            <td valign="top"><input name="searchcriteria" type="text" id="searchcriteria" size="50" maxlength="25" onkeyup="javascript:return registerloadsearch('registerloadform')"  class="swifttext" autocomplete="off"/></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td colspan="2" valign="top">In:
                              
                              <label><input type="radio" name="databasefield" id="databasefield0" value="customername" onclick="javascript:registerloadsearch('registerloadform');"/>
Customer Name</label><label>
<input type="radio" name="databasefield" id="databasefield1" value="customerid" checked="checked"  onclick="javascript:registerloadsearch('registerloadform');"/>
Customer Id</label><label>
<input type="radio" name="databasefield" value="billno" id="databasefield2" onclick="javascript:registerloadsearch('registerloadform');" />
Bill No</label><label>
<input type="radio" name="databasefield" value="status" id="databasefield7" onclick="javascript:registerloadsearch('registerloadform');" />
Status</label><label>
<input type="radio" name="databasefield" value="date" id="databasefield3" onclick="javascript:registerloadsearch('registerloadform');" />
Registered Date</label><label>
<label><input type="radio" name="databasefield" id="databasefield4" value="solveddate" onclick="javascript:registerloadsearch('registerloadform');" />
Solved Date</label>
<input type="radio" name="databasefield" value="solvedby" id="databasefield5" onclick="javascript:registerloadsearch('registerloadform');" />
Solved By</label>
<label><input type="radio" name="databasefield" value="userid" id="databasefield6" onclick="javascript:registerloadsearch('registerloadform');" />
Entered By</label></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Order By:</td>
                            <td valign="top"><select name="orderby" id="orderby" onchange="javascript:registerloadsearch('registerloadform');" class="swiftselect" >
                              <option value="customerid">Customer ID</option>
                              <option value="customername">Customer Name</option>
                              <option value="date" selected="selected">date</option>
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
        <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="35"><input type="hidden" name="hiddendbinfo" value="" id="hiddendbinfo" /><input type="hidden" name="hiddenregisterinfo" value="" id="hiddenregisterinfo" />
        
          <input type="hidden" id="selectvaluehidden" name="selectvaluehidden" value=""  />
          <button class="swiftchoicebutton" id="nameload-select" value="" type="button" onclick="loadpasscuidregister('selectvaluehidden');getcontentdivfunc(); customerrecords('nameloadform');" href="javascript:void(0);">Select</button>
          <button class="swiftchoicebutton" id="nameload-close" type="button" onclick="getcontentdivfunc();" href="javascript:void(0);">Cancel</button></td>
      </tr>
  </table></td>
</tr>
