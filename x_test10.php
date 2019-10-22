<script type="text/javascript">
	

	function show(){
		var datepick = $("#datepick").val();
		var uri	=	'json/json.php';
		$.get(uri,{date:date}, function(data){
			

			var chart = AmCharts.makeChart("solar_chart", {
			  "type": "serial",
			  "theme": "light",
			  "legend": {
			    "position": "right",
			    "valueWidth": 100,
			    "switchType": "none"
			  },
			  "dataProvider": data,
			  "valueAxes": [{
			    "stackType": "regular",
			    "gridAlpha": 0.07,
			    "position": "left",
			    "title": "Solar Panel"
			  }],
			  "graphs": [{
			    "balloonText": "<img src='picture/voltage.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
			    "fillAlphas": 0.6,
			    "customMarker": "picture/voltage.png",
			    "lineAlpha": 0.4,
			    "title": "Solar Voltage",
			    "valueField": "p_volt"
			  }, {
			    "balloonText": "<img src='picture/current.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
			    "customMarker": "picture/current.png",
			    "fillAlphas": 0.6,
			    "lineAlpha": 0.4,
			    "title": "Solar Current",
			    "valueField": "p_cur"
			  }, {
			    "balloonText": "<img src='picture/solar-panel.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>",
			    "customMarker": "picture/solar-panel.png",
			    "fillAlphas": 0.6,
			    "lineAlpha": 0.4,
			    "title": "Solar Power",
			    "valueField": "sum_lighting"
			  }],
			  "plotAreaBorderAlpha": 0,
			  "marginTop": 10,
			  "marginLeft": 0,
			  "marginBottom": 0,
			  "chartScrollbar": {},
			  "chartCursor": {
			    "cursorAlpha": 0
			  },
			  "categoryField": "date_stamp",
			  "categoryAxis": {
			    "startOnAxis": true,
			    "axisColor": "#DADADA",
			    "gridAlpha": 0.07,
			    "title": "Date Time"
			  }
			});
		});
	}





</script>