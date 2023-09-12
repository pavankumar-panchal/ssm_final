
<?php
if(imaxgetcookie('ssmuserid') == false) { $url = '../index.php'; header("Location:".$url); }
session_start();
if(isset($_SESSION['verification']))
{
	if($_SESSION['verification'] <> '4563464364365' || imaxgetcookie('ssmuserid') =='')
	{ $url = '../index.php'; header("Location:".$url); }
}
else
{ $url = '../index.php'; header("location:".$url); }
?>