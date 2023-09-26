google.charts.load("current", {
	packages : ['corechart']
});

google.charts.setOnLoadCallback(drawChartReportGeneral);
google.charts.setOnLoadCallback(drawChartInteractionTeacher);
google.charts.setOnLoadCallback(drawChartSchoolEnvironment1);
google.charts.setOnLoadCallback(drawChartSchoolEnvironment2);
google.charts.setOnLoadCallback(drawChartFoodConsumption);
google.charts.setOnLoadCallback(drawChartFoodConsumption1);
google.charts.setOnLoadCallback(drawChartDrinksConsumption);
google.charts.setOnLoadCallback(drawChartFamilyContext1);
google.charts.setOnLoadCallback(drawChartFamilyContext2);
google.charts.setOnLoadCallback(drawChartFamilyContext3);
google.charts.setOnLoadCallback(drawChartFamilyContext4);
google.charts.setOnLoadCallback(drawChartFamilyContext5);
google.charts.setOnLoadCallback(drawAffectiveEnvironment1);
google.charts.setOnLoadCallback(drawAffectiveEnvironment2);
google.charts.setOnLoadCallback(drawAffectiveEnvironment3);
google.charts.setOnLoadCallback(drawAffectiveEnvironment4);
google.charts.setOnLoadCallback(drawHomework);
google.charts.setOnLoadCallback(drawMayanLanguage);
google.charts.setOnLoadCallback(drawStudentsIMC);
google.charts.setOnLoadCallback(drawChartStudentsHealth);

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

