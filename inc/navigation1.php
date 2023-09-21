<?php if ($usertype == 'GUEST') { ?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="20" align="center" class="navigation">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" height="20">
          <tr>
            <td width="90" align="center" id="tabgroup1h1"
              onclick="navigationtab('1','tabgroup1','home-nav','home-nav-div-line','home-nav-sub-div'); SetCookie('navigationcookie','1|tabgroup1|home-nav|home-nav-div-line|home-nav-sub-div');"
              style="cursor:pointer">Home</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h2"
              onclick="navigationtab('2','tabgroup1','register-nav','register-nav-div-line','register-nav-sub-div'); SetCookie('navigationcookie','2|tabgroup1|register-nav|register-nav-div-line|register-nav-sub-div');"
              style="cursor:pointer">Registers</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h3"
              onclick="navigationtab('3','tabgroup1','profile-nav','profile-nav-div-line','profile-nav-sub-div'); SetCookie('navigationcookie','3|tabgroup1|profile-nav|profile-nav-div-line|profile-nav-sub-div'); "
              style="cursor:pointer">Profile</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h4"
              onclick="navigationtab('4','tabgroup1','website-nav','website-nav-div-line','website-nav-sub-div'); SetCookie('navigationcookie','4|tabgroup1|website-nav|website-nav-div-line|website-nav-sub-div'); "
              style="cursor:pointer">Websites</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="110" align="center" id="tabgroup1h5"
              onclick="navigationtab('5','tabgroup1','kb-nav','kb-nav-div-line','kb-nav-sub-div'); SetCookie('navigationcookie','5|tabgroup1|kb-nav|kb-nav-div-line|kb-nav-sub-div'); "
              style="cursor:pointer">Knowledge Base</td>
            <td align="center" class="navigation-menusep"></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="25" id="nav-sub-div">
        <div style="display:block;" id="tabgroup1t1"></div>
        <div style="display:block" id="tabgroup1c1">
          <a href="./index.php?a_link=home_dashboard">Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=home_setting">Settings</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=home_help">Help</a>
        </div>
        <div style="display:none" id="tabgroup1t2"></div>
        <div style="display:none" id="tabgroup1c2">
          <a href="./index.php?a_link=register_call">Calls</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_error">Errors</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_inhouse">In-house</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_onsite">Onsite</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_reference">References</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a
            href="./index.php?a_link=register_requirement">Requirements</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_skype">Skype</a>
        </div>
        <div style="display:none" id="tabgroup1t3"></div>
        <div style="display:none" id="tabgroup1c3">

          <a href="./index.php?a_link=profile_viewprofile">View
            Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;

          <a href="./index.php?a_link=profile_editprofile">Edit
            Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=profile_changepassword">Change Password</a>
        </div>
        <div style="display:none" id="tabgroup1t4"></div>
        <div style="display:none" id="tabgroup1c4">
          <a href="http://www.relyonsoft.com"
            target="_blank">Relyonsoft.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saraltds.com/"
            target="_blank">Saraltds.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saralvat.com"
            target="_blank">Saralvat.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saraltaxoffice.com/"
            target="_blank">Saraltaxoffice.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saralpaypack.com/"
            target="_blank">Saralpaypack.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saralaccounts.com/"
            target="_blank">Saralaccounts.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://saralxbrl.in/" target="_blank">Saralxbrl.in</a>|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://userlogin.relyonsoft.com/" target="_blank">Userlogin.relyonsoft.com</a>
        </div>
        <div style="display:none" id="tabgroup1t5"></div>
        <div style="display:none" id="tabgroup1c5">
          <a href="./index.php?a_link=kb_view">View KB</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=kb_add">Add Topics</a>
        </div>
      </td>
    </tr>
  </table>
<?php } else { ?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="20" align="center" class="navigation">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" height="20">
          <tr>
            <td width="90" align="center" id="tabgroup1h1"
              onclick="navigationtab('1','tabgroup1','home-nav','home-nav-div-line','home-nav-sub-div'); SetCookie('navigationcookie','1|tabgroup1|home-nav|home-nav-div-line|home-nav-sub-div');"
              style="cursor:pointer">Home</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h2"
              onclick="navigationtab('2','tabgroup1','register-nav','register-nav-div-line','register-nav-sub-div'); SetCookie('navigationcookie','2|tabgroup1|register-nav|register-nav-div-line|register-nav-sub-div');"
              style="cursor:pointer">Registers</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h3"
              onclick="navigationtab('3','tabgroup1','billing-nav','billing-nav-div-line','billing-nav-sub-div'); SetCookie('navigationcookie','3|tabgroup1|billing-nav|billing-nav-div-line|billing-nav-sub-div'); "
              style="cursor:pointer">Billing</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h4"
              onclick="navigationtab('4','tabgroup1','master-nav','master-nav-div-line','master-nav-sub-div'); SetCookie('navigationcookie','4|tabgroup1|master-nav|master-nav-div-line|master-nav-sub-div');"
              style="cursor:pointer">Masters</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h5"
              onclick="navigationtab('5','tabgroup1','profile-nav','profile-nav-div-line','profile-nav-sub-div'); SetCookie('navigationcookie','5|tabgroup1|profile-nav|profile-nav-div-line|profile-nav-sub-div'); "
              style="cursor:pointer">Profile</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="90" align="center" id="tabgroup1h6"
              onclick="navigationtab('6','tabgroup1','website-nav','website-nav-div-line','website-nav-sub-div'); SetCookie('navigationcookie','6|tabgroup1|website-nav|website-nav-div-line|website-nav-sub-div'); "
              style="cursor:pointer">Websites</td>
            <td align="center" class="navigation-menusep"></td>
            <td width="110" align="center" id="tabgroup1h7"
              onclick="navigationtab('7','tabgroup1','kb-nav','kb-nav-div-line','kb-nav-sub-div'); SetCookie('navigationcookie','7|tabgroup1|kb-nav|kb-nav-div-line|kb-nav-sub-div'); "
              style="cursor:pointer">Knowledge Base</td>
            <td align="center" class="navigation-menusep"></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="25" id="nav-sub-div">
        <div style="display:block;" id="tabgroup1t1"></div>
        <div style="display:block" id="tabgroup1c1">
          <a href="./index.php?a_link=home_dashboard">Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=home_setting">Settings</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=home_help">Help</a>
        </div>
        <div style="display:none" id="tabgroup1t2"></div>
        <div style="display:none" id="tabgroup1c2">
          <a href="./index.php?a_link=register_call">Calls</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_email">Emails</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_error">Errors</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_inhouse">In-house</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_onsite">Onsite</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_reference">References</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a
            href="./index.php?a_link=register_requirement">Requirements</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=register_skype">Skype</a>
        </div>
        <div style="display:none" id="tabgroup1t3"></div>
        <div style="display:none" id="tabgroup1c3">
          <a href="./index.php?a_link=billing_invoice">Invoices</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=billing_receipts">Receipts</a>
        </div>
        <div style="display:none" id="tabgroup1t4"></div>
        <div style="display:none" id="tabgroup1c4">
          <a href="./index.php?a_link=master_customer">Customer</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <?php if ($usertype == 'ADMIN') { ?>
            <a href="./index.php?a_link=master_users">Users</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <?php } ?>
          <?php if ($usertype <> 'EXECUTIVE-OTHERS' && $usertype <> 'EXECUTIVE-ONSITE') { ?>
            <a href="./index.php?a_link=master_locations">Locations</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <?php } ?>

          <a href="./index.php?a_link=master_product">Products</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=master_version">Versions</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;

          <?php if ($usertype <> 'EXECUTIVE-OTHERS' && $usertype <> 'EXECUTIVE-ONSITE') { ?>
            <a href="./index.php?a_link=master_osemployees">Out Station
              Employees</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="./index.php?a_link=master_dealers">Dealers</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="./index.php?a_link=master_category">Categories</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="./index.php?a_link=master_supportunit">Support
              Units</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <?php } ?>
          <?php if ($usertype == 'ADMIN') { ?>
            <a href="./index.php?a_link=master_nonworkingdays">Non Working Days</a>
          <?php } ?>
        </div>
        <div style="display:none" id="tabgroup1t5"></div>
        <div style="display:none" id="tabgroup1c5">
          <?php if ($usertype <> 'MANAGEMENT') { ?>
            <a href="./index.php?a_link=profile_viewprofile">View
              Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <?php } ?>
          <a href="./index.php?a_link=profile_editprofile">Edit
            Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=profile_changepassword">Change Password</a>
        </div>
        <div style="display:none" id="tabgroup1t6"></div>
        <div style="display:none" id="tabgroup1c6">
          <a href="http://www.relyonsoft.com"
            target="_blank">Relyonsoft.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saraltds.com/"
            target="_blank">Saraltds.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saralvat.com"
            target="_blank">Saralvat.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saraltaxoffice.com/"
            target="_blank">Saraltaxoffice.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saralpaypack.com/"
            target="_blank">Saralpaypack.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://www.saralaccounts.com/"
            target="_blank">Saralaccounts.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://saralxbrl.in/" target="_blank">Saralxbrl.in</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="http://userlogin.relyonsoft.com/" target="_blank">Userlogin.relyonsoft.com</a>
        </div>
        <div style="display:none" id="tabgroup1t7"></div>
        <div style="display:none" id="tabgroup1c7">
          <a href="./index.php?a_link=kb_view">View KB</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./index.php?a_link=kb_add">Add Topics</a>
        </div>
      </td>
    </tr>
  </table>
<?php } ?>