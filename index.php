<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login System</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Custom styles for login page -->
  <!-- Include Tailwind CSS from unpkg -->
  <link href="https://unpkg.com/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="style/mainindex.css">

  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();

  include('./inc/dbconfig.php');
  include('./functions/phpfunctions.php');
  if (imaxgetcookie('ssmuserid') != false) {
    $url = './home/index.php';

    header("location:" . $url);
  } else {
    imaxdeletecookie('ssmuserid');
  }

  $date = datetimelocal('d-m-Y');
  $time = datetimelocal('H:i:s');

  $message = '';
  if (isset($_POST["login"])) {
    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];
    $logintype = 'IN';

    if ($username == '' or $password == '')
      $message = '<span class="error-message"> Enter the User Name or Password </span>';
    else {
      $query = "SELECT username,AES_DECRYPT(loginpassword,'imaxpasswordkey') as loginpassword , existinguser , 	
			locationname,type  FROM ssm_users WHERE username = '" . $username . "' and disablelogin = 'no'";

    //   $result = mysqli_query($newconnection, $query);
		$result = runmysqlquery($query);

      if (mysqli_num_rows($result) > 0) {
        $fetch = runmysqlqueryfetch($query);

        $user = $fetch['username'];
        $passwd = $fetch['loginpassword'];
        $existinguser = $fetch['existinguser'];
        $locationname = $fetch['locationname'];
        $type = $fetch['type'];
        $logintype = 'IN';

        if ($existinguser == 'no')
          $message = '<span class="error-message"> This User id not allowed to login </span>';
        elseif ($password <> $passwd)
          $message = '<span class="error-message"> Password does not match with the user </span>';
        else {
          $query = runmysqlqueryfetch("SELECT slno FROM ssm_users WHERE username = '" . $username . "'");
          $userid = $query['slno'];

          imaxcreatecookie('ssmuserid', $userid);

          $query = "INSERT INTO ssm_usertime(userid,logindate,logintime,type,locationname,logintype) values('" . $userid . "','" . changedateformat($date) . "','" . datetimelocal('H:i') . "','" . $type . "','" . $locationname . "','" . $logintype . "')";
          $result = runmysqlquery($query);

          $url = './home/index.php?a_link=home_dashboard';
          // $url = './home.php';
          header("location:" . $url);

        }
      } else {
        ?>
        <!-- $message = '<span class="error-message"> Login not registered </span>'; -->
        <div id="alert" class=" w-4/12 h-12 mb-2 m-auto top-2 relative bg-red-400 text-white px-4 py-3 rounded-lg shadow-lg">
          <div class="flex items-center justify-between">
            <span class="text-xl">Login not registered</span>
            <button id="closeBtn" class="ml-2 text-white">
              <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M13.59 12l2.7 2.7a1 1 0 01-1.42 1.4L12 13.41l-2.88 2.88a1 1 0 01-1.42-1.4l2.7-2.7-2.7-2.7a1 1 0 111.42-1.4l2.88 2.88 2.88-2.88a1 1 0 111.42 1.4l-2.7 2.7z">
                </path>
              </svg>
            </button>
          </div>
        </div>
        <?php
      }
    }
  }
  if (isset($_POST["clear"])) {
    $message = '';
  }

  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>SSM Login</title>
  <link rel="stylesheet" type="text/css" href="style/mainindex.css">
  <script language="javascript" src="./functions/javascripts.js" type="text/javascript"></script>
  <script language="javascript" src="./functions/cookies.js" type="text/javascript"></script>

  <script language="javascript">
    function checknavigatorproperties() {
      if ((navigator.cookieEnabled == false) || (!navigator.javaEnabled())) {
        document.getElementById('username').focus(); return false;
      }
      else {
        return true;
        form.submit();
      }
    }

  </script>


  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-container {
      max-width: 450px;
      margin: 0 auto;
      padding: 40px;
      border-radius: 5px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
    }

    .login-logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-logo img {
      width: 200px;
      height: auto;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .btn-link {
      color: #007bff;
    }

    .btn-link:hover {
      color: #0056b3;
    }
  </style>


</head>

<body onload="document.submitform.username.focus(); SetCookie('logincookiejs','logincookiejs'); if(!GetCookie('logincookiejs')) document.getElementById('form-error').innerHTML = '<span class=\'error-message\'>Enable cookies for this site </span>';">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="login-container">
          <div class="login-logo">
            <img src="assets/img/avatars/ssmwhite.png" alt="Logo" class="img-fluid">
          </div>
          <form id="submitform" name="submitform" method="post" action="">
            <div class="mb-3">
              <label for="username" class="form-label">User Name:</label>
              <input type="text" class="form-control form-fileds" id="username" placeholder="Enter your username"
                name="username">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password" class="form-control form-fileds" id="password" placeholder="Enter your password"
                name="password">
            </div>
            <div class="d-grid gap-2 form-actions">
              <button type="submit" class="btn btn-primary" id="login" onclick="checknavigatorproperties()"
                name="login">Login</button>
              <button type="reset" class="btn btn-secondary" name="clear" id="clear">Clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <style>
    .footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px;

    }

    /* If you want to center the text content in the footer, you can add the following styles */
    .footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px;
      position: absolute;
      left: 0;
      bottom: 0;
      width: 100%;
      /* Use calc() to set the height of the footer, adjusting it as per your needs */
      height: calc(40px + 20px);
    }
  </style>

  <div class="footer">
    A product of Relyon Web Management | Copyright © 2012
    Relyon Softech Ltd. All rights reserved.
  </div>
  <!-- Bootstrap JS (Make sure to include jQuery and Popper.js before this) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const alert = document.getElementById('alert');
    const closeBtn = document.getElementById('closeBtn');

    closeBtn.addEventListener('click', () => {
      alert.style.display = 'none';
    });
  </script>
</body>

</html>