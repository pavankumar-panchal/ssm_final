<?php
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("display_errors", 1);
include('./functions/phpfunctions.php');
if (imaxgetcookie('ssmuserid') <> false) {
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
				header("location:" . $url);

			}
		} else {
			$message = '<span class="error-message"> Login not registered </span>';
		}
	}
}
if (isset($_POST["clear"])) {
	$message = '';
}

?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
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
</head>

<body bgcolor="#FFFFFF"
	onload="document.submitform.username.focus(); SetCookie('logincookiejs','logincookiejs'); if(!GetCookie('logincookiejs')) document.getElementById('form-error').innerHTML = '<span class=\'error-message\'>Enable cookies for this site </span>';">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="middle">
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td height="100"></td>
					</tr>
					<tr>
						<td>
							<form id="submitform" name="submitform" method="post" action="">
								<table width="25%" border="0" align="center" cellpadding="3" cellspacing="0">
									<tr>
										<td>
											<div align="left"><img src="./images/ssm-new-logo.jpg" border="0"
													height="50" /></div>
										</td>
										<td valign="bottom">
											<div align="center">
												<font color="#E36E38"><strong>Version 2.00</strong></font>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									<tr bgcolor="#e2e1e1">
										<td colspan="2" height="2" style="padding:0"><img src="images/space.gif"
												width="1" height="2" /></td>
									</tr>
									<tr bgcolor="#a9a9a9">
										<td colspan="2" height="3" style="padding:0"><img src="images/space.gif"
												width="1" height="3" /></td>
									</tr>
									<tr>
										<td colspan="2" style="padding:0">
											<table width="100%" border="0" cellspacing="0" cellpadding="4"
												style="border:1px solid #a9a9a9;" bgcolor="#F8F8F8">
												<tr>
													<td colspan="2" bgcolor="#F8F8F8">
														<div align="center" id="form-error">
															<noscript>
																<div class="error-message"> Enable
																	cookies/javscript/both in your browser, then </div>
															</noscript>
															<?php if ($message <> '')
																echo ($message); ?>
														</div>
													</td>
												</tr>
												<tr>
													<td width="37%" bgcolor="#F8F8F8">User Name:</td>
													<td width="63%" bgcolor="#F8F8F8"><input name="username" type="text"
															class="form-fileds" id="username" size="25" /></td>
												</tr>
												<tr>
													<td bgcolor="#F8F8F8">Password:</td>
													<td bgcolor="#F8F8F8"><input name="password" type="password"
															class="form-fileds" id="password" size="25" /></td>
												</tr>
												<tr>
													<td colspan="2" height="4"></td>
												</tr>
												<tr>
													<td colspan="2" align="center" bgcolor="#F8F8F8"><input name="login"
															type="submit" class="swiftchoicebutton-red" id="login"
															value="Login" onclick="checknavigatorproperties()" />
														&nbsp;&nbsp;&nbsp;
														<input name="clear" type="reset" class="swiftchoicebutton-red"
															id="clear" value="Clear" onclick="clearinnerhtml();" />
													</td>
												</tr>

											</table>
										</td>
									</tr>
									<tr bgcolor="#a9a9a9">
										<td colspan="2" height="3" style="padding:0"><img src="images/space.gif"
												width="1" height="3" /></td>
									</tr>
									<tr bgcolor="#e2e1e1">
										<td colspan="2" height="2" style="padding:0"><img src="images/space.gif"
												width="1" height="3" /></td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
					<tr>
						<td height="14"></td>
					</tr>
					<tr>
						<td align="center" class="page-footer">A product of Relyon Web Management | Copyright © 2012
							Relyon Softech Ltd. All rights reserved.</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>