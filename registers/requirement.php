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
<script language="javascript" src="../functions/requirementregister.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>


<div class="container mt-5">
  <div class="card" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
    <div class="card-header bg-light d-flex justify-content-between" onclick="showhide('maindiv','toggleimg');">
      <div>&nbsp;&nbsp;Enter/Edit/View Details</div>
    </div>
    <div class="card-body">
      <div id="maindiv" style="display: block;">
        <div class="row">
          <div class="col-md-6">
            <form action="" method="post" name="submitform" id="submitform" onSubmit="return false;">
              <div class="display">
                <div class="mb-3">
                  <label class="form-label mt-2">Anonymous:</label> <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anonymous" id="databasefield12" value="yes"
                      onclick="formsubmitcustomer();">
                    <label class="form-check-label" for="databasefield12">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anonymous" id="databasefield13" value="no"
                      onclick="formsubmitcustomer();" checked>
                    <label class="form-check-label" for="databasefield13">No</label>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="customername" class="form-label">Reported By:</label>
                  <input name="customername" type="text" class="form-control" id="customername" autocomplete="off">
                  <span id="getcustomerlink" style="visibility:visible;"> <a href="javascript:void(0);"
                      onClick="getcustomer(); getcustomerfunc();registernameload('requirement')"
                      style="cursor:pointer"><img src="../images/userid-bg.gif" width="14" height="16" border="0"
                        align="absmiddle" /></a></span>
                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                  <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                    value="<?php echo ($reportingauthority); ?>" />
                  <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                    value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                  <input type="hidden" name="customerid" id="customerid" value="" />
                  <input type="hidden" name="requirementreportgrid" id="requirementreportgrid" value="" />
                </div>
                <div class="mb-3">
                  <label for="date" class="form-label">Date:</label>
                  <input name="date" type="text" class="form-control" id="date" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="time" class="form-label">Time:</label>
                  <input name="time" type="text" class="form-control" id="time" autocomplete="off"
                    value="<?php echo ($localtime); ?>">
                </div>

                <div class="mb-3">
                  <label for="state" class="form-label">State:</label>
                  <select name="state" class="form-select  form-control" id="state">
                    <?php include('../inc/state.php'); ?>

                  </select>
                </div>

                <div class="mb-3">
                  <label for="registered-name" class="form-label">Product Group:</label>
                  <?php include('../inc/productgroup.php');
                  productname('productgroup', '');
                  ?>
                </div>
                <div class="mb-3">
                  <label for="registered-name" class="form-label">Product Name(<font color="#FF0000">
                      Optional</font>)</label>
                  <span id="productnamedisplay">
                    <select name="productname" class="form-select  form-control" id="productname">
                      <option value="" selected="selected">ALL</option>
                    </select>
                  </span>

                </div>

                <div class="mb-3">
                  <label for="registered-name" class="form-label">Product version:</label>
                  <span id="productversiondisplay">
                    <select name="productversion" class="form-select  form-control" id="productversion">
                      <option value="" selected="selected">ALL</option>
                    </select>
                  </span>
                </div>
                <div class="mb-3">
                  <label for="database" class="form-label">Database:</label>
                  <select name="database2" class="form-select  form-control" id="database2">
                    <option value="" selected="selected">ALL</option>
                    <option value="access">MS Access</option>
                    <option value="sql">MS SQL</option>
                    <option value="mysql">MySQL</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="requirement" class="form-label">Requirements:</label>
                  <input name="requirement" type="text" class="form-control" id="requirement" autocomplete="off">
                  <a href="javascript:void(0);" style="cursor:pointer" onclick="getquestionfunc(); getquestion();"><img
                      src="../images/get-problem.gif" width="22" height="22" border="0" align="top" /></a>
                </div>

                <!-- More input fields -->
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
              <div class="display">
                <div class="mb-3">
                  <label for="reportedto" class="form-label">Reported To:</label>
                  <input name="reportedto" type="text" class="form-control" id="reportedto" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="status" class="form-label">Status:</label>
                  <select name="status" class="form-select swiftselect form-control" id="status">
                    <option value="" selected="selected">Make A Selection</option>
                    <option value="solved">Solved</option>
                    <option value="unsolved">Un Solved</option>
                    <option value="rejected">Rejected</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="solveddate" class="form-label">Solved Date:</label>
                  <input name="solveddate" type="text" class="form-control" id="DPC_solveddate" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="solutiongiven" class="form-label">Solution Given:</label>
                  <input name="solutiongiven" type="text" class="form-control" id="solutiongiven" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="solutionenteredtime" class="form-label">Solution Entered Time:</label>
                  <input name="solutionenteredtime" type="text" class="form-control" id="solutionenteredtime"
                    autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="remarks" class="form-label">Remarks:</label>
                  <input name="remarks" type="email" class="form-control" id="remarks" autocomplete="off">
                </div>

                <div class="mb-3">
                  <label for="userid" class="form-label">Entered BY:</label> <br>
                  <input name="userid" type="text" class="form-control" id="userid" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="requirementid" class="form-label">Requirement ID:</label>
                  <input name="requirementid" type="text" class="form-control" id="requirementid" autocomplete="off">
                </div>
                <!-- More input fields -->
              </div>
            </form>
          </div>
        </div>

        <div class="container mt-3">
          <div class="row">
            <div class="col-md-12 float-right text-end">
              <button name="new" type="reset" class="btn btn-secondary m-2" id="view"
                onclick="setradiovalue(document.getElementById('submitform').anonymous, 'no'); newentry();  formsubmitcustomer(); clearinnerhtml(); gettime();">New</button>
              <button name="save" type="submit" class="btn btn-primary m-2" id="view"
                onclick="formsubmit('save');">Save</button>
              <button name="delete" type="submit" class="btn btn-danger m-2" id="delete"
                onclick="formsubmit('delete');">Delete</button>

              <button name="requirementreport" type="submit" class="btn btn-warning m-2" id="requirementreport"
                onclick="formsubmit('requirementreport');" value="Req. Report">Error Report</button>
            </div>
          </div>
        </div>
      </div>
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