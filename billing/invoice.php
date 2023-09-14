<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <script language="javascript" src="../functions/invoiceregister.js" type="text/javascript"></script>
  <script>
    $(document).ready(function () {
      //prdgroup();
    });
  </script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <div id="contentdiv" style="display:block;">

    <div class="container mt-5">
      <div class="card " style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
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
            <div class="row ">
              <div class="col-md-6 ">

                <div class="mb-3">
                  <label for="customername" class="form-label">Registered Name:</label>
                  <input name="customername" type="text" class="form-control" id="customername" autocomplete="off"
                    isdatepicker="true">
                  <span id="getcustomerlink" style="visibility:visible;"> <a href="javascript:void(0);"
                      onClick="getregisterdata(); getcustomerfunc();registernameload('invoice');" style="cursor:pointer">
                      <img src="../images/userid-bg.gif" width="14" height="16" border="0" align="absmiddle" /></a></span>
                  <input type="hidden" name="lastslno" id="lastslno" value="" />
                  <input type="hidden" name="cusid" id="cusid" value="" />
                  <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                  <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                  <input type="hidden" name="endtime" id="endtime" value="" />
                  <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                    value="<?php echo ($reportingauthority); ?>" />
                  <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                    value="<?php echo (datetimelocal('d-m-Y')); ?>" />

                </div>
                <div class="mb-3">
                  <label for="customerid" class="form-label">Customer Id:</label>
                  <input name="customerid" type="text" class="form-control" id="customerid" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="productgroup" class="form-label">product Group:</label>
                  <input name="productgroup" type="text" class="form-control" id="productgroup" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="productname" class="form-label">Product Name:</label>
                  <input name="productname" type="text" class="form-control" id="productname" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="productversion" class="form-label">Product Version:</label>
                  <input name="productversion" type="text" class="form-control" id="productversion" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="state" class="form-label">State:</label>
                  <select name="state" class="form-select swiftselect form-control" id="state" onchange="">
                    <?php include('../inc/state.php'); ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="billno" class="form-label">Bill Number:</label>
                  <input name="billno" type="text" class="form-control" id="billno" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="billdate" class="form-label">Bill Date:</label>
                  <input name="billdate" type="date" class="form-control" id="billdate" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="registername" class="form-label">Register Number:</label>
                  <input name="registername" type="text" class="form-control" id="registername" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="complaintid" class="form-label">Complaint ID:</label>
                  <input name="complaintid" type="text" class="form-control" id="complaintid" autocomplete="off"
                    isdatepicker="true">
                </div>
                <!-- Add more divs for other fields -->
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="date" class="form-label">Date:</label>
                  <input name="date" type="text" class="form-control" id="date" autocomplete="off" isdatepicker="true"
                    value="<?php echo ($localdate); ?>">
                </div>
                <div class="mb-3">
                  <label for="time" class="form-label">Time:</label>
                  <input name="time" type="text" class="form-control" id="time" autocomplete="off" isdatepicker="true"
                    value="<?php echo ($localtime); ?>">
                </div>

                <div class="mb-3">
                  <label for="billto" class="form-label">Bill Given To:</label>
                  <input name="billto" type="text" class="form-control" id="billto" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="billedby" class="form-label">Billed By:</label>
                  <select name="billedby" class="form-select swiftselect form-control" id="billedby" onchange="">
                    <option value="" selected="selected"> ALL</option>
                    <?php include('../inc/useridselection.php'); ?>

                  </select>
                </div>
                <div class="mb-3">
                  <label for="amount" class="form-label">Amount:</label>
                  <input name="amount" type="text" class="form-control" id="amount" autocomplete="off" isdatepicker="true"
                    onKeyPress="javascript:invoicetotalamount();" onChange="javascript:invoicetotalamount();">
                </div>
                <div class="mb-3">
                  <label for="tax" class="form-label">Tax Amount:</label>
                  <input name="tax" type="text" class="form-control" id="tax" autocomplete="off" isdatepicker="true"
                    onKeyPress="javascript:invoicetotalamount();" onChange="javascript:invoicetotalamount();">
                </div>
                <div class="mb-3">
                  <label for="tamount" class="form-label">Total Amount:</label>
                  <input name="tamount" type="text" class="form-control" id="tamount" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="remarks" class="form-label">Remarks:</label>
                  <input name="remarks" type="text" class="form-control" id="remarks" autocomplete="off"
                    isdatepicker="true">
                </div>
                <div class="mb-3">
                  <label for="userid" class="form-label">User ID:</label>
                  <input name="userid" type="text" class="form-control" id="userid" autocomplete="off" isdatepicker="true"
                    value="<?php echo ($loggedusername); ?>">
                </div>

                <!-- Add more divs for other fields -->
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div id="form-error"></div>
              </div>
              <div class="col-md-4 text-end">
                <button name="new" type="submit" class="btn btn-secondary" id="new"
                  onclick="newentry();clearinnerhtml();gettime(); ">New</button>
                <button name="save" type="submit" class="btn btn-primary" id="save"
                  onclick="formsubmit('save');">Save</button>
                <button name="delete" type="submit" class="btn btn-danger" id="delete"
                  onclick="formsubmit('delete');">Delete</button>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>






    <div class="container mt-5">
      <div class="row">
        <div class="col-8">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" id="tabgroupgridh1" href="" onclick="gridtab4('1','tabgroupgrid');">Default</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tabgroupgridh2" href="" onclick="gridtab4('2','tabgroupgrid');">Filter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tabgroupgridh3" href="" onclick="gridtab4('3','tabgroupgrid');">Flagged Entry</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tabgroupgridh4" href="" onclick="gridtab4('4','tabgroupgrid');">Customer</a>
            </li>
          </ul>
        </div>
        <div class="col-4">
          <span id="tabgroupgridwb1"></span>
          <span id="tabgroupgridwb2"></span>
          <span id="tabgroupgridwb3"></span>
          <span id="tabgroupgridwb4"></span>
        </div>
      </div>
    </div>

    <div class="container mt-3">
      <div class="card">
        <div class="card-header">
          View Records:
        </div>
        <div class="card-body">
          <div id="tabgroupgridc1" class="overflow-auto" style="height: 300px;">
            <div id="tabgroupgridc1_2"> </div>
            <div id="tabgroupgridc1link1" style="padding:2px;" align="left"> </div>
          </div>
          <div id="tabgroupgridc2" class="overflow-auto" style="height: 300px; display: none;">
            <div id="tabgroupgridc1_1"> </div>
            <div id="tabgroupgridc1link" style="padding:2px;" align="left"> </div>
          </div>
          <div id="regresultgrid" class="overflow-auto" style="height: 300px; display: none;">
            &nbsp;
          </div>
          <div id="tabgroupgridc3" class="overflow-auto" style="height: 300px; display: none">
            No records to be displayed. Please filter the records from the filter form.
          </div>
          <div id="tabgroupgridc4" class="overflow-auto" style="height: 300px; display: none">
            No records to be displayed. Please filter the records from the filter form.
          </div>
        </div>
      </div>
    </div>
  </div>



  <div id="nameloaddiv" style="display:none;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td class="content-header">Invoice > Get Onsite/Inhouse Records</td>
      </tr>
      <tr>
        <td>
          <div id="gc-form-error"></div>
        </td>
      </tr>
      <?php include('../inc/invoiceregisterload.php'); ?>
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
<?php } ?>