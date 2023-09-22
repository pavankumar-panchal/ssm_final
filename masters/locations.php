<?php
if ($usertype <> 'TEAMLEADER' && $usertype <> 'ADMIN' && $usertype <> 'MANAGEMENT')
  header("location:../index.php");
else {
  ?>
  <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
  <script language="javascript" src="../functions/locationmaster.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>


  <div class="container mt-4 ">
    <div class="card border-light" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363); margin-top: 50px;">
      <div class="card-header bg-light " style="cursor:pointer" onclick="showhide('maindiv','toggleimg');">
        <div class="d-flex justify-content-between align-items-center">
          <span class=" pl-3">Enter / Edit / View Details</span>
          <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" class="img-fluid"
            style="max-height: 20px;" align="absmiddle">
        </div>
      </div>
      <div class="card-body" id="maindiv" style="display: block;">
        <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
          <div class="row">
            <div class="col-md-6 border-right">
              <div class="form-group">
                <label for="dealername">location Name:</label>
                <input name="locationname" type="text" class="form-control" id="locationname" size="30"
                  isdatepicker="true">
                <input type="hidden" name="lastslno" id="lastslno" value="" />
                <input type="hidden" name="loggeduser" id="loggeduser" value="<?php echo ($user); ?>" />
                <input type="hidden" name="loggedusertype" id="loggedusertype" value="<?php echo ($usertype); ?>" />
                <input type="hidden" name="loggedreportingauthority" id="loggedreportingauthority"
                  value="<?php echo ($reportingauthority); ?>" />


              </div>
              <div class="form-group">
                <label for="businessname">Business Name:</label>
                <input name="businessname" type="text" class="form-control" id="businessname" size="30"
                  isdatepicker="true">

              </div>

              <div class="form-group">
                <label for="address">Address:</label>
                <input name="address" type="text" class="form-control" id="address" size="30" isdatepicker="true">
              </div>
              <div class="form-group">
                <label for="place">Place:</label>
                <input name="place" type="text" class="form-control" id="place" size="30" isdatepicker="true">
              </div>
              <div class="form-group">
                <label for="district">District:</label>
                <input name="district" type="text" class="form-control" id="district" size="30" isdatepicker="true">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="state">State:</label>
                <input name="state" type="text" class="form-control" id="state" size="30" isdatepicker="true">
              </div>
              <div class="form-group">
                <label for="phone">phone:</label>
                <input name="phone" type="text" class="form-control" id="phone" size="30" isdatepicker="true">
              </div>
              <div class="form-group">
                <label for="emailid">Email ID:</label>
                <input name="emailid" type="text" class="form-control" id="emailid" size="30" isdatepicker="true">
              </div>
              <div class="form-group">
                <label for="locationincharge">Location Incharge:</label>
                <input name="locationincharge" type="text" class="form-control" id="locationincharge" size="30"
                  isdatepicker="true">
              </div>

            </div>
          </div>
          <div class="text-center mt-3 float-end">
            <div id="form-error"></div>
            <input name="new" type="reset" class="btn btn-secondary" id="new" value="New">
            <input name="save" type="submit" class="btn btn-primary" id="save" value="Save" onclick="formsubmit('save')">
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



