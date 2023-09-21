<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
  <script language="javascript" src="../functions/productmaster.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td class="content-header">Masters > Products</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td style="padding:0">



        <div class="container mt-4">
          <div class="card ">
            <div class="card-header bg-light" style="cursor:pointer" onclick="showhide('maindiv','toggleimg');">
              <div class="d-flex justify-content-between align-items-center">
                <span class="header-line pl-3">&nbsp;&nbsp;Enter / Edit / View Details</span>
                <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" class="img-fluid"
                  style="max-height: 20px;" align="absmiddle">
              </div>
            </div>
            <div class="card-body" id="maindiv" style="display: block;">
              <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                <div class="row">
                  <div class="col-md-6 border-right">
                    <div class="form-group">
                      <label for="productname">Product Name:</label>
                      <input name="productname" type="text" class="form-control " id="productname" size="30"
                        isdatepicker="true">
                      <input type="hidden" name="lastslno" id="lastslno" value="">
                      <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>">
                      <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>">
                      <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                        value="<?php echo ($reportingauthority); ?>" />
                    </div>
                    <div class="form-group">
                      <label for="shortformat">Product Short Format:</label>
                      <input name="shortformat" type="text" class="form-control " id="shortformat" size="30"
                        isdatepicker="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="prdgroupspan">Product Group:</label>
                      <span id="prdgroupspan">
                        <span id="prdgroupspan">
                          <?php include('../inc/productgroup.php');
                          productname('productgroup', '');
                          ?>
                          <!-- Details are in javascript.js page as a  function prdgroup();-->
                        </span>
                        <!-- Details are in javascript.js page as a function prdgroup(); -->
                      </span>
                    </div>
                    <div class="form-group ">
                      <label for="productinuse">Is Product in Use:</label>
                      <select name="productinuse" class="form-control swiftselect form-select" id="productinuse">
                        <option value="yes" selected="selected">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="text-center float-end mt-3">
                  <div id="form-error"></div>
                  <input name="new" type="reset" class="btn btn-secondary " id="new" value="New">
                  <input name="save" type="submit" id="save" class="btn btn-primary " value="Save"
                    onclick="formsubmit('save')" <?php if ($usertype <> 'ADMIN' && $usertype <> 'MANAGEMENT' && $usertype <> 'TEAMLEADER') {
                      $class = 'swiftchoicebuttondisabled'; ?> disabled="disabled" <?php } else {
                      $class = 'swiftchoicebutton'; ?>   <?php } ?> class="<?php echo ($class); ?>"
                    onclick="formsubmit('save')">
                  <input name="delete" type="submit" class="btn btn-danger " id="delete" value="Delete"
                    onclick="formsubmit('delete')" disabled="disabled">
                </div>
              </form>
            </div>
          </div>
        </div>





        <div class="container mt-4">
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex flex-column">
                <div class="p-2" id="tabgroupgridh1" onclick="gridtab2('1','tabgroupgrid');" style="cursor:pointer">
                  Default
                </div>
                <div class="p-2" id="tabgroupgridh2" onclick="gridtab2('2','tabgroupgrid');" style="cursor:pointer">
                  Filter
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="border ">
                <div class="row">
                  <div class="col-md-2">View Records:  <p id="tabgroupgridwb1"></p><p id="tabgroupgridwb2"></p></div>
                  <div class="col-md-10"></div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="exist text-center">Product In USE</div>
                    <div class="yes category"></div>
                    <div class="text-center">NO</div>
                  </div>
                  <div class="col-md-4">
                    <div id="tabgroupgridc1" class="overflow-auto" style="height: 300px;">
                      <div id="tabgroupgridc1_2"></div>
                      <div id="tabgroupgridc1link1" class="mt-2"></div>
                    </div>
                    <div id="tabgroupgridc2" class="overflow-auto mt-2" style="height: 300px; display: none;">
                      <div id="tabgroupgridc1_1"></div>
                      <div id="tabgroupgridc1link" class="mt-2"></div>
                    </div>
                    <div id="regresultgrid" class="overflow-auto mt-2" style="height: 300px; display: none;">&nbsp;</div>
                  </div>
                  <div class="col-md-4">
                    <div class="text-center">GROUP</div>
                    <div class="taxation category"></div>
                    <div class="text-center">TAXATION</div>
                    <div class="accounts category"></div>
                    <div class="text-center">ACCOUNTS</div>
                    <div class="payroll category"></div>
                    <div class="text-center">PAYROLL</div>
                    <div class="others category"></div>
                    <div class="text-center">OTHERS</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>





      <?php } ?>