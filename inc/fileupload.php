<?php
include('../functions/phpfunctions.php');
$date = datetimelocal('YmdHis-');
$filebasename = $date. basename( $_FILES['myfile']['name']);
$ext = substr($filebasename, strrpos($filebasename, '.') + 1);
if ($ext == "zip") 
{
	$destination_path = $_SERVER['DOCUMENT_ROOT'].'/support/uploads'.DIRECTORY_SEPARATOR;
	$result = 0;
	$target_path = $destination_path .$filebasename;
	$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/support/uploads/'.$filebasename;
	if (!file_exists($target_path)) 
	{
		if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) 
		{
//			$result = 1;
			$result = $downloadlink . "|^|" . $filebasename;
		}
		
		else 
		{
			$result = 4; //Problem during Upload
		}
	} 
	else 
	{
		$result = 3; //File Already Exists by same name
	}
} 
else 
{
	$result = 2; //Extension doesn't Match
}
sleep($result);
?>

<script language="javascript" type="text/javascript">window.top.window.stopUpload('<?php echo($result); ?>');</script>
