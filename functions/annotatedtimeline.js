// JavaScript Document

      google.load('visualization', '1', {'packages':['annotatedtimeline']});
      google.setOnLoadCallback(gettimelinedata);
	  
	  function gettimelinedata()
	  {
		var ajax1 = false;
		ajax1 = createajax();
		var queryString = "../ajax/annotatedtimeline.php?dummy=" + Math.floor(Math.random()*100032680100) + "&reqtype=anotatedtimeline";
		ajax1.open("GET", queryString, true);
		ajax1.onreadystatechange = function()
		{
			if(ajax1.readyState == 4)
			{
				var ajaxresponse = ajax1.responseText;
				drawChart(ajaxresponse);
			}
		}
		ajax1.send(null);
	  }

	function drawChart(datafortimeline) {

		var data = new google.visualization.DataTable();
        
		var mainStrings = datafortimeline.split("^#*#^");
		var headingsFormats = mainStrings[0];
		var tableValues = mainStrings[1];
		
		var headingsFormat = headingsFormats.split("^##^");
		var totalColumns = headingsFormat.length;
		
		var temp;
		var Heading;
		var Format;
		
		for(i=0; i<totalColumns;  i++)
		{
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
		for(row=0; row < totalRows; row++)
		{
			lineValues = tableLine[row].split("^*^");
			
			for(column=0; column < totalColumns; column++)
			{
				value = lineValues[column];
				if(column == 0)
				{
					dateValue = value.split("^^");
					data.setValue(row, column, new Date(dateValue[0], dateValue[1], dateValue[2]));
				}
				else
				{
					if((column+2) % 3 == 0)
						value = parseInt(value);
					data.setValue(row, column, value);
				}
			}
		}

        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div'));
        chart.draw(data, {displayAnnotations: true, wmode: 'transparent'});
//		chart.setVisibleChartRange(new Date(2009, 1, 6), new Date(2009, 1, 8))
      }
