// JavaScript Document

google.load('visualization', '1', { 'packages': ['annotatedtimeline'] });
//google.setOnLoadCallback(gettimelinedata);


function gettimelinedata() {
	var form = document.submitform;
	var register = document.getElementsByName('register[]');
	var error = document.getElementById('form-error');
	var registerflag = false;
	for (var i = 0; i < register.length; i++) {
		if (register[i].checked == true && registerflag == false)
			registerflag = true;
	}
	if (registerflag != true) { error.innerHTML = errormessage('Select a Register.'); register[0].focus(); return false; }
	var field = form.fromdate;
	if (!field.value) { error.innerHTML = errormessage('Enter the From Date.'); field.focus(); return false; }
	var field = form.todate;
	if (!field.value) { error.innerHTML = errormessage('Enter the To Date.'); field.focus(); return false; }
	else {
		register_value = get_check_value('register[]');
		var ajax1 = false;
		ajax1 = createajax();
		error.innerHTML = '';
		var queryString = "../ajax/annotatedtimechart-adv.php?register=" + register_value + "&fromdate=" + form.fromdate.value + "&todate=" + form.todate.value + "&userid=" + form.userid.value + "&status=" + form.status.value + "&category=" + form.category.value + "&dealer=" + form.dealer.value + "&customer=" + form.customer.value + "&ssmuser=" + form.ssmuser.value + "&supportunit=" + form.supportunit.value + "&anonymous=" + getradiovalue(form.anonymous) + "&employee=" + form.employee.value + "&dummy=" + Math.floor(Math.random() * 100032680100) + "&reqtype=anotatedtimeline";
		ajax1.open("GET", queryString, true);
		ajax1.onreadystatechange = function () {
			if (ajax1.readyState == 4) {
				var ajaxresponse = ajax1.responseText;
				//document.getElementById('chart_div').innerHTML = ajaxresponse;
				drawChart(ajaxresponse, form.fromdate.value, form.todate.value);
			}
		}
		ajax1.send(null);
	}
}

function drawChart(datafortimeline, fromdate1, todate1) {
	var fromdate = fromdate1.split('-');
	var todate = todate1.split('-');
	var data = new google.visualization.DataTable();

	var mainStrings = datafortimeline.split("^#*#^");
	var headingsFormats = mainStrings[0];
	var tableValues = mainStrings[1];

	var headingsFormat = headingsFormats.split("^##^");
	var totalColumns = headingsFormat.length;

	var temp;
	var Heading;
	var Format;
	for (i = 0; i < totalColumns; i++) {
		temp = headingsFormat[i].split("^*^");
		Heading = temp[0];
		Format = temp[1];
		data.addColumn(Format, Heading);
	}


	var tableLine = tableValues.split("^##^");
	var totalRows = parseInt(tableLine.length);

	data.addRows(totalRows);

	var Line;
	var value;
	var lineValues;
	var dateValue;
	for (row = 0; row < totalRows; row++) {
		lineValues = tableLine[row].split("^*^");

		for (column = 0; column < totalColumns; column++) {
			value = lineValues[column];
			if (column == 0) {
				dateValue = value.split("^^");
				data.setValue(row, column, new Date(dateValue[0], dateValue[1], dateValue[2]));
			}
			else {
				if ((column + 2) % 3 == 0)
					value = parseInt(value);
				data.setValue(row, column, value);
			}
		}
	}

	var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div'));
	chart.draw(data, { displayAnnotations: true, legendPosition: 'newRow', wmode: 'transparent' });
	chart.setVisibleChartRange(new Date(fromdate[2], fromdate[1], fromdate[0]), new Date(todate[2], todate[1], todate[0]))
}

