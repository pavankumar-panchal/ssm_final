<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if ($usertype <> 'TEAMLEADER' && $usertype <> 'MANAGEMENT' && $usertype <> 'ADMIN')
  header("location:../index.php");

$fetch = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_callregister WHERE authorized = 'no' ORDER BY slno;");
$calls = $fetch['count'];
$fetch1 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_emailregister WHERE authorized = 'no' ORDER BY slno;");
$emails = $fetch1['count'];
$fetch2 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_errorregister WHERE authorized = 'no' ORDER BY slno;");
$errors = $fetch2['count'];
$fetch3 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_inhouseregister WHERE authorized = 'no' ORDER BY slno;");
$inhouse = $fetch3['count'];
$fetch4 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_onsiteregister WHERE authorized = 'no' ORDER BY slno;");
$onsite = $fetch4['count'];
$fetch5 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_referenceregister WHERE authorized = 'no' ORDER BY slno;");
$references = $fetch5['count'];
$fetch6 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_requirementregister WHERE authorized = 'no' ORDER BY slno;");
$requirements = $fetch6['count'];
$fetch7 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_skyperegister WHERE authorized = 'no' ORDER BY slno;");
$skype = $fetch7['count'];
$fetch8 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_invoice WHERE authorized = 'no' ORDER BY slno;");
$invoices = $fetch8['count'];
$fetch9 = runmysqlqueryfetch("SELECT COUNT(*) AS count FROM ssm_receipts WHERE authorized = 'no' ORDER BY slno;");
$receipts = $fetch9['count'];

