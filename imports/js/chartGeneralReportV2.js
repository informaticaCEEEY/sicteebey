google.charts.load("current", {
	packages : ['corechart']
});

google.charts.setOnLoadCallback(drawChartReportGeneral);

function drawChartReportGeneral() {
	var data = google.visualization.arrayToDataTable(dataReportGeneral);

	var options = {
		height : 550,
		width : 1350,
		orientation: 'vertical',
		title : 'Media por factor',
		bar: { groupWidth: '85%' },
		legend : {
			position : 'none',
			alignment : 'left',
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {
			title : 'Valores',
			titleStyle : {
				color : 'black',
				fontSize : 12,
				bold : false,
				italic : false
			},
			ticks : ticks
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				color : 'black',
				fontSize : 15,
				bold : false,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				color : '#A8FDCC',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					},
					alwaysOutside: true
				}
			}
		},
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right : 300,
			width: '45%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartState"));
	chart.draw(data, options);
}