function drawChartInteractionTeacher() {
	var data = google.visualization.arrayToDataTable(dataInteractionTeacher);

	var options = {
		height : 500,
		width : 1300,
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {

			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#EAD72A','#3AC777'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right : 200,
			width: '55%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartInteractionTeacher"));
	chart.draw(data, options);
}

function drawChartSchoolEnvironment1() {
	var data = google.visualization.arrayToDataTable(dataSchoolEnvironment1);

	var options = {
		height : 400,
		width : 1300,
		//title : 'De las siguientes cuestiones responde \u0022No\u0022 o \u0022S\u00ED\u0022, seg\u00FAn corresponda a tu situaci\u00F3n',
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {

			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#EAD72A','#3AC777'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right : 200,
			width: '50%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartSchoolEnvironment1"));
	chart.draw(data, options);
}

function drawChartSchoolEnvironment2() {
	var data = google.visualization.arrayToDataTable(dataSchoolEnvironment2);

	var options = {
		height : 400,
		width : 1300,
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {

			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#3AC777','#EAD72A'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right : 200,
			width: '50%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartSchoolEnvironment2"));
	chart.draw(data, options);
}

function drawChartFoodConsumption() {
	var data = google.visualization.arrayToDataTable(dataFoodConsumption);

	var options = {
		height : 550,
		width : 1300,
		title : 'Durante la semana, \u00BFcu\u00E1ntas veces consumes estos alimentos?',
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			maxLines: 5
		},
		colors:['#B0B0B0', '#EAD72A','#87FAB9', '#8DE06C', '#7ECB5F', '#30CD74', '#49BC7B', '#27A75F', '#1A7D45'],
		bar: { groupWidth: '75%' },
		hAxis : {

			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
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
			top : 50,
			right : 200,
			width: '58%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartFoodConsumption"));
	chart.draw(data, options);
}

function drawChartFoodConsumption1() {
	var data = google.visualization.arrayToDataTable(dataFoodConsumption1);

	var options = {
		height : 350,
		width : 1300,
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			maxLines: 5
		},
		colors:['#B0B0B0', '#EAD72A','#87FAB9', '#8DE06C', '#3AC777', '#1A7D45'],
		bar: { groupWidth: '35%' },
		hAxis : {

			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
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
			top : 50,
			right : 200,
			width: '58%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartFoodConsumption1"));
	chart.draw(data, options);
}

function drawChartDrinksConsumption() {
	var data = google.visualization.arrayToDataTable(dataDrinksConsumption);

	var options = {
		height : 550,
		width : 1300,
		title : 'De las siguientes bebidas, \u00BFcu\u00E1ntos vasos consumes al d\u00EDa?',
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			maxLines: 5
		},
		colors:['#B0B0B0', '#EAD72A','#87FAB9', '#8DE06C', '#3AC777', '#1A7D45'],
		bar: { groupWidth: '75%' },
		hAxis : {

			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				color : 'black',
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
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
			top : 50,
			right : 180,
			width: '60%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartDrinksConsumption"));
	chart.draw(data, options);
}

function drawChartFamilyContext1() {
	var data = google.visualization.arrayToDataTable(dataFamilyContext1);

	var options = {
		height : 500,
		width : 600,
		title : '\u00BFCon qui\u00E9n vives?',
		is3D: false,
		pieStartAngle: 100,
        legend : {
            position : 'labeled' ,
            alignment : 'end',
            textStyle : {
                fontSize : 12
            }
        },
        pieSliceText : 'none',
        chartArea : {
        	left: 25,
            width: '90%',
            height: '75%'
        }
    };

	new google.visualization.PieChart(document.getElementById('chartFamilyContext1')).draw(data, options);
}

function drawChartFamilyContext2() {
	var data = google.visualization.arrayToDataTable(dataFamilyContext2);

	var options = {
		height : 500,
		width : 600,
		title : '\u00BFQui\u00E9n te cuida cuando est\u00E1s en casa?',
		is3D: false,
		pieStartAngle: 100,
        legend : {
            position : 'labeled' ,
            alignment : 'start',
            textStyle : {
                fontSize : 12
            }
        },
        pieSliceText : 'none',
        chartArea : {
        	left: 25,
            width: '90%',
            height: '75%'
        }
    };

	new google.visualization.PieChart(document.getElementById('chartFamilyContext2')).draw(data, options);
}

function drawChartFamilyContext3() {
	var data = google.visualization.arrayToDataTable(dataFamilyContext3);

	var options = {
		height : 400,
		width : 600,
		bar: { groupWidth: '35%' },
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {
			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#EAD72A','#3AC777'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 110,
			width: '60%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartFamilyContext3"));
	chart.draw(data, options);
}

function drawChartFamilyContext4() {
	var data = google.visualization.arrayToDataTable(dataFamilyContext4);

	var options = {
		height : 500,
		width : 600,
		title : '\u00BFCon qui\u00E9n trabajas?',
		is3D: false,
		pieStartAngle: 100,
        legend : {
            position : 'labeled' ,
            alignment : 'start',
            textStyle : {
                fontSize : 12
            }
        },
        pieSliceText : 'none',
        chartArea : {
        	left: 25,
            width: '90%',
            height: '75%'
        }
    };

	new google.visualization.PieChart(document.getElementById('chartFamilyContext4')).draw(data, options);
}

function drawChartFamilyContext5() {
	var data = google.visualization.arrayToDataTable(dataFamilyContext5);

	var options = {
		height : 500,
		width : 600,
		title : '\u00BFC\u00F3mo vas a la escuela?',
		is3D: false,
		pieStartAngle: 100,
        legend : {
            position : 'labeled' ,
            alignment : 'start',
            textStyle : {
                fontSize : 12
            }
        },
        pieSliceText : 'none',
        chartArea : {
        	left: 25,
            width: '90%',
            height: '75%'
        }
    };

	new google.visualization.PieChart(document.getElementById('chartFamilyContext5')).draw(data, options);
}

function drawAffectiveEnvironment1() {
	var data = google.visualization.arrayToDataTable(dataAffectiveEnvironment1);

	var options = {
		height : 400,
		width : 1200,
		bar: { groupWidth: '35%' },
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {
			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#EAD72A','#3AC777'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right: 200,
			width: '60%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartAffectiveEnvironment1"));
	chart.draw(data, options);
}

function drawAffectiveEnvironment2() {
	var data = google.visualization.arrayToDataTable(dataAffectiveEnvironment2);

	var options = {
		height : 500,
		width : 1200,
		title : '\u00BFTus padres o familia te demuestran su afecto de las siguientes maneras?',
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {
			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#EAD72A','#3AC777'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right: 200,
			width: '60%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartAffectiveEnvironment2"));
	chart.draw(data, options);
}

function drawAffectiveEnvironment3() {
	var data = google.visualization.arrayToDataTable(dataAffectiveEnvironment3);

	var options = {
		height : 500,
		width : 600,
		title : '\u00BFSi tienes problemas, se lo dices a:?',
		is3D: false,
		pieStartAngle: 100,
        legend : {
            position : 'labeled' ,
            alignment : 'start',
            textStyle : {
                fontSize : 12
            }
        },
        pieSliceText : 'none',
        chartArea : {
        	left: 25,
            width: '90%',
            height: '75%'
        }
    };

	new google.visualization.PieChart(document.getElementById('chartAffectiveEnvironment3')).draw(data, options);
}

function drawAffectiveEnvironment4() {
	var data = google.visualization.arrayToDataTable(dataAffectiveEnvironment4);

	var options = {
		height : 500,
		width : 600,
		title : '\u00BFCu\u00E1ndo te portas mal, tus pap\u00E1s:?',
		is3D: false,
		pieStartAngle: 100,
        legend : {
            position : 'labeled' ,
            alignment : 'start',
            textStyle : {
                fontSize : 12
            }
        },
        pieSliceText : 'none',
        chartArea : {
        	left: 25,
            width: '90%',
            height: '75%'
        }
    };

	new google.visualization.PieChart(document.getElementById('chartAffectiveEnvironment4')).draw(data, options);
}

function drawHomework(){
	var data = google.visualization.arrayToDataTable(dataHomework);

	var options = {
		height : 550,
		width : 1300,
		title : '\u00BFQu\u00E9 tareas haces en casa?',
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {
			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#EAD72A','#3AC777'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right : 200,
			width: '58%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartHomework"));
	chart.draw(data, options);
}

function drawMayanLanguage(){
	var data = google.visualization.arrayToDataTable(dataMayanLanguage);

	var options = {
		height : 550,
		width : 1300,
		isStacked: 'percent',
		orientation: 'vertical',
		legend : {
			position : 'right',
			alignment : 'left',
			maxLines: 3,
			textStyle : {
				fontSize : 12
			}
		},
		hAxis : {
			ticks : [0, .25, .5, .75, 1]
		},
		vAxis : {
			title : '',
			textPosition: 'out',
			textStyle : {
				fontSize : 12,
				bold : true,
				italic : false
			}
		},
		series : {
			0 : {
				type : 'bars',
				annotations: {
					textStyle: {
						fontSize: 12,
						color: 'black'
					}
				}
			}
		},
		colors:['#B0B0B0', '#EAD72A','#3AC777'],
		animation : {
			startup : true,
			duration : 2500,
			easing : 'linear'
		},
		chartArea : {
			top : 50,
			right : 200,
			width: '58%',
			height: '70%'
		},
	};

	var chart = new google.visualization.BarChart(document.getElementById("chartMayanLanguage"));
	chart.draw(data, options);
}

function drawStudentsIMC() {
	//var data = google.visualization.arrayToDataTable(dataStudentsIMC);
	var data = new google.visualization.DataTable();
		data.addColumn('string', 'Valor');
		 // series 0
		data.addColumn('number', 'Niños');
		data.addColumn({'type': 'string', 'role': 'annotation'});
		data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
		data.addColumn({'type': 'string', 'role': 'style'});
		// series 1
		data.addColumn('number', 'Niñas');
		data.addColumn({'type': 'string', 'role': 'annotation'});
		data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
		data.addColumn({'type': 'string', 'role': 'style'});
		data.addRows(dataStudentsIMC);

	var options = {
		height: 450,
		width: 1000,
		legend: { position: 'right', alignment: 'left', textStyle: {fontSize: 12} },
		tooltip: {isHtml: true},
		hAxis: {
        			title: '',
        			titleTextStyle: {color: 'black', fontSize: 14, bold: true, italic: false}
        },
        vAxis: {
        			title: 'Porcentaje',
        			titleTextStyle: {color: 'black', fontSize: 14, bold: true, italic: false}
        },
        series : {
			0 : {
				type : 'bars',
				color : '#E4ED47',
				annotations: {
					textStyle: {fontSize: 12, color: 'black' },
					alwaysOutside: true
				}
			},
	        1 : {
				type : 'bars',
				color : '#72AD66',
				annotations: {
					textStyle: {fontSize: 12, color: 'black' },
					alwaysOutside: true
				}
			}
		},
        animation: { startup: true, duration: 2500, easing: 'linear'},
        chartArea:{left:150,top:50}
    };

	new google.visualization.ComboChart(document.getElementById('chartIMC')).draw(data, options);
  //var chart = new google.visualization.ComboChart(document.getElementById("chartIMC"));
  //chart.draw(data, options);

}

function drawChartStudentsHealth() {
	var data = google.visualization.arrayToDataTable(dataStudentsHealth);

	var options = {
		height : 550,
		width : 650,
		title : '¿Qué condiciones has presentado en este curso escolar?',
		is3D: false,
		pieStartAngle: 100,
        legend : {
            position : 'left' ,
            alignment : 'start',
            textStyle : {
                fontSize : 12
            }
        },
        pieSliceText : 'none',
        chartArea : {
        	left: 60,
            width: '90%',
            height: '90%'
        }
    };

	new google.visualization.PieChart(document.getElementById('chartHealth')).draw(data, options);
}
