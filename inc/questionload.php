<tr>
  <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
            <tr>
              <td class="header-line" style="padding:0">&nbsp;&nbsp;Search / Get / View Details</td>
              <td align="right" class="header-line" style="padding-right:7px"></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><form action="" method="post" name="questionloadform" id="questionloadform" onsubmit="javascript:return questionloadsearch('questionloadform');">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr bgcolor="#f7faff">
                            <td width="37%" valign="top">Product:</td>
                            <td width="63%" valign="top"><label></label>
                              <select name="selectproductname" id="selectproductname" class="swiftselect" onchange="javascript: questionloadsearch('questionloadform');">
                                <?php include('../inc/productfilter.php'); ?>
                                <option value="" selected="selected">All</option>
                              </select></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Search Text: </td>
                            <td valign="top"><input name="searchquery" type="text" id="searchquery" size="50" maxlength="25" onkeyup="javascript:return questionloadsearch('questionloadform');"  class="swifttext"  autocomplete="off"/></td>
                          </tr>
                          <tr bgcolor="#f7faff">
                            <td colspan="2" valign="top">In:
                              <label>
                              <input name="database" type="radio" id="database0" value="all" checked="checked" onclick="javascript:questionloadsearch('questionloadform');" />
                              All</label>
                              <label>
                              <input name="database" type="radio" id="database1" value="call" onclick="javascript:questionloadsearch('questionloadform');" />
                              Call</label>
                              <label>
                              <input type="radio" name="database" value="email" id="database2"  onclick="questionloadsearch('questionloadform');"/>
                              Email</label>
                              <label>
                              <input type="radio" name="database" value="onsite" id="database4"  onclick="javascript:questionloadsearch('questionloadform');"/>
                              Onsite</label>
                              <label>
                              <input type="radio" name="database" value="inhouse" id="database5"  onclick="javascript:questionloadsearch('questionloadform');"/>
                              Inhouse</label>
                              <label>
                              <input type="radio" name="database" value="skype" id="database6"  onclick="javascript:questionloadsearch('questionloadform');"/>
                              Skype</label>
                              <label>
                              <input type="radio" name="database" value="error" id="database8"  onclick="javascript:questionloadsearch('questionloadform');"/>
                              Error</label>
                              <label>
                              <input type="radio" name="database" value="requirement" id="database9"  onclick="javascript:questionloadsearch('questionloadform');"/>
                              Requirement </label></td>
                          </tr>
                          <tr bgcolor="#edf4ff">
                            <td valign="top">Get the Solution:
                              </td>
                            <td valign="top"></select>
                              <input type="checkbox" name="getsolution" id="getsolution"  checked="checked"/></td>
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
              <td colspan="2" valign="top" align="center"><div id="questionloadgrid1" style="overflow:auto; height:150px; width:1060PX; padding:2px;" align="center"></div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td style="padding:0">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;" height="35"><input type="hidden" name="qhiddendbinfo" value="" id="qhiddendbinfo" />
          <input type="hidden" id="qselectvaluehidden" name="qselectvaluehidden" value=""  />
          <button class="swiftchoicebutton" id="nameload-select" value="" type="button" onclick="loadpasscuidquestion('qselectvaluehidden');getcontentdivfunc();" href="javascript:void(0);">Select</button>
          <button class="swiftchoicebutton" id="nameload-close" type="button" onclick="getcontentdivfunc();" href="javascript:void(0);">Cancel</button></td>
      </tr>
    </table></td>
</tr>
