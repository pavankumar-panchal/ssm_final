<tr>
  <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
            <tr>
              <td class="header-line" style="padding:0">&nbsp;&nbsp;Search / Get / View Details</td>
              <td align="right" class="header-line" style="padding-right:7px"></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><form action="" method="post" name="invoiceregisterloadform" id="invoiceregisterloadform" onsubmit="javascript:return invoiceregisterload('invoiceregisterloadform');">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td width="37%" valign="top">Search Text: </td>
                            <td width="63%" valign="top"><label></label><label>
                            <input name="searchcriteria" type="text" id="searchcriteria" size="50" maxlength="25" onkeyup="javascript:return invoiceregisterload('invoiceregisterloadform')"  class="swifttext" autocomplete="off"/>
                            </label></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td colspan="2" valign="top">In:
                              <label></label>
                              <input type="radio" name="databasefield" id="databasefield0" value="customername" onclick="javascript:invoiceregisterload('invoiceregisterloadform');"/>
Customer Name
<input type="radio" name="databasefield" id="databasefield1" value="customerid" checked="checked"  onclick="javascript:invoiceregisterload('invoiceregisterloadform');"/>
Customer Id
<input type="radio" name="databasefield" value="billno" id="databasefield2" onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
Bill No
<input type="radio" name="databasefield" value="date" id="databasefield3" onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
Registered Date
<input type="radio" name="databasefield" id="databasefield4" value="solveddate" onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
Solved Date
<input type="radio" name="databasefield" value="solvedby" id="databasefield5" onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
Solved By
<input type="radio" name="databasefield" value="userid" id="databasefield6" onclick="javascript:invoiceregisterload('invoiceregisterloadform');" />
Entered By</td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td valign="top">Order By:</td>
                            <td valign="top"><select name="orderby" id="orderby" onchange="invoiceregisterload('invoiceinvoiceregisterloadform')" class="swiftselect">
                              <option value="customerid">Customer ID</option>
                              <option value="customername" selected="selected">Customer Name</option>
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
              <td colspan="2" valign="top" align="center"><div id="invoiceregisterloadgrid" style="overflow:auto; height:150px; width:1060PX; padding:2px;" align="center"></div></td>
            </tr>
            
          </table></td>
      </tr>
      <tr>
        <td style="padding:0">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="35"><input type="hidden" name="hiddendbinfo" value="" id="hiddendbinfo" /><input type="hidden" name="hiddenregisterinfo" value="" id="hiddenregisterinfo" />
          <input type="hidden" id="hiddenlastslno" name="hiddenlastslno" value=""  />
          <button class="swiftchoicebutton" id="nameload-select" value="" type="button" onclick="loadinvoicesubmit('hiddenlastslno'); getcontentdivfunc(); customerrecords('nameloadform');" href="javascript:void(0);">Select</button>
          <button class="swiftchoicebutton" id="nameload-close" type="button" onclick="getcontentdivfunc();" href="javascript:void(0);">Cancel</button></td>
      </tr>
  </table></td>
</tr>
