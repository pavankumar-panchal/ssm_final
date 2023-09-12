<?php
function send_mail($sub,$file_htm,$file_txt)
{
//	global $myemail;
	global $form_product;
	global $form_productcode;
	global $form_patch;
	global $form_filesize;
	global $DPC_date;
	global $form_verfrom;
	global $form_url;
	global $show_web;
	global $check_web;
	global $form_hotfix;
	global $form_title;
	global $form_desc;
	global $form_disable;
	global $form_link;
	
#########  Mailing Starts -----------------------------------
	$mymail = ''. ', ';
	#$mymail = 'bhavesh.d@relyonsoft.com';
	if($_SERVER['HTTP_HOST'] == "hejal" || $_SERVER['HTTP_HOST'] == "192.168.2.78")
	{
		$mymail = 'hejalkumari.p@relyonsoft.com,bhumika.p@relyonsoft.com';
	}
	else
	{
	
		#$mymail = 'hejalkumari.p@relyonsoft.com';
	}
	$emailarray = explode(',',$mymail);
	$emailcount = count($emailarray);
	
	for($i = 0; $i < $emailcount; $i++)
	{
		if(checkemailaddress($emailarray[$i]))
		{
				$mymails[$emailarray[$i]] = $emailarray[$i];
		}
	}
	#$mail = 'hejalkumari.p@relyonsoft.com';
	$fromname = 'Webmaster';
	$fromemail = $mail;
	
	$msg = file_get_contents($file_htm);
	$textmsg = file_get_contents($file_txt);
	require_once("inc/RSLMAIL_MAIL.php");
	
	$array = array();
	$array[] = "##PRODUCT##%^%".$form_product;
	$array[] = "##CODE##%^%".$form_productcode;
	$array[] = "##PATCH##%^%".$form_patch;
	$array[] = "##SIZE##%^%".$form_filesize;
	$array[] = "##DATE##%^%".date("d M Y",strtotime($DPC_date));
	$array[] = "##VERFROM##%^%".$form_verfrom;
	$array[] = "##URL##%^%".$form_url;
	$array[] = "##SHOWINWEB##%^%".$show_web;
	$array[] = "##CHECKINWEB##%^%".$check_web;
	$array[] = "##HOTFIX##%^%".$form_hotfix;
	$array[] = "##TITLE##%^%".$form_title;
	$array[] = "##DESC##%^%".$form_desc;
	$array[] = "##DISABLE##%^%".$form_disable;
	$array[] = "##LINK##%^%".$form_link;
	
	$textarray = array();
	$textarray[] = "##PRODUCT##%^%".$form_product;
	$textarray[] = "##CODE##%^%".$form_productcode;
	$textarray[] = "##PATCH##%^%".$form_patch;
	$textarray[] = "##SIZE##%^%".$form_filesize;
	$textarray[] = "##DATE##%^%".$DPC_date;
	$textarray[] = "##VERFROM##%^%".$form_verfrom;
	$textarray[] = "##URL##%^%".$form_url;
	$textarray[] = "##SHOWINWEB##%^%".$show_web;
	$textarray[] = "##CHECKINWEB##%^%".$check_web;
	$textarray[] = "##HOTFIX##%^%".$form_hotfix;
	$textarray[] = "##TITLE##%^%".$form_title;
	$textarray[] = "##DESC##%^%".$form_desc;
	$textarray[] = "##DISABLE##%^%".$form_disable;
	$textarray[] = "##LINK##%^%".$form_link;

	$toarray = $mymails;
	if($_SERVER['HTTP_HOST'] == "hejal" || $_SERVER['HTTP_HOST'] == "192.168.2.78")
	{
		$bccmymails['Bhavesh'] ='bhavesh@relyonsoft.com';
		$bccmymails['Hejal'] ='hejalkumari.p@relyonsoft.com';
	}
	else
	{
		$bccmymails['bigmail'] ='bigmail@relyonsoft.com';
		#$bccmymails['Relyonimax'] ='relyonimax@gmail.com';
	}
	$bccarray = $bccmymails;
	
	
	$msg = replacemailvariable($msg,$array);
	$textmsg = replacemailvariable($textmsg,$textarray);
	$subject = $sub;
	$html = $msg;
	$text = $textmsg;
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, null,$bccarray, null);
}
?>