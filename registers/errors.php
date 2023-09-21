<?php
$month = date('m');
if ($month >= '04')
  $date = '01-04-' . date('Y');
else {
  $year = date('Y') - '1';
  $date = '01-04-' . $year; //echo($date);
}

?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/errorregister.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">


  <div class="container mt-5">
    <div class="card" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
      <div class="card-header bg-light" onclick="showhide('maindiv','toggleimg');">
        <div class="d-flex justify-content-between">
          <div class="py-2">&nbsp;&nbsp;Enter/Edit/View Details</div>
          <div class="py-2">
            <div><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" align="absmiddle"></div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
          <div class="display">
            <div class="row">
              <div class="col-md-6">
                <div class="bg-white p-2 ">
                  <label for="anonymous">Anonymous:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="anonymous" id="databasefield12" value="yes"
                      onclick="formsubmitcustomer();">
                    <label class="form-check-label" for="databasefield12">Yes</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="anonymous" id="databasefield13" value="no"
                      onclick="formsubmitcustomer();" checked>
                    <label class="form-check-label" for="databasefield13">No</label>
                  </div>
                </div>
                <div class="bg-white p-2 ">
                  <label for="reported-by">Reported By:</label>
                  <input name="customername" type="text" class="form-control" id="customername" autocomplete="off">
                  <span id="getcustomerlink" style="visibility:visible;"><a href="javascript:void(0);"
                      onClick="getcustomer(); getcustomerfunc();registernameload('error')" style="cursor:pointer"><img
                        src="../images/userid-bg.gif" width="14" height="16" border="0" align="absmiddle" /></a></span>
                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                  <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                    value="<?php echo ($reportingauthority); ?>" />
                  <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                    value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                  <input type="hidden" name="customerid" id="customerid" value="" />
                  <input type="hidden" name="errorreportgrid" id="errorreportgrid" value="" />
                </div>
                <div class="bg-white p-2 ">
                  <label for="date">Date:</label>
                  <input name="date" type="text" class="form-control" id="date" autocomplete="off"
                    value="<?php echo (datetimelocal('d-m-Y')); ?>">
                </div>
                <div class="bg-white p-2 ">
                  <label for="time">Time:</label>
                  <input name="time" type="text" class="form-control" id="time" autocomplete="off"
                    value="<?php echo (datetimelocal('H:i:s')); ?>">
                </div>
                <div class="bg-white p-2 ">
                  <label for="state">State:</label>
                  <select name="state" class="form-select form-control" id="state" onchange="" disabled="disabled">
                    <!-- Add state options here -->
                    <?php include('../inc/state.php'); ?>

                  </select>
                </div>
                <div class="bg-white p-2 ">
                  <label for="product-group">Product Group:</label>
                  <?php include('../inc/productgroup.php');
                  productname('productgroup', '');
                  ?>
                </div>
                <div class="bg-white p-2 ">
                  <label for="product-name">Product Name(<font color="#FF0000">Optional</font>
                    )</label>
                  <select name="productname" class="form-select form-control" id="productname" onchange="">
                    <option value="" selected="selected">Make a Selection</option>
                    <!-- Add product name options here -->
                  </select>
                </div>
                <div class="bg-white p-2 ">
                  <label for="product-version">Product Version:</label>
                  <span id="productversiondisplay">
                    <select name="productversion" class="form-select form-control" id="productversion" onchange="">
                      <option value="" selected="selected">Make a Selection</option>
                      <!-- Add product version options here -->
                    </select>
                  </span>
                </div>
                <div class="bg-white p-2 ">
                  <label for="database">Database:</label>
                  <select name="database" class="form-select swiftselect form-control" id="database" onchange="">
                    <option value="" selected="selected">Make a Selection</option>
                    <!-- Add database options here -->
                    <option value="access">MS Access</option>
                    <option value="sql">MS SQL</option>
                    <option value="mysql">MySQL</option>
                  </select>
                </div>
                <div class="bg-white p-2 ">
                  <label for="status">Error Reported:</label>
                  <input name="errorreported" type="text" class="form-control" id="errorreported" autocomplete="off">
                  <a href="javascript:void(0);" style="cursor:pointer" onclick="getquestionfunc(); getquestion();"><img
                      src="../images/get-problem.gif" width="22" height="22" border="0" align="top" /></a>
                </div>
                <div class="bg-white p-2 ">
                  <label for="status">Error understood by you:</label>
                  <input name="errorunderstood" type="text" class="form-control" id="errorunderstood"
                    autocomplete="off">
                </div>
                <div class="bg-white p-2 ">
                  <label for="status">Reported To:</label>
                  <input name="reportedto" type="text" class="form-control" id="reportedto" autocomplete="off">
                </div>
                <div class="bg-white p-2 ">
                  <label for="status">Error File:</label>
                  <input name="errorfile" type="file" class="form-control" id="errorfile" autocomplete="off">

                  <span id="downloadlinkfile"></span>
                </div>

              </div>
              <div class="col-md-6">
                <div class="bg-white p-2 ">
                  <label for="database">Status:</label>
                  <select name="status" class="form-select form-control" id="status" onchange="">
                    <option value="solved">Solved</option>
                    <option value="unsolved" selected="selected">Un Solved</option>
                    <option value="rejected">Rejected</option>
                  </select>
                </div>
                <div class="bg-white p-2 ">
                  <label for="solved-date">Solved Date:</label>
                  <input name="solveddate" type="text" class="form-control" id="DPC_solveddate" autocomplete="off">
                </div>
                <div class="bg-white p-2 ">
                  <label for="solution-given">Solution Given:</label>
                  <textarea name="solutiongiven" cols="45" class="form-control" id="solutiongiven" data-gramm="false"
                    wt-ignore-input="true"></textarea>
                </div>
                <div class="bg-white p-2 ">
                  <label for="solutionenteredtime">Solution Entered Time:</label>
                  <input name="solutionenteredtime" type="text" class="form-control" id="solutionenteredtime"
                    autocomplete="off">
                </div>
                <div class="bg-white p-2 ">
                  <label for="solution-file">Solution File:</label>
                  <input name="solutionfile" type="file" class="form-control" id="solutionfile" autocomplete="off">
                  <span id="downloadlinkfile1"></span>
                </div>
                <div class="bg-white p-2 ">
                  <label for="remarks">Remarks:</label>
                  <textarea name="remarks" cols="45" class="form-control" id="remarks" data-gramm="false"
                    wt-ignore-input="true"></textarea>
                </div>
                <div class="bg-white p-2 ">
                  <label for="entered-by">Entered By:</label>
                  <input name="userid" type="text" class="form-control " id="userid" autocomplete="off">
                </div>
                <div class="bg-white p-2 ">
                  <label for="email-id">Email ID:</label>
                  <input name="errorid" type="email" class="form-control " id="errorid" autocomplete="off">
                </div>
                <div class="bg-white p-2 ">
                  <!-- <label for="error-reported">Error Reported:</label>
                                    <textarea name="error-reported" cols="45" class="form-control" id="error-reported"
                                        data-gramm="false" wt-ignore-input="true"></textarea> -->
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 text-end">
                <button name="new" type="reset" class="btn btn-secondary m-2" id="new">New</button>
                <button name="save" type="submit" class="btn btn-primary m-2" id="save" id="save" value="Save"
                  onclick="formsubmit('save')">Save</button>
                <button name="delete" type="submit" class="btn btn-danger m-2" id="delete"
                  onclick="formsubmit('delete');" disabled="disaled">Delete</button>
                <button name="errorreport" type="submit" class="btn btn-warning m-2" id="errorreport"
                  onclick="formsubmit('errorreport')">Error Report</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <button class="btn btn-primary" id="tabgroupgridh1"
                  onclick="gridtab4('1','tabgroupgrid');">Default</button>
                <button class="btn btn-primary ml-2" id="tabgroupgridh2"
                  onclick="gridtab4('2','tabgroupgrid');">Filter</button>
                <button class="btn btn-primary ml-2" id="tabgroupgridh3" onclick="gridtab4('3','tabgroupgrid');">Flagged
                  Entry</button>
                <button class="btn btn-primary ml-2" id="tabgroupgridh4"
                  onclick="gridtab4('4','tabgroupgrid');">Customer</button>
              </div>
              <div class="flex-grow-1"></div>
              <div>
                <span id="tabgroupgridwb1"></span>
                <span id="tabgroupgridwb2"></span>
                <span id="tabgroupgridwb3"></span>
                <span id="tabgroupgridwb4"></span>
              </div>
            </div>

            <div class="mt-3">
              <div id="tabgroupgridc1" class="overflow-auto" style="height: 300px; width: 100%; padding: 2px;"
                align="center">
                <!-- Content for tabgroupgridc1 -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center">
                      <div id="tabgroupgridc1_2"> </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div id="tabgroupgridc1link1" style="padding:2px;" align="left"> </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div id="tabgroupgridc2" class="overflow-auto"
                style="height: 300px; width: 100%; padding: 2px; display: none;" align="center">
                <!-- Content for tabgroupgridc2 -->


                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center">
                      <div id="tabgroupgridc1_1"> </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div id="tabgroupgridc1link" style="padding:2px;" align="left"> </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div id="regresultgrid" class="overflow-auto"
                style="height: 300px; width: 100%; padding: 2px; display: none;">
                &nbsp;
              </div>
              <div id="tabgroupgridc3" class="overflow-auto"
                style="height: 300px; width: 100%; padding: 2px; display: none">
                No records to be displayed. Please filter the records from the filter form
              </div>
              <div id="tabgroupgridc4" class="overflow-auto"
                style="height: 300px; width: 100%; padding: 2px; display: none">
                No records to be displayed. Please filter the records from the filter form
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>







</div>
<div id="nameloaddiv" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Call Register > Get Customer</td>
    </tr>
    <tr>
      <td>
        <div id="gc-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/nameload.php'); ?>
  </table>
</div>
<div id="questionload" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Email Register > Get Problems and Solutions</td>
    </tr>
    <tr>
      <td>
        <div id="gq-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/questionload.php'); ?>
  </table>
</div>
<div id="fileuploaddiv" style="display:none;">
  <?php include('../inc/fileuploadform.php'); ?>
</div>