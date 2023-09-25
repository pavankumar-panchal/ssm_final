<link rel="stylesheet" type="text/css" href="../style/main.css?dummy = <?php echo (rand()); ?>">
<link media="screen" rel="stylesheet" href="../style/colorbox.css?dummy=<?php echo (rand()); ?>" />
<script language="javascript" src="../functions/colorbox.js?dummy=<?php echo (rand()); ?>"></script>
<script language="javascript" src="../functions/customer.js?dummy = <?php echo (rand()); ?>"
    type="text/javascript"></script>
<script language="javascript" src="../functions/getdistrictjs.php?dummy = <?php echo (rand()); ?>"></script>
<script language="javascript" src="../functions/getdistrictfunction.php?dummy = <?php echo (rand()); ?>"></script>
<!--<script language="javascript" src="../functions/javascripts.php?dummy = <?php echo (rand()); ?>"></script>-->
<!--<script language="javascript" src="../functions/javascripts.js?dummy=<?php echo (rand()); ?>"></script>-->
<?php //$userid = $_COOKIE['userid'];
$userid = imaxgetcookie('ssmuserid'); ?>

<style>
    .slider {
        position: fixed;
        top: 0;
        right: -100%;
        width: 50%;
        height: 100%;
        /* margin-top: 120px; */
        z-index: 9999;
        background-color: #f2f2f2;
        transition: right 0.3s ease-in-out;
    }

    .show-slider {
        right: 0;
    }

    .close-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        color: #333;
        transition: color 0.2s ease-in-out;
    }

    .close-icon:hover {
        color: #ff0000;
    }

    label {
        margin: 10px 0px 10px 0px;
    }
</style>