$total = $calls + $emails + $errors + $inhouse + $onsite + $references + $requirements + $skype + $invoices + $receipts;
?>
<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<script language="javascript" src="../functions/recordauthorization.js?dummy = <?php echo (rand()); ?>"
  type="text/javascript"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<div class="container l-12">
  <table class="table table-bordered"
    style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363); margin-top:50px; border-radius:10px; width: 98%; margin-left: 10px; ">
    <thead style="border-radius:10px;">
      <tr style="cursor:pointer; border-radius:10px;" onclick="showhide('pendingauthorization','toggleimg');">
        <th class="card-header bg-light" colspan="2">
          &nbsp;&nbsp;Authorization Summary - You have <strong>
            <?php echo ($total); ?>
          </strong> Records Pending for Authorization

        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td width="50%">
          <table class="table">
            <tbody>
              <tr class="bg-white">

                <td valign="top">Calls:</td>
                <td valign="top">
                  <?php echo ($calls); ?>

                </td>
              </tr>

              <tr class="bg-white">

                <td valign="top">Emails:</td>
                <td valign="top">
                  <?php echo ($emails); ?>

                </td>
              </tr>

              <tr class="bg-white">

                <td valign="top">Errors:</td>
                <td valign="top">
                  <?php echo ($errors); ?>

                </td>
              </tr>

              <tr class="bg-white">

                <td valign="top">Inhouse:</td>
                <td valign="top">
                  <?php echo ($inhouse); ?>

                </td>
              </tr>

              <tr class="bg-white">

                <td valign="top">Onsite:</td>
                <td valign="top">
                  <?php echo ($onsite); ?>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
        <td width="50%">
          <table class="table">
            <tbody>
              <tr class="bg-white">
                <td valign="top">Reference:</td>
                <td valign="top">
                  <?php echo ($references); ?>

                </td>
              </tr>
              <tr class="bg-white">
                <td valign="top">Requirement:</td>
                <td valign="top">
                  <?php echo ($requirements); ?>

                </td>
              </tr>
              <tr class="bg-white">
                <td valign="top">Skype:</td>
                <td valign="top">
                  <?php echo ($skype); ?>


                </td>
              </tr>
              <tr class="bg-white">
                <td valign="top">Invoice:</td>
                <td valign="top">
                  <?php echo ($invoices); ?>

                </td>
              </tr>
              <tr class="bg-white">
                <td valign="top">Receipts:</td>
                <td valign="top">
                  <?php echo ($receipts); ?>

                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- second form  -->
  <div class="container">
    <div class="card mt-4" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363); border-radius: 10px;">
      <div class="card-header bg-light" style="cursor:pointer;">
        <h6 class="m-0">Enter / Edit / View Details</h6>
      </div>
      <div class="card-body">
        <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
          <div class="form-group text-center mb-4 mt-4 ">
            <div id="displayregisters">
              <h6 class="">Make A Selection of record from the grid below</h6>
            </div>
          </div>
          <hr>
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="form-group mt-4">
                <label for="authorizedgroup">Category:</label>
                <select name="authorizedgroup" id="authorizedgroup" class="form-select ">
                  <option value="" selected="selected">Make a selection</option>
                  <?php
                  include('../inc/authorizinggroup.php');
                  ?>
                </select>
              </div>

              <div class="form-group mt-4">
                <label for="authorizedgroup">Authorized:</label>
                <div class="opt d-flex flex-row">
                  <div class="form-check me-3 align-items-center">
                    <label class="form-check-label" for="authorizedatabasefield0">
                      <input class="form-check-input" type="radio" name="authorizedatabasefield"
                        id="authorizedatabasefield0" value="yes" checked="checked"> Yes</label>
                  </div>
                  <div class="form-check me-3 align-items-center">
                    <label class="form-check-label" for="authorizedatabasefield1">
                      <input class="form-check-input" type="radio" name="authorizedatabasefield"
                        id="authorizedatabasefield1" value="no"> No</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mt-4">
              <div class="form-group">
                <label>Flag the Entry:</label>
                <div class="opt d-flex flex-row">
                  <div class="form-check me-3 align-items-center">

                    <label class="form-check-label" for="flagdatabasefield0">
                      <input class="form-check-input" type="radio" name="flagdatabasefield" id="flagdatabasefield0"
                        value="yes" checked>Yes</label>
                  </div>
                  <div class="form-check me-3 align-items-center">

                    <label class="form-check-label" for="flagdatabasefield1">
                      <input class="form-check-input" type="radio" name="flagdatabasefield" id="flagdatabasefield1"
                        value="no"> No</label>
                  </div>
                </div>
              </div>

              <div class="form-group mt-4">
                <label>Publish:</label>
                <div class="opt d-flex flex-row mt-2">
                  <div class="form-check me-3 align-items-center">

                    <label class="form-check-label" for="publishdatabasefield0">
                      <input class="form-check-input" type="radio" name="publishdatabaseefield"
                        id="publishdatabasefield0" value="yes"> Yes</label>
                  </div>
                  <div class="form-check me-3 align-items-center">

                    <label class="form-check-label" for="publishdatabasefield2">
                      <input class="form-check-input" type="radio" name="publishdatabaseefield"
                        id="publishdatabasefield2" value="no" checked="checked"> No</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group mt-4">
            <label for="teamleaderremarks" class="float-start">Remarks:</label>
            <textarea name="teamleaderremarks" cols="45" class="form-control" id="teamleaderremarks" data-gramm="false"
              wt-ignore-input="true"></textarea>
            <input type="hidden" name="lastslno" id="lastslno" value="">
            <input type="hidden" name="registervalue" id="registervalue" value="">
          </div>
          <div class="form-group">
            <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>">
            <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>">
            <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
              value="<?php echo ($reportingauthoritytype); ?>">
          </div>
          <div class="form-group text-end mt-4">
            <div id="form-error"></div>
            <input name="save" type="submit" class="btn btn-primary " id="save" value="Save"
              onclick="formsubmit('save')">
            <input name="new" type="reset" class="btn btn-secondary " id="new" value="Clear"
              onclick="clearinnerhtml();">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="container mt-5">
  <div class="row">
    <div class="col-md-3 ">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active " id="tabgroupgridh1" hr onclick="gridtab2('1','tabgroupgrid');">Default-Calls</a>
        </li>
      </ul>
    </div>
    <div class="col-md-9">
      <span id="tabgroupgridwb1"></span>
      <span id="tabgroupgridwb2"></span>
    </div>
  </div>
</div>

<div class="container mt-3">
  <div class="card ">
    <div class="card-header">
      View Records:
    </div>
    <div class="card-body">
      <div id="tabgroupgridc1" class="overflow-auto" style="height: 400px;">
        <!-- Your content here -->
      </div>
      <div id="tabgroupgridc2" class="overflow-auto" style="height: 400px; display: none;">
        No records to be displayed. Please filter the records from the filter form.
      </div>
    </div>
  </div>
</div>