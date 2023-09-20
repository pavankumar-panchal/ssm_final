<?php
// session_start();
require_once('../functions/phpfunctions.php');
$month = date('m');
if ($month >= '04')
  $date = '01-04-' . date('Y');
else {
  $year = date('Y') - '1';
  $date = '01-04-' . $year;
}

?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/callregister.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>
<div id="contentdiv" style="display:block;">




  <div class="container users_la mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
          <div class="card-header bg-light">
            Enter / Edit / view Details
          </div>
          <div class="card-body">
            <div id="maindiv" style="display: block;">
              <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                <!-- Your form content goes here -->
                <div class="display" style="display: flex; flex-direction: row; width:100%;">
                  <!-- first div -->

                  <div class="mb-3" style="width: 50%; margin:20px;">
                    <label for="customername" class="form-label">Call Type:</label>
                    <div class="opt d-flex flex-row ">
                      <div class="form-check me-3 align-items-center">

                        <label class="form-check-label" for="databasefield11">&nbsp;
                          <input class="form-check-input" type="radio" name="calltype" id="incoming" value="incoming">
                          Incoming</label>
                      </div>
                      <div class="form-check me-3 align-items-center">

                        <label class="form-check-label" for="databasefield12">
                          <input class="form-check-input" type="radio" name="calltype" id="incoming"
                            value="outgoing">Outgoing</label>
                      </div>
                    </div>
                    <label for="customername" class="form-label">Anonymous:</label>
                    <div class="opt d-flex flex-row ">
                      <div class="form-check me-3 align-items-center">
                        <label class="form-check-label" for="databasefield9">&nbsp;
                          <input class="form-check-input" type="radio" name="anonymous" id="databasefield9" value="yes"
                            onclick="formsubmitcustomer();">
                          Yes</label>
                      </div>
                      <div class="form-check me-3 align-items-center">

                        <label class="form-check-label" for="databasefield10">
                          <input class="form-check-input" type="radio" name="anonymous" id="databasefield10"
                            onclick="formsubmitcustomer();" value="no" checked="checked">No</label>
                      </div>
                    </div>
                    <label for="customername" class="form-label">Registered Name:</label>
                    <input name="customername" type="text" class="form-control" id="customername" size="20"
                      autocomplete="off" isdatepicker="true">

                    <input type="hidden" name="lastslno" id="lastslno" value="" />
                    <input type="hidden" name="cusid" id="cusid" value="" />
                    <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                    <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                    <input type="hidden" name="endtime" id="endtime" value="" />
                    <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                      value="<?php echo ($reportingauthoritytype); ?>" />
                    <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                      value="<?php echo (datetimelocal('d-m-Y')); ?>" />



                    <label for="customername" class="form-label">Customer ID:</label>
                    <input name="customerid" type="text" class="form-control" id="customerid" size="20"
                      autocomplete="off" isdatepicker="true">

                    <label for="customername" class="form-label">Date:</label>
                    <input name="date" type="text" class="form-control" id="date" size="20" autocomplete="off"
                      isdatepicker="true" value="<?php echo (datetimelocal('d-m-Y')); ?>">

                    <label for="customername" class="form-label">Time:</label>
                    <input name="time" type="text" class="form-control" id="time" size="20" autocomplete="off"
                      isdatepicker="true" value="<?php echo (datetimelocal('H:i:s')); ?>">

                    <label for="customername" class="form-label">Category:</label>
                    <input name="category" type="text" class="form-control" id="category" size="20" autocomplete="off"
                      isdatepicker="true">

                    <label for="customername" class="form-label">State:</label>
                    <select name="state" class="form-select swiftselect form-control" id="state" onchange="">
                      <?php include('../inc/state.php'); ?>

                    </select>
                    <label for="customername" class="form-label">Caller Type:</label>
                    <input name="callertype" type="text" class="form-control" id="callertype" size="20"
                      autocomplete="off" isdatepicker="true">
                    <label for="customername" class="form-label">Product Group:</label>

                    <?php include('../inc/productgroup.php');
                    productname('productgroup', '');
                    ?>

                  </div>

                  <!-- second -->

                  <div class="mb-3 " style="width: 50%; margin:20px;">
                    <label for="customername" class="form-label">Product Name(<font color="#FF0000">
                        Optional</font>)</label>
                    <select name="productname" class="form-select form-control" id="productname" onchange="">
                      <option value="" selected="selected">
                        Make a Selection
                      </option>
                    </select>
                    <label for="customername" class="form-label">Person version:</label>
                    <span id="productversiondisplay">

                      <select name="productversion" class="form-select form-control" id="productversion" onchange="">
                        <option value="" selected="selected">
                          Select a Product
                        </option>
                      </select>
                    </span>
                    <label for="customername" class="form-label">Person Name:</label>
                    <input name="personname" type="text" class="form-control" id="personname" size="20"
                      autocomplete="off" isdatepicker="true">

                    <label for="customername" class="form-label">Problem:</label>
                    <input name="problem" type="text" class="form-control" id="problem" size="20" autocomplete="off"
                      isdatepicker="true">
                    <a href="javascript:void(0);" style="cursor:pointer"
                      onclick="getquestionfunc(); getquestion();"><img src="../images/get-problem.gif" width="22"
                        height="22" border="0" align="top" /></a>

                    <label for="teamleaderremarks" class="form-label">Status:</label>
                    <select name="status" class="form-select  form-control" id="status" onchange="">
                      <option value="" selected="selected">
                        Make a Selection
                      </option>
                      <option value="solved">Solved</option>
                      <option value="unsolved">Un Solved</option>
                      <option value="transferred">Transferred</option>
                      <option value="registration given">Registration Given</option>
                    </select>
                    <!-- second div -->
                    <label for="customername" class="form-label">Call Category:</label>
                    <select name="callcategory" class="form-select swiftselect form-control" id="callcategory"
                      onchange="">
                      <?php include('../inc/callcategory.php'); ?>

                    </select>
                    <label for="customername" class="form-label">Solved Through:</label>
                    <input name="stremoteconnection" type="text" class="form-control" id="stremoteconnection" size="20"
                      autocomplete="off" isdatepicker="true">Remote
                    Connection

                    <label for="customername" class="form-label">Transferred To: </label>
                    <select name="transferredto" class="form-select swiftselect form-control" id="transferredto"
                      onchange="" selected="selected">
                      <option value="none" selected="selected">None</option>
                      <?php include('../inc/useridselection.php'); ?>
                      <option value="registration">Registration Department</option>
                      <option value="others">Others</option>
                    </select>

                    <label for="remarks" class="form-label">Remarks:</label>
                    <input name="remarks" type="text" class="form-control" id="remarks" size="20" autocomplete="off"
                      isdatepicker="true">
                    <label for="userid" class="form-label">Entered By:</label>
                    <input name="userid" type="text" class="form-control" id="userid" size="20" autocomplete="off"
                      isdatepicker="true" value="<?php echo ($loggedusername); ?>">

                    <label for="compliantid" class="form-label">Complaint ID: </label>
                    <input name="compliantid" type="text" class="form-control" id="compliantid" size="20"
                      autocomplete="off" isdatepicker="true">
                    <!-- <label for=""> Team Leader Remarks:</label> -->
                  </div>
                  <!-- Add more textarea fields as needed -->
                </div>
                <div class="text-end float-right flex">
                  <button name="new" type="reset" class="btn btn-secondary">New</button>
                  <button name="save" type="submit" class="btn btn-primary" id="save" value="Save"
                    onclick="formsubmit('save')">View</button>
                  <button name="delete" type="submit" class="btn btn-warning" id="delete" value="Delete"
                    onclick="formsubmit('delete')" disabled="disabled">To Excel</button>
                </div>
              </form>
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