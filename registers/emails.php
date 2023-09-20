<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {

  $month = date('m');
  if ($month >= '04')
    $date = '01-04-' . date('Y');
  else {
    $year = date('Y') - '1';
    $date = '01-04-' . $year; //echo($date);
  }

  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
  <script language="javascript" src="../functions/emailregister.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>
  <script language="javascript" src="../functions/fileupload.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>
  <div id="contentdiv" style="display:block;">








    <div class="container users_la mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
            <div class="card-header bg-light">
              Enter /Edit/View Details
            </div>
            <div class="card-body">
              <div id="maindiv" style="display: block;">
                <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                  <!-- Your form content goes here -->
                  <div class="display" style="display: flex; flex-direction: row; width:100%;">
                    <!-- first div -->
                    <div class="mb-3" style="width: 50%; margin:20px;">
                      <label for="customername" class="form-label">Anonymous:</label>
                      <div class="opt d-flex flex-row ">
                        <div class="form-check me-3 align-items-center">
                          <label class="form-check-label" for="databasefield0">&nbsp;
                            <input class="form-check-input" type="radio" name="anonymous" id="databasefield0" value="yes">
                            Yes</label>
                        </div>
                        <div class="form-check me-3 align-items-center">

                          <label class="form-check-label" for="databasefield1"><input class="form-check-input"
                              type="radio" name="anonymous" id="databasefield1" value="no" checked>No</label>
                        </div>
                      </div>
                      <label for="customername" class="form-label">Registered Name:</label>
                      <input name="customername" type="text" class="form-control" id="customername" size="20"
                        autocomplete="off" isdatepicker="true">
                      <input type="hidden" name="lastslno" id="lastslno" value="" />
                      <input type="hidden" name="cusid" id="cusid" value="" />
                      <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                      <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                      <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                        value="<?php echo ($reportingauthority); ?>" />
                      <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                        value="<?php echo (datetimelocal('d-m-Y')); ?>" /></td>



                      <label for="customername" class="form-label">Cusomer ID:</label>
                      <input name="customerid" type="text" class="form-control" id="customerid" size="20"
                        autocomplete="off" isdatepicker="true">
                      <label for="customername" class="form-label">Date:</label>
                      <input name="date" type="text" class="form-control" id="date" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">Time:</label>
                      <input name="time" type="text" class="form-control" id="time" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">Category:</label>
                      <input name="category" type="text" class="form-control" id="category" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">State:</label>
                      <select name="state" class="form-select form-control" id="state" onchange="">
                        <?php include('../inc/state.php'); ?>

                      </select>
                      <label for="callertype" class="form-label">Caller Type:</label>
                      <input name="callertype" type="text" class="form-control" id="callertype" size="20"
                        autocomplete="off" isdatepicker="true">
                      <label for="customername" class="form-label">Person Name[if any]:</label>
                      <input name="personname" type="text" class="form-control" id="personname" size="20"
                        autocomplete="off" isdatepicker="true">

                      <label for="customername" class="form-label">Product group:</label>
                      <?php include('../inc/productgroup.php');
                      productname('productgroup', '');
                      ?>
                      <label for="customername" class="form-label">Product Name(Optional):</label>
                      <select name="productname" class="form-select swiftselect form-control" id="productname"
                        onchange="">
                        <option value="" selected="selected">
                          Make a Selection
                        </option>
                      </select>
                    </div>
                    <!-- second -->
                    <div class="mb-3 " style="width: 50%; margin:20px;">
                      <label for="customername" class="form-label">Product version:</label>
                      <select name="productversion" class="form-select swiftselect form-control" id="productversion"
                        onchange="">
                        <option value="" selected="selected">
                          Make a Selection
                        </option>
                      </select>




                      <label for="customername" class="form-label">Email ID:</label>
                      <input name="emailid" type="text" class="form-control" id="emailid" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">Subject:</label>
                      <input name="subject" type="text" class="form-control" id="subject" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">Problem:</label>
                      <input name="content" type="text" class="form-control" id="content" size="20" autocomplete="off"
                        isdatepicker="true">
                      <a href="javascript:void(0);" style="cursor:pointer"
                        onclick="getquestionfunc(); getquestion();"><img src="../images/get-problem.gif" width="22"
                          height="22" border="0" align="top" /></a>

                      <label for="customername" class="form-label">Error File:</label>
                      <input name="errorfile" type="file" class="form-control" id="errorfile" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">Status:</label>
                      <select name="status" class="form-select swiftselect form-control" id="status" onchange="">
                        <option value="" selected="selected">
                          Make a Selection
                        </option>
                        <option value="solved">Solved</option>
                        <option value="unsolved">Un Solved</option>
                        <option value="forwarded">Forwarded</option>
                        <option value="registration">Registration</option>
                      </select>
                      <label for="teamleaderremarks" class="form-label">Forworded To:</label>
                      <select name="forwardedto" class="form-select swiftselect form-control" id="forwardedto"
                        onchange="">
                        <option value="" selected="selected">
                          ALL
                        </option>
                        <?php include('../inc/useridselection.php'); ?>
                        <option value="others">Others</option>
                      </select>
                      <!-- second div -->
                      <label for="customername" class="form-label">Thanking Email:</label> <br>
                      <label class="form-check-label" for="flexCheckDefault">
                        <input class="form-check-input" type="checkbox" value="" id="thankingemail" name="thankingemail">
                        Check for Thaking email
                      </label> <br>
                      <label for="customername" class="form-label">Remarks:</label>
                      <input name="remarks" type="text" class="form-control" id="remarks" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">Entered By: </label>
                      <input name="userid" type="text" class="form-control" id="userid" size="20" autocomplete="off"
                        isdatepicker="true">
                      <label for="customername" class="form-label">Email Register ID:</label>
                      <input name="compliantid" type="text" class="form-control" id="compliantid" size="20"
                        autocomplete="off" isdatepicker="true">
                      <!-- <label for=""> Team Leader Remarks:</label> -->
                    </div>
                    <!-- Add more textarea fields as needed -->
                  </div>
                  <div class="text-end float-right flex">
                    <button name="new" type="reset" class="btn btn-secondary" id="new">New</button>
                    <button name="save" type="submit" class="btn btn-primary" id="save" value="save">
                      View</button>
                    <button name="delete" type="submit" class="btn btn-warning" id="delete">Delete<button>
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
        <td class="content-header">Email Register > Get Customer</td>
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
<?php } ?>