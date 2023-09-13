<?php
if (!isset($_POST['fullname'])) {
  $_POST['fullname'] = null;
}
if (!isset($_POST['presentaddress'])) {
  $_POST['presentaddress'] = null;
}
if (!isset($_POST['permanentaddress'])) {
  $_POST['permanentaddress'] = null;
}
if (!isset($_POST['emergencynumber'])) {
  $_POST['emergencynumber'] = null;
}
if (!isset($_POST['emergencyremarks'])) {
  $_POST['emergencyremarks'] = null;
}
if (!isset($_POST['dob'])) {
  $_POST['dob'] = null;
}
if (!isset($_POST['doj'])) {
  $_POST['doj'] = null;
}
if (!isset($_POST['designation'])) {
  $_POST['designation'] = null;
}
if (!isset($_POST['personalemail'])) {
  $_POST['personalemail'] = null;
}
if (!isset($_POST['officialemail'])) {
  $_POST['officialemail'] = null;
}
if (!isset($_POST['mobile'])) {
  $_POST['mobile'] = null;
}
if (!isset($_POST['gender'])) {
  $_POST['gender'] = null;
}
if (!isset($message)) {
  $message = null;
}


$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$presentaddress = $_POST['presentaddress'];
$permanentaddress = $_POST['permanentaddress'];
$mobile = $_POST['mobile'];
$emergencynumber = $_POST['emergencynumber'];
$emergencyremarks = $_POST['emergencyremarks'];
$dob = $_POST['dob'];
$doj = $_POST['doj'];
$designation = $_POST['designation'];
$personalemail = $_POST['personalemail'];
$officialemail = $_POST['officialemail'];

$query = "SELECT * FROM ssm_users where slno = '" . $user . "'";
$fetch = runmysqlqueryfetch($query);

$d_fullname = $fetch['fullname'];
$d_gender = $fetch['gender'];
$d_presentaddress = $fetch['presentaddress'];
$d_permanentaddress = $fetch['permanentaddress'];
$d_mobile = $fetch['mobile'];
$d_emergencynumber = $fetch['emergencynumber'];
$d_emergencyremarks = $fetch['emergencyremarks'];
$d_dob = changedateformat($fetch['dob']);
$d_doj = changedateformat($fetch['doj']);
$d_designation = $fetch['designation'];
$d_personalemail = $fetch['personalemail'];
$d_officialemail = $fetch['officialemail'];

?>



<style>
  .form-group label {
    margin: 10px 0px 10px 0px;
  }

  .display {
    display: flex;
    flex-direction: row;
  }

  .up {
    display: flex;
    flex-direction: row;
    float: right;
    margin-right: 5px;
  }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container mt-4">
  <div class="card border " class="rounded" style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363);margin-top: 50px;">
    <div class="card-header bg-light" style="cursor: pointer;" onclick="showhide('maindiv', 'toggleimg');">
      View Profile
      <span class="float-right">
        <img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg" align="absmiddle" class="float-end">
      </span>
    </div>
    <div id="maindiv">
      <div class="card-body ">
        <div class="row ">
          <div class="col-md-6 ">
            <table class="table table-bordered ">
              <tbody>
                <tr>
                  <td><strong>User Name:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_fullname); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Gender:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_gender); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Mobile:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_mobile); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Designation:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_designation); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Date of Birth:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_dob); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Present Address:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_presentaddress); ?>
                    </font>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-bordered ">
              <tbody>
                <tr>
                  <td><strong>Permanent Address:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_permanentaddress); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Date of joining:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_doj); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Personal Email:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_personalemail); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Official Email:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_officialemail); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Contact Number [In case of Emergency]:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_emergencynumber); ?>
                    </font>
                  </td>
                </tr>
                <tr>
                  <td><strong>Emergency Remarks:</strong></td>
                  <td>
                    <font color="#FF6200">
                      <?php echo ($d_emergencyremarks); ?>
                    </font>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">














  
  