//Function to Search the problem and solution from all the register through AJAX [Common Function]------------------
function questionloadsearch(formid)
{
	var form = document.getElementById(formid);
	var searchquery = form.searchquery.value;
	var regselect = getradiovalue(form.database);
	var selectproductname = document.getElementById('selectproductname').value;
	passData = "regselect=" + regselect + "&searchquery=" + encodeURIComponent(searchquery)  + "&selectproductname=" + encodeURIComponent(selectproductname) + "&dummy=" + Math.floor(Math.random()*1000782200000);
	ajaxcall = createajax();
	document.getElementById('wait-box').innerHTML = 'Processing <img src="../images/processing.gif" border="0"/>';
	var queryString = "../ajax/questionloadscript.php";
	ajaxcall.open("POST", queryString, true);
	ajaxcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall.onreadystatechange = function()
	{
		if(ajaxcall.readyState == 4)
		{
			document.getElementById('wait-box').innerHTML = "";
			var ajaxresponse = ajaxcall.responseText;
			document.getElementById('questionloadgrid1').innerHTML = "<font color = '#166B94'>" + ajaxresponse + "</font>";
			document.getElementById('qhiddendbinfo').value = regselect;
		}
	}
	ajaxcall.send(passData);return false;
}

//Function to select the problem and solution and places in the hiidden id------------------------------------------
function loadquestionsetselect(problem,remarks)
{
		document.getElementById('qselectvaluehidden').value = escapesinglequotes(problem) + "^" + escapesinglequotes(remarks);
}

//Single function to call in the link mentioned---------------------------------------------------------------------
function getquestion()
{
	document.getElementById('questionloadform').reset();
	questionloadsearch('questionloadform');
}

//Function to get the value of hidden fields and place it in a respective field-------------------------------------
function loadpasscuidquestion(hiddenid)
{
	var getsolution = document.getElementById('getsolution').checked;
	var temp = document.getElementById(hiddenid).value.split("^");
	var problem = temp[0];
	var solution = temp[1];

	if(document.getElementById('problem') && document.getElementById('remarks'))
	{
		document.getElementById('problem').value = problem;
		if(getsolution == true)
			document.getElementById('remarks').value = solution;
	}
	else if(document.getElementById('content') && document.getElementById('remarks'))
	{
		document.getElementById('content').value = problem;
		if(getsolution == true)
			document.getElementById('remarks').value = solution;
	}
	else if(document.getElementById('errorreported') && document.getElementById('solutiongiven'))
	{
		document.getElementById('errorreported').value = problem;
		if(getsolution == true)
			document.getElementById('solutiongiven').value = solution;
	}
	else if(document.getElementById('problem') && document.getElementById('remarks'))
	{
		document.getElementById('problem').value = problem;
		if(getsolution == true)
			document.getElementById('remarks').value = solution;
	}
	else if(document.getElementById('requirement') && document.getElementById('solutiongiven'))
	{
		document.getElementById('requirement').value = problem;
		if(getsolution == true)
			document.getElementById('solutiongiven').value = solution;
	}
}
