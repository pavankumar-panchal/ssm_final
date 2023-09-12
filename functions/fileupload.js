// JavaScript Document
function startUpload()
{
	document.getElementById('f1_upload_process').innerHTML = 'Loading...<br/><img src="../images/loader.gif" />';
	document.getElementById('f1_upload_form').style.visibility = 'hidden';
	document.getElementById('f1_upload_process').style.visibility = 'visible';
	return true;
}

function stopUpload(success)
{
	var result = '';
	var spanid = document.getElementById('span_downloadlinkfile').value;
	var textfield = document.getElementById('text_filebox').value;

	switch(success)
	{
		case "2":
			result = '<span class="emsg">File Extension does not match.. It should be Zip!<\/span><br/><br/>';
			document.getElementById('f1_upload_process').innerHTML = result;
			break;
		case "3":
			result = '<span class="emsg">File Already Exists by this name!<\/span><br/><br/>';
			document.getElementById('f1_upload_process').innerHTML = result;
			break;
		case "4":
			result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
			document.getElementById('f1_upload_process').innerHTML = result;
			break;
		default:
			document.getElementById('f1_upload_process').innerHTML = '';
			var links = success.split('|^|');
			document.getElementById(textfield).value = links[1];
			document.getElementById(spanid).innerHTML = '&nbsp;<a href="' + links[0] + '"><img src="../images/download.jpg" border="0" align="absmiddle" /></a>';
			document.getElementById('fileuploaddiv').style.display='none';
			document.getElementById('fileuploadform').reset();
			break;
	}
	document.getElementById('f1_upload_form').style.visibility = 'visible';      
    document.getElementById('f1_upload_process').style.visibility = 'visible';
	return true;   
}

function fileuploaddivid(spanid,textfield,divid,top,left)
{
	var dividstyle = document.getElementById(divid).style;
	dividstyle.display='block';
	dividstyle.position = 'absolute';
	dividstyle.left = left;
	dividstyle.top = top;
	dividstyle.width = '400px';
	dividstyle.background = '#5989d5';
	
	document.getElementById('span_downloadlinkfile').value = spanid;
	document.getElementById('text_filebox').value = textfield;
}