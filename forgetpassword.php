<?php
include('../functions/phpfunctions.php');

if($_POST['send'])
{
	$username = $_POST['username'];
	$emailid = $_POST['emailid'];
	$message = "";
	
	if($userid == "" or $emailid == "")
		$message = "Please enter your Login Name (username) and/or Email ID";

	if($message == "")
	{
		$query = "SELECT * FROM ssm_users WHERE username = '".$username."'";
		$result = runmysqlquery($query);
		$presence = mysqli_num_rows($result);

		if($presence == 0)
			$message = "This User ID is not valid.";
		else
		{
			$fetch = runmysqlqueryfetch($query);
			$usertype = $fetch['type'];
			$password = $fetch['password'];
			$referenceid = $row['referenceid'];
			switch($type)
			{
				case "A":
					$message = "Unable to proceed for Admin User.";
					break;
				default:
					$query = "SELECT officialemail FROM ssm_users WHERE username = '".$username."'";
					$result = runmysqlqueryfetch($query);
					$dbemail = $result['officialemail'];
					if($dbemail <> $emailid)
						$message = "Email ID did not match.";
					break;
			}
		}
		if($message == "")
		{
			//Email download information to user
			$Toemailid = $emailid;
			$FromName = "Relyon";
			$FromAddress =  "nithya.p@relyonsoft.com";
			$MailSubject = "Login Information.";
			$headers = 'From: '.$FromName.' <'.$FromAddress.'>' . "\r\n";
			$msg = file_get_contents("./inc/mail-password.php");
			$array = array("##EMAIL##" => $email, "##LOGINNAME##" => $username, "##PASSWORD##" => $password);
			$msg = replacemailvariable($msg,$array);
			
			if(mail($Toemailid, $MailSubject, $msg, $headers))
			{
				$message = "Login details have been emailed to ".$emailid.".";
			}
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SSSM - Forget Password</title>
<link rel="stylesheet" type="text/css" href="style/main.css">
<script language="javascript" src="functions/login.js" type="text/javascript"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="100"></td>
      </tr>
      <tr>
        <td><form id="submitform" name="submitform" method="post" action="">
          <table width="25%" border="0" align="center" cellpadding="3" cellspacing="0">
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><?php echo($date); ?></td>
              <td align="right"><?php echo($time); ?></td>
            </tr>
            
            <tr bgcolor="#e2e1e1">
              <td colspan="2" height="2" style="padding:0"><img src="images/space.gif" width="1" height="2" /></td>
            </tr>
            <tr  bgcolor="#a9a9a9">
              <td colspan="2" height="3" style="padding:0"><img src="images/space.gif"  width="1" height="3"/></td>
            </tr>
            <tr>
              <td colspan="2" style="padding:0"><table width="100%" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #a9a9a9;" bgcolor="#F8F8F8">
                  <tr>
                    <td colspan="2" bgcolor="#F8F8F8" id="form-error"><div align="center">
                      <?php if($message <> '') echo($message); ?>
                    </div></td>
                    </tr>
                  <tr>
                    <td bgcolor="#F8F8F8">User Name:</td>
                    <td bgcolor="#F8F8F8"><input name="username" type="text" class="form-fileds" id="username" size="25" /></td>
                  </tr>
                  <tr>
                    <td bgcolor="#F8F8F8">Email ID:</td>
                    <td bgcolor="#F8F8F8"><input name="emailid" type="text" class="form-fileds" id="emailid" size="25" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" height="4"></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" bgcolor="#F8F8F8"><input name="send" type="submit" class="swiftchoicebutton-red" id="send" value="Send Details" />  
                    &nbsp;&nbsp;&nbsp;
                       <input name="reset" type="reset" class="swiftchoicebutton-red" id="reset" value="Reset" onclick="clearinnerhtml();" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" bgcolor="#F8F8F8"><a href="#">Go Back to Lgin Page</a><a href="#"></a></td>
                  </tr>
              </table></td>
            </tr>
            <tr  bgcolor="#a9a9a9">
              <td colspan="2" height="3" style="padding:0"><img src="images/space.gif"  width="1" height="3" /></td>
            </tr>
            <tr bgcolor="#e2e1e1">
              <td colspan="2" height="2" style="padding:0"><img src="images/space.gif"  width="1" height="3" /></td>
            </tr>
          </table>
        </form>        </td>
      </tr>
      <tr>
        <td height="14"></td>
      </tr>
      <tr>
        <td align="center" class="page-footer">A product of Relyon Web Management | Copyright © 2008 Relyon Softech Ltd. All rights reserved.</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>