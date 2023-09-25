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
<script language="javascript" src="../functions/inhouseregister.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">





<div class="card container mt-5" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363); padding=0px -40px 0px -40px;"   >
            <div class="card-header bg-light d-flex justify-content-between " onclick="showhide('maindiv','toggleimg');">
                <div>Enter/Edit/View Details</div>
                <div align="right">
                <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
                  align="absmiddle" />
                </div>
            </div>
            <div id="maindiv" style="display: block;">

            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                                <div class="display">
                                    <div class="mb-3">
                                        <label class="form-label mt-2">Anonymous:</label> <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="anonymous"
                                                id="databasefield12" value="yes" onclick="formsubmitcustomer();">
                                            <label class="form-check-label" for="databasefield12">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="anonymous"
                                                id="databasefield13" value="no" onclick="formsubmitcustomer();" checked>
                                            <label class="form-check-label" for="databasefield13">No</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Registered Name:</label>
                                        <input name="customername" type="text" class="form-control" id="customername"
                                            autocomplete="off">
                                        <span id="getcustomerlink" style="visibility:visible;"> <a
                                                href="javascript:void(0);"
                                                onClick="getcustomer(); getcustomerfunc(); registernameload('inhouse')"
                                                style="cursor:pointer"> <img src="../images/userid-bg.gif" width="14"
                                                    height="16" border="0" align="absmiddle" /></a></span>
                                        <input type="hidden" name="lastslno" id="lastslno" value="" />
                                        <input type="hidden" name="loggeduser" id="loggeduser"
                                            value="<?php echo ($user); ?>" />
                                        <input type="hidden" name="loggedusertype" id="loggedusertype"
                                            value="<?php echo ($usertype); ?>" />
                                        <input type="hidden" name="loggedreportingauthority"
                                            id="loggedreportingauthority"
                                            value="<?php echo ($reportingauthority); ?>" />
                                        <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                                            value="<?php echo (datetimelocal('d-m-Y')); ?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Customer Id:</label>
                                        <input name="customerid" type="text" class="form-control" id="customerid"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Date:</label>
                                        <input name="date" type="text" class="form-control" id="date"
                                            autocomplete="off" value="<?php echo (datetimelocal('d-m-Y')); ?>" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Time:</label>
                                        <input name="time" type="text" class="form-control" id="time"
                                            autocomplete="off"  value="<?php echo (datetimelocal('H:i:s')); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Category:</label>
                                        <input name="category" type="text" class="form-control" id="category"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">State:</label>
                                        <select name="state" class="form-control form-select" id="state">
                                            <?php include('../inc/state.php'); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Caller Type:</label>
                                        <input name="callertype" type="text" class="form-control" id="callertype"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Product Group(<font color="#FF0000">Optional</font>)</label>
                                        <?php include('../inc/productgroup.php');
                                        productname('productgroup', '');
                                        ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Product Name:</label>
                                        <select name="productname" class="form-select swiftselect form-control"
                                            id="productname">
                                            <option value="" selected="selected">ALL</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Product Version:</label>
                                      <span id="productnamedisplay">
                                        <select name="productversion" class="form-select form-control"
                                            id="productversion">
                                            <option value="" selected="selected">Select The Product</option>
                                        </select>
                                         </span>
                                    </div>
                                    <!-- More input fields -->
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                                <div class="display">
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Contact Person:</label>
                                        <input name="contactperson" type="text" class="form-control" id="contactperson"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Problem:</label>
                                        <input name="problem" type="text" class="form-control" id="problem"
                                            autocomplete="off">
                                        <a href="javascript:void(0);" style="cursor:pointer"
                                            onClick="getquestionfunc(); getquestion();"><img
                                                src="../images/get-problem.gif" width="22" height="22" border="0"
                                                align="top" /></a>
                                    </div>
                                    <div class="mb-3">
                                        <label for="state" class="form-label">Service Charge:</label>
                                        <input name="servicecharge" type="text" class="form-control" id="servicecharge"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="caller-type" class="form-label">Status:</label>
                                        <select name="status" class="form-select swiftselect form-control" id="status">
                                            <option value="notyetattended" selected="selected">Un Attended</option>
                                            <?php if ($usertype <> 'GUEST') { ?>
                                                  <option value="postponed">Postponed</option>
                                                  <option value="inprocess">In Process</option>
                                                  <option value="solved">Solved</option>
                                                  <option value="skipped">Skipped</option>
                                                  <option value="unsolved">Un Solved</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="caller-type" class="form-label">Assigned To:</label>
                                        <select name="assignedto" class="form-select swiftselect form-control" id="assignedto"  <?php if ($usertype == 'GUEST' || $usertype == 'HR') { ?> disabled="disabled" <?php } ?>>
                                            
                                            <option value="" selected="selected">ALL</option>
                                            <?php include('../inc/useridselection.php'); ?>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="caller-type" class="form-label">Solved By:</label>
                                        <select name="s_productgroup" class="form-select swiftselect form-control"
                                            id="s_productgroup"   <?php if ($usertype == 'GUEST' || $usertype == 'HR') { ?> disabled="disabled" <?php } ?>>
                                            <option value="" selected="selected">ALL</option>
                                  <?php include('../inc/useridselection.php'); ?>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Bill Number:</label>
                                        <input name="billno" type="text" class="form-control" id="billno"
                                            autocomplete="off" <?php if ($usertype == 'GUEST' || $usertype == 'HR') { ?>
                                      disabled="disabled" <?php } ?> /></td>
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Acknowledgement Number:</label>
                                        <input name="customername" type="text" class="form-control" id="customername"
                                            autocomplete="off" <?php if ($usertype == 'GUEST' || $usertype == 'HR') { ?> disabled="disabled" <?php } ?> />
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Remarks:</label>
                                        <input name="customername" type="text" class="form-control" id="customername"
                                  <?php if ($usertype == 'GUEST' || $usertype == 'HR') { ?> disabled="disabled" <?php } ?>>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label ">Entered By:</label>
                                        <input name="userid" type="text" class="form-label form-select" id="userid" size="30"
                                  readonly="readonly" value="<?php echo ($loggedusername); ?>" autocomplete="off"
                                  style="background:#FEFFE6;" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="registered-name" class="form-label">Compliant ID:</label>
                                        <input name="complaintid" type="text" class="form-label form-select"  id="complaintid"
                                  size="30" maxlength="40" readonly="readonly" autocomplete="off"
                                  style="background:#FEFFE6;" />
                                    </div>

                                    <!-- More input fields -->
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12 float-right text-end">
                                <button name="new" type="reset" class="btn btn-secondary m-2" id="new"
                                >New</button>
                                <button name="save" type="submit" class="btn btn-primary m-2" id="view"
                                    onclick="formsubmit('save');" value="save">Save</button>
                                <button name="delete" type="submit" class="btn btn-danger m-2" id="delete"
                                    onclick="formsubmit('delete');" disabled>Delete</button>
                                
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
                      <button class="btn btn-primary ml-2" id="tabgroupgridh3"
                        onclick="gridtab4('3','tabgroupgrid');">Flagged
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
      <td class="content-header">Call Register > Get Problems and Solutions</td>
    </tr>
    <tr>
      <td>
        <div id="gq-form-error"></div>
      </td>
    </tr>
    <?php include('../inc/questionload.php'); ?>
  </table>
</div>