<div class="container mt-5" style="z-index:0;">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>General Details</div>
        </div>
        <div class="card-body " style="padding:0px -10px 0px -10px;">
            <div class="container" style="z-index:9999;">
                <div class="row ">
                    <div class="col-md-13">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="businessName">Business Name[Company]:</label>
                                        <input name="businessname" type="text" class="form-control" id="businessname"
                                            maxlength="200" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="businessName">Address:</label>
                                        <input name="address" type="text" class="form-control" id="address"
                                            maxlength="200" autocomplete="off">
                                    </div>
                                    <!-- Add other form groups here -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="place">Place:</label>
                                        <input name="place" type="text" class="form-control" id="place" maxlength="100"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State:</label>
                                        <select name="state" class="form-control form-select" id="state"
                                            onchange="getdistrict('districtcodedisplay',this.value);"
                                            onkeyup="getdistrict('districtcodedisplay',this.value);">
                                            <option value="">Select A State
                                            </option>
                                            <?php include('../inc/state.php'); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="place">District:</label>
                                        <select name="district" class="form-control form-select" id="district">
                                            <option value="">Select A State</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">Pin Code:</label>
                                        <input name="pincode" type="text" class="form-control" id="pincode"
                                            maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="state">STD Code:</label>
                                        <input name="stdcode" type="text" class="form-control" id="stdcode"
                                            maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="state">Fax Code:</label>
                                        <input name="fax" type="text" class="form-control" id="fax" maxlength="100"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="state">Website:</label>
                                        <input name="website" type="text" class="form-control" id="website"
                                            maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="place">Type:</label>
                                        <select name="type" class="form-control form-select" id="type">
                                            <option value="">Select A State</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="place">Category:</label>
                                        <select name="category" class="form-control form-select" id="category">
                                            <option value="">Category
                                                Selection</option>
                                            <?php
                                            include('../inc/businesscategory.php');
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">Region:</label>
                                        <input name="region" type="text" class="form-control" id="region"
                                            maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="state">Branch:</label>
                                        <input name="branch" type="text" class="form-control" id="branch"
                                            maxlength="100" autocomplete="off">
                                    </div>

                                    <!-- Add other form groups here -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="remarks">Remarks:</label>
                                        <input name="remarks" type="text" class="form-control" id="remarks"
                                            maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerID">Customer ID:</label>
                                        <input name="customerid" type="text" class="form-control" id="customerid"
                                            maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastpassword">Last Password:</label>
                                        <span id="initialpassworddfield" style="display:block">
                                            <input name="lastpassword" type="text" class="form-control"
                                                id="lastpassword" maxlength="100" autocomplete="off">
                                        </span>
                                        <span id="displayresetpwd" style="display:none">
                                            <input name="initialpassword" type="text" class="form-control"
                                                id="initialpassword" size="30" readonly="readonly"
                                                style="background:#FEFFE6; color:#FF0000;" autocomplete="off" />
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="customerID">Current Dealer:</label>
                                        <input name="currentdealer" type="text" class="form-control" id="currentdealer"
                                            maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerID">GSTIN:</label>
                                        <input name="gst_no" type="text" class="form-control" id="gst_no"
                                            maxlength="100" autocomplete="off">
                                        <span id="state_gst" style="visibility:hidden"></span>
                                    </div>
                                    <div class="form-check mb-2">
                                        <label class="form-check-label" for="companyclosed">
                                            <input class="form-check-input" type="checkbox" name="companyclosed"
                                                id="companyclosed" checked>
                                            Company Closed</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <label class="form-check-label" for="promotionalsms">
                                            <input class="form-check-input" type="checkbox" name="promotionalsms"
                                                id="promotionalsms">
                                            Promotional SMS</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <label class="form-check-label" for="promotionalemail">
                                            <input class="form-check-input" type="checkbox" name="promotionalemail"
                                                id="promotionalemail">
                                            Promotional
                                            Email</label>
                                    </div>

                                    <!-- Add other form groups here -->

                                    <div class="container mt-4">
                                        <div class="row" style="background-color: rgba(156, 156, 247, 0.377);">
                                            <div class="col-md-3 border-end">
                                                <!-- Empty column for spacing -->
                                            </div>
                                            <div class="col-md-3 border-end text-center  py-2">
                                                <strong>Bill</strong>
                                            </div>
                                            <div class="col-md-3 border-end text-center py-2">
                                                <strong>PIN</strong>
                                            </div>
                                            <div class="col-md-3 text-center py-2">
                                                <strong>Regn</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 border-end py-2">
                                                <strong>TDS</strong>
                                            </div>
                                            <div class="col-md-3 border-end py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3  py-2">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 border-end py-2">
                                                <strong>STO</strong>
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3  py-2">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 border-end  py-2">
                                                <strong>SPP</strong>
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3 border-end py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3  py-2">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 border-end  py-2">
                                                <strong>GST</strong>
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3  py-2">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 border-end  py-2">
                                                <strong>SAC</strong>
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3 border-end  py-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-3 py-2">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 float-right text-end">
                                    <button type="button" class="btn btn-primary float-right" id="save"
                                        onclick="formsubmit('save');">Save</button>
                                    <button class="btn  bg-secondary" id="showCustomer">Customer
                                        selections</button>

                                    <button class="btn btn-warning" id="showAdvanced">Advanced
                                        selections</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="slider" id="customerSlider">
        <div class="close-icon" id="closeCustomerSlider">X</div>
        <!-- Customer Selection Content goes here -->
        <div class="div1 mt-5"> <!-- 1 -->
            <div class="container mt-12">
                <div class="row">
                    <div class="col">
                        <div class="header-line pl-2" style="color:black; font-size:20px;">Customer Selection</div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">


                    <form id="filterform" name="filterform" method="post" action="" onsubmit="return false;">
    <div class="container">
        <div class="row">
        <div width="73%" height="34" id="customerselectionprocess" style="padding:0" class="mb-5" align="left"></div>
 <br>
            <div class="col-md-9">
                <div class="form-group">
                    <input name="detailsearchtext" type="text" class="form-control" id="detailsearchtext" size="27" onkeyup="customersearch(event);" autocomplete="off" />
                    <span style="display:none">
                  
                    <input name="searchtextid" type="hidden" id="searchtextid"  disabled="disabled"/>
                    </span>
                  </div>
                <div id="detailloadcustomerlist">
                    <select name="customerlist" size="5" class="form-control" id="customerlist" style="width:100%; height:400px;" onclick="selectfromlist();" onchange="selectfromlist();">
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-right">
                    <a id="refreshcustomer" onclick="refreshcustomerarray();" style="cursor:pointer;">
                        <img src="../images/imax-customer-refresh.jpg" alt="Refresh customer" border="0" title="Refresh customer Data" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>





                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <strong>Total Count:</strong>
                    </div>
                    <div class="col-6" id="totalcount"> </div>
                </div>
            </div> <!--  -->
        </div>
    </div>


    <div class="slider" id="advancedSlider">
        <div class="close-icon" id="closeAdvancedSlider">X</div>
        <!-- Advanced Selection Content goes here -->
        <div class="container " style="overflow-y:auto;height: 100vh;">
            <div class="row">
                <div class=" ">
                    <div class="rounded p-4 " style="width: 100%;">
                        <h4 class="">Search Option</h4>
                        <form id="search-form">
                            <div class="row">
                                <div class="" style="width:43.8%;">
                                    <label for="searchcriteria" style="width: 100%;">
                                        Text:<input type="text" class="form-control" id="searchcriteria"
                                            name="searchcriteria" placeholder="Leave empty for all">
                                    </label>
                                </div>
                                <div class="whole"
                                    style="display: flex; flex-direction: row; justify-content: space-evenly;">
                                    <div class="first " style="  width: 80%;">
                                        <div class="container mt-3">
                                            <div class="row ">
                                                <div class="col-lg-8"
                                                    style="width: 100%; position: relative; right: 10px;">
                                                    <div class="border rounded p-4">
                                                        <h4 class="mb-4">Look in:</h4>
                                                        <form>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield0"
                                                                        value="slno">
                                                                    <label class="form-check-label"
                                                                        for="databasefield0">Customer
                                                                        ID</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield1"
                                                                        value="businessname" checked>
                                                                    <label class="form-check-label"
                                                                        for="databasefield1">Business
                                                                        Name</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield3"
                                                                        value="contactperson">
                                                                    <label class="form-check-label"
                                                                        for="databasefield3">Contact
                                                                        Person</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield5"
                                                                        value="place">
                                                                    <label class="form-check-label"
                                                                        for="databasefield5">Place</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield4"
                                                                        value="phone">
                                                                    <label class="form-check-label"
                                                                        for="databasefield4">Phone /
                                                                        Cell</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield6"
                                                                        value="emailid">
                                                                    <label class="form-check-label"
                                                                        for="databasefield6">Email</label>
                                                                </div>
                                                                <div class="divider mt-3"></div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield9"
                                                                        value="cardid">
                                                                    <label class="form-check-label"
                                                                        for="databasefield9">Card
                                                                        ID</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield7"
                                                                        value="scratchnumber">
                                                                    <label class="form-check-label"
                                                                        for="databasefield7">Pin
                                                                        No</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield11"
                                                                        value="billno">
                                                                    <label class="form-check-label"
                                                                        for="databasefield11">Bill
                                                                        No</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield8"
                                                                        value="computerid">
                                                                    <label class="form-check-label"
                                                                        for="databasefield8">Computer
                                                                        ID</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="databasefield" id="databasefield10"
                                                                        value="softkey">
                                                                    <label class="form-check-label"
                                                                        for="databasefield10">Softkey</label>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- Add more radio buttons here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    <!-- second -->
                                    <div class="second mt-5" style=" width: 100%; ">
                                        <div class="container " style="position: relative; bottom: 95px;">
                                            <div class="row">
                                                <div class="border float-right"
                                                    style="width:100%; border-radius: 10px; ">
                                                    <div class="rounded p-4">
                                                        <h4 class="">Selections:</h4>
                                                        <form>
                                                            <div class="">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label for="region2"
                                                                            class="form-label">Region:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select form-control"
                                                                            id="region2" name="region2">
                                                                            <option value="">ALL</option>
                                                                            <option value="1">BKG</option>
                                                                            <option value="2">CSD</option>
                                                                            <option value="3">BKM</option>
                                                                            <option value="4">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label for="state2"
                                                                            class="form-label">State:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class=" form-select form-control"
                                                                            id="state2" name="state2"
                                                                            onchange="getdistrictfilter('districtcodedisplaysearch',this.value);"
                                                                            onkeyup="getdistrictfilter('districtcodedisplaysearch',this.value);">
                                                                            <option value="">ALL</option>
                                                                            <option value="" selected="selected"
                                                                                id="data">
                                                                                ALL
                                                                            </option>
                                                                            <!-- Add more state options here -->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label for="region2"
                                                                            class="form-label">District:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select form-control"
                                                                            id="region2" name="region2">
                                                                            <option value="">ALL</option>
                                                                            <option value="1">BKG</option>
                                                                            <option value="2">CSD</option>
                                                                            <option value="3">BKM</option>
                                                                            <option value="4">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label for="region2"
                                                                            class="form-label">Dealer:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select" id="region2"
                                                                            name="region2">
                                                                            <option value="">ALL</option>
                                                                            <option value="1">BKG</option>
                                                                            <option value="2">CSD</option>
                                                                            <option value="3">BKM</option>
                                                                            <option value="4">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label for="region2"
                                                                            class="form-label">Beanch:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select" id="region2"
                                                                            name="region2">
                                                                            <option value="">ALL</option>
                                                                            <option value="1">BKG</option>
                                                                            <option value="2">CSD</option>
                                                                            <option value="3">BKM</option>
                                                                            <option value="4">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label for="region2"
                                                                            class="form-label">Type:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select" id="region2"
                                                                            name="region2">
                                                                            <option value="">ALL</option>
                                                                            <option value="1">BKG</option>
                                                                            <option value="2">CSD</option>
                                                                            <option value="3">BKM</option>
                                                                            <option value="4">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label for="region2"
                                                                            class="form-label">Category:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select class="form-select" id="region2"
                                                                            name="region2">
                                                                            <option value="">ALL</option>
                                                                            <option value="1">BKG</option>
                                                                            <option value="2">CSD</option>
                                                                            <option value="3">BKM</option>
                                                                            <option value="4">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- Add more rows for other options -->

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container " style="position: relative; bottom:;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Products:</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 border">
                                        <div style="height: 230px; overflow: auto;">
                                            <!-- Content for the product list goes here -->
                                            <div style="height:230px; overflow:scroll" align="left">
                                                <label><input type="checkbox" checked="checked" name="productarray[]"
                                                        id="Accounting Software" value="224">&nbsp;Accounting Software
                                                    <font color="#999999">&nbsp;(224)</font>
                                                </label><br><label><input type="checkbox" checked="checked"
                                                        name="productarray[]" id="Bug Tracer" value="765">&nbsp;Bug
                                                    Tracer<font color="#999999">
                                                        &nbsp;(765)</font></label><br><label><input type="checkbox"
                                                        checked="checked" name="productarray[]" id="Comptax"
                                                        value="182">&nbsp;Comptax<font color="#999999">&nbsp;(182)
                                                    </font>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-1">
                                        <input type="checkbox" checked="checked" name="selectall" id="selectall"
                                            value="selectall" onclick="selectdeselectall();">
                                    </div>
                                    <div class="col-md-11">
                                        <strong>
                                            <label for="selectall">Select All</label>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row mt-3 ">
                                    <div class="col-md-12  text-end">
                                        <button type="button" class="btn btn-primary" id="filter"
                                            onclick="searchcustomerarray();">Search</button>
                                        <button type="button" class="btn btn-secondary" name="reset_form"
                                            onclick="resetDefaultValues(this.form);">Reset</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-4 p-2 h-8 rounded-2"
        style="box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.363); width: 98%; height: 300px; overflow:auto;">
        <table class="table table-bordered">
            <thead class="bg-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Cell</th>
                    <th scope="col">Email Id</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="adddescriptionrows">
                <tr>
                    <td>1</td>
                    <td> <select name="selectiontype1" class="form-select">
                            <option value="" selected>--Select--</option>
                            <option value="ithead/edp">IT-Head/EDP</option>
                            <option value="general">General</option>
                            <option value="gm/director">GM/Director</option>
                            <option value="hrhead">HR Head</option>
                            <option value="softwareuser">Software User</option>
                            <option value="financehead">Finance Head</option>
                            <option value="others">Others</option>
                        </select> </td>
                    <td> <input name="name1" type="text" class="form-control" maxlength="130" autocomplete="off"> </td>
                    <td> <input name="phone1" type="text" class="form-control" maxlength="100" autocomplete="off"> </td>
                    <td> <input name="cell1" type="text" class="form-control" maxlength="10" autocomplete="off"> </td>
                    <td> <input name="emailid1" type="text" class="form-control" maxlength="200" autocomplete="off">
                    </td>
                    <td>
                        <font color="#FF0000"><strong><a class="removerow"
                                    style="cursor:pointer; text-decoration: none; color: red;"
                                    onclick="row()">X</a></strong></font><input type="hidden" name="contactslno1"
                            id="contactslno1">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-end mt-2"> <a onclick="adddescriptionrows();" style="cursor:pointer" class="r-text">Add one
                More
                >></a> </div>
    </div>
    <!-- Add the following script tag at the end of the body to include Bootstrap JS and custom JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script> let rowCounter = 1; function adddescriptionrows() { const tableBody = document.getElementById('adddescriptionrows'); const lastRow = tableBody.lastElementChild; const newRow = lastRow.cloneNode(true); rowCounter++; newRow.querySelector('td:first-child').innerText = rowCounter; const inputs = newRow.querySelectorAll('input'); const selectElement = newRow.querySelector('select'); selectElement.name = `selectiontype${rowCounter}`; selectElement.id = `selectiontype${rowCounter}`; inputs.forEach(input => { const inputName = input.name; input.name = inputName.replace(/\d+/, rowCounter); input.value = ''; }); const removeLink = newRow.querySelector('.removerow'); removeLink.addEventListener('click', () => { removedescriptionrows(newRow); }); tableBody.appendChild(newRow); } function row() { if (rowCounter == 1) { alert("Can't delete this row"); } } function removedescriptionrows(rowToRemove) { const tableBody = document.getElementById('adddescriptionrows'); tableBody.removeChild(rowToRemove); rowCounter--; const rows = tableBody.getElementsByTagName('tr'); for (let i = 0; i < rows.length; i++) { rows[i].getElementsByTagName('td')[0].innerText = i + 1; const inputs = rows[i].querySelectorAll('input'); const selectElement = rows[i].querySelector('select'); selectElement.name = `selectiontype${i + 1}`; selectElement.id = `selectiontype${i + 1}`; inputs.forEach(input => { const inputName = input.name; input.name = inputName.replace(/\d+/, i + 1); }); } } </script>
    <!--  -->
    <div class="col-md-12"> </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("showCustomer").addEventListener("click", function () {
        document.getElementById("customerSlider").classList.add("show-slider");
    });

    document.getElementById("closeCustomerSlider").addEventListener("click", function () {
        document.getElementById("customerSlider").classList.remove("show-slider");
    });

    document.getElementById("showAdvanced").addEventListener("click", function () {
        document.getElementById("advancedSlider").classList.add("show-slider");
    });

    document.getElementById("closeAdvancedSlider").addEventListener("click", function () {
        document.getElementById("advancedSlider").classList.remove("show-slider");
    });
</script>
