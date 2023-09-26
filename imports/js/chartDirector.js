google.charts.load("current", {
	packages : [ 'corechart' ]
});
google.charts.setOnLoadCallback(drawChartRegion);
google.charts.setOnLoadCallback(drawChart);

function drawChartRegion() {
	var data = google.visualization.arrayToDataTable(dataRegion);

	var options = {
		width : 1000,
		height : 600,
		orientation : 'vertical',
		title : 'Media por estado y regi\u00F3n',
		bar : {
			groupWidth : '85%'
		},
		legend : {
			position : 'none',
			alignment : 'left',
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {
			title : 'Valores',
			titleTextStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			},
			ticks : [ -10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10 ]
		},
		vAxis : {
			title : '',
			textPosition : 'out',
			titleTextStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			},
			ticks : [ 0, 1, 2, 3, 4 ]
		},
		series : {
			0 : {
				type : 'bars',
				color : '#A8FDCC',
				annotations : {
					textStyle : {
						fontSize : 12,
						color : 'black'
					}
				}
			}
		},
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			left : 100,
			top : 50,
			width : '75%',
			height : '70%'
		},
	};

	var chart = new google.visualization.BarChart(document
			.getElementById("chartRegion"));
	chart.draw(data, options);

}

function drawChart() {
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Valor');
	data.addColumn('number', 'Frecuencia');
	data.addColumn({
		'type' : 'string',
		'role' : 'annotation'
	});
	data.addColumn({
		'type' : 'string',
		'role' : 'tooltip',
		'p' : {
			'html' : true
		}
	});
	data.addColumn({
		'type' : 'string',
		'role' : 'style'
	});
	data.addRows(data);

	var options = {
		height : 400,
		width : 700,
		title : 'Pongo atenci\u00F3n en las clases',
		legend : {
			position : 'none',
			alignment : 'left',
			textStyle : {
				fontSize : 12
			}
		},
		tooltip : {
			isHtml : true
		},
		hAxis : {
			title : 'Categor\u00EDa',
			titleTextStyle : {
				color : 'black',
				fontSize : 14,
				bold : true,
				italic : false
			}
		},
		vAxis : {
			title : 'Porcentaje',
			titleTextStyle : {
				color : 'black',
				fontSize : 14,
				bold : true,
				italic : false
			},
			ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
		},
		series : {
			0 : {
				type : 'bars',
				color : '#A8FDCC',
				annotations : {
					textStyle : {
						color : 'black'
					}
				}
			}
		},
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			left : 100,
			top : 50,
			width : '70%',
			height : '70%'
		}
	};

	new google.visualization.ComboChart(document
			.getElementById('chart')).draw(data, options);

}

function createCustomHTMLContent($category1, title1, frecuency1) {
	return '<div><span cclass="tooltiptext"><b>' + $category1
			+ '</b></span><br />' + '<p>' + title1 + ': <b>' + frecuency1
			+ '</b></p>' + '</div>';
}