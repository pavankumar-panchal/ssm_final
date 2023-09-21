<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand());?>">
<script language="javascript" src="../functions/onsite-statistics.js?dummy = <?php echo (rand());?>" type="text/javascript"></script>
<div id="contentdiv" style="display:block;">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="content-header">Reports > Onsite Pending Visits</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #6393df; border-top:none;">
      <tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
        <td class="header-line" style="padding:0">&nbsp;&nbsp;Take a print of your pending visits</td>
        <td align="right" class="header-line" style="padding-right:7px"><div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"  align="absmiddle" /></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="maindiv">
          <div><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right"><a href="#null" onclick="printContent('printonsitependingvisits')"><font style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;">Print this page</font></a></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="printonsitependingvisits"></div></td>
  </tr>
</table>
</td>
            </tr>
          </table></div>
        </div></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td style="padding:0">&nbsp;</td>
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
  <?php include('../inc/questionload.php'); ?>
</table>
</div>

