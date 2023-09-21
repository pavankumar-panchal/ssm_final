<?php
if ($usertype == 'GUEST')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
  <script language="javascript" src="../functions/versionmaster.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>















  <div class="container mt-4">
    <div class="card">
      <div class="card-header bg-light " style="cursor:pointer" onclick="showhide('maindiv','toggleimg');">
        <div class="d-flex justify-content-between align-items-center">
          <span class="header-line pl-3">Enter / Edit / View Details</span>
          <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" class="img-fluid"
            style="max-height: 20px;" align="absmiddle">
        </div>
      </div>
      <div class="card-body" id="maindiv" style="display: block;">
        <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
          <div class="row">
            <div class="col-md-6 border-right">
              <div class="form-group">
                <label for="">Product group:</label>


                <span id="filterprdgroupdisplay">
                  <?php include('../inc/productgroup.php');
                  productname('s_productgroup', ''); ?>
                  <!-- Details are in javascript.js page as a function prdgroup();-->
                </span>

                <!-- Details are in javascript.js page as a function prdgroup(); -->
              </div>
              <div class="form-group">
                <label for="productname">Product Name:</label>
                <select name="productname" class="form-control swiftselect" id="productname">
                  <option value="" selected="">Make A Selection</option>
                  <?php include('../inc/productfilter.php'); ?>

                </select>
                <input type="hidden" name="lastslno" id="lastslno" value="">
                <input type="hidden" name="loggeduser" id="loggeduser" value="1">
                <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />

                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                  value="<?php echo ($reportingauthority); ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="productversion">Product Version:</label>
                <input name="productversion" type="text" class="form-control " id="productversion" size="30"
                  isdatepicker="true">
              </div>
              <div class="form-group">
                <label for="releasedate">Release Date:</label>
                <div class="input-group">
                  <input name="releasedate" type="text" class="form-control " id="DPC_releasedate" size="30"
                    datepicker_format="DD-MM-YYYY" maxlength="10" isdatepicker="true">

                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-3 float-end">
            <div id="form-error"></div>
            <input name="new" type="reset" class="btn btn-secondary" id="new" value="New">
            <input name="save" type="submit" class="btn btn-primary" users="" id="save" value="Save"
              onclick="formsubmit('save')" <?php if ($usertype <> 'ADMIN' && $usertype <> 'MANAGEMENT' && $usertype <> 'TEAMLEADER') {
                $class = ''; ?> disabled="disabled" <?php } else {
                $class = ''; ?>   <?php } ?>
              class="<?php echo ($class); ?>" users id="save" value="Save" onclick="formsubmit('save')">
            <input name="delete" type="submit" class="btn btn-danger" id="delete" value="Delete"
              onclick="formsubmit('delete')" disabled>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="container mt-4">
    <div class="row">
      <div class="col-md-3">
        <div class="flex-column">
          <a class="" id="tabgroupgridh1" onclick="gridtab2('1','tabgroupgrid');" style="cursor:pointer">
            Default
          </a>
          <a class="" id="tabgroupgridh2" onclick="gridtab2('2','tabgroupgrid');" style="cursor:pointer">
            Filter
          </a>
        </div>
      </div>
      <div class="col-md-9">
        <span id="tabgroupgridwb1"></span><span id="tabgroupgridwb2"></span>
      </div>
    </div>
  </div>



  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card border">
          <div class="card-header">
            View Records :
            &nbsp; &nbsp;
          </div>


          <div class="card-body">
            <div id="tabgroupgridc1" style="overflow:auto; max-height: 300px;">
              <!-- Your record content here -->
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
            <div id="tabgroupgridc2" style="overflow:auto; max-height: 300px; display: ;">
              <!-- Filtered records content here -->
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
            <div id="regresultgrid" style="overflow:auto; display: none; max-height: 300px;">
              <!-- Result content here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php } ?>