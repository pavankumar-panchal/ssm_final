<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>
  <!-- <link rel="stylesheet" type="text/css" href="../style/main.css"> -->
  <script language="javascript" src="../functions/receiptsregister.js" type="text/javascript"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <div id="contentdiv" style="display:block;">

    <div class="container mt-5">
      <div class="card" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);">
        <div class="card-header bg-light" style="cursor: pointer;" onclick="showhide('maindiv','toggleimg');">
          <span class="">Enter/Edit/View Details</span>
        </div>
        <div class="card-body" id="maindiv" style="display: block;">
          <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="registered-name" class="form-label">Registered Name:</label>
                <input name="customername" type="text" class="form-control" id="customername" autocomplete="off">
                <a href="javascript:void(0);"
                  onClick="getinvoiceregister(); getcustomerfunc();registernameload('receipt')" style="cursor:pointer">
                  select here</a>
                <input type="hidden" name="lastslno" id="lastslno" value="" />
                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                  value="<?php echo ($reportingauthority); ?>" />
                <input type="hidden" name="hiddenserverdate" id="hiddenserverdate"
                  value="<?php echo (datetimelocal('d-m-Y')); ?>" />
              </div>
              <div class="col-md-6">
                <label for="customerid" class="form-label">Customer Id:</label>
                <input name="customerid" type="text" class="form-control" id="customerid" autocomplete="off">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="billno" class="form-label">Bill Number:</label>
                <input name="billno" type="text" class="form-control" id="billno" autocomplete="off">
              </div>
              <div class="col-md-6">
                <label for="billdate" class="form-label">Bill Date:</label>
                <input name="billdate" type="date" class="form-control" id="billdate">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="date" class="form-label">Date:</label>
                <input name="date" type="text" class="form-control" id="date" value="<?php echo ($localdate); ?>">
              </div>
              <div class="col-md-6">
                <label for="time" class="form-label">Time:</label>
                <input name="time" type="text" class="form-control" id="time" value="<?php echo ($localtime); ?>">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="receiptno" class="form-label">Receipt Number:</label>
                <input name="receiptno" type="text" class="form-control" id="receiptno" autocomplete="off">
              </div>
              <div class="col-md-6">
                <label for="receiptdate" class="form-label">Receipt Date:</label>
                <input name="receiptdate" type="date" class="form-control" id="DPC_receiptdate">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="baid-by" class="form-label">Paid By:</label>
                <select name="cheque_cash" class="form-select form-control" id="cheque_cash">
                  <option value="Cash" selected>Cash</option>
                  <option value="Cheque">Cheque</option>
                  <!-- Add other options here -->
                </select>
              </div>
              <div class="col-md-6">
                <label for="chequeno" class="form-label">Cheque Number:</label>
                <input name="chequeno" type="text" class="form-control" id="chequeno" autocomplete="off">
              </div>
              <div class="col-md-6">
                <label for="amount" class="form-label">Amount:</label>
                <input name="amount" type="text" class="form-control" id="amount" autocomplete="off">
              </div>
              <div class="col-md-6">
                <label for="userid" class="form-label">User ID:</label>
                <input name="userid" type="text" class="form-control swifttext" id="userid" autocomplete="off"
                  value="<?php echo ($loggedusername); ?>">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="remarks" class="form-label">Remarks:</label>
                <textarea name="remarks" cols="45" class="form-control" id="remarks" data-gramm="false"
                  wt-ignore-input="true"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="text-end float-right">
                  <div id="form-error"></div>
                  <button name="new" type="reset" class="btn btn-secondary" id="new"
                    onclick="newentry();clearinnerhtml();gettime(); ">New</button>
                  <button name="save" type="submit" class="btn btn-primary" id="save"
                    onclick="formsubmit('save');">Save</button>
                  <button name="delete" type="submit" class="btn btn-danger" id="delete" onclick="formsubmit('delete');"
                    disabled> Delete</button>
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
      <!-- <tr>
        <td class="content-header" style="position:relative; bottom: 580px;">Call Register > Get Customer</td>
      </tr> -->
      <tr>
        <td>
          <div id="gc-form-error"></div>
        </td>
      </tr>
      <?php include('../inc/receiptsregisterload.php'); ?>
    </table>
  </div>


  <div id="questionload" style="display:none;">
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td class="content-header">Receipts > Get Invoice</td>
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