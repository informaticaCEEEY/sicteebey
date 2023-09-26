<?php
require ('../checkSession.php');

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (!isset($_POST['factor'])) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
} else {
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new FactorController();
	$factorObject = $controller -> getEntityAction($factor);
}

if (!$factorObject) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}
?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- html5.js for IE less than 9 -->
		<!--[if lt IE 9]>
		<script
		src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<title>Cuestionarios de Contexto</title>
		<!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
		<!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
		<link rel="icon" href="../img/logog.ico">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/buttonTop.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<!--link href="../css/jquery-confirm.../css" rel="stylesheet" type="text/../css"  /-->
		<script src="../lib/jquery/jquery.min.js"></script>
		<script src="../lib/bootstrap/bootstrap.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<link rel="stylesheet" href="../css/chart.css">
		<link rel="stylesheet" href="../css/factorTable.css">
		<link rel="stylesheet" href="../css/description.css">
	</head>
	<body>
		<?php
		include ('header.php');
 ?>
		<div class="container-fluid">
			<form role="form" name="schoolFactor" id="schoolFactor" action="context.php" method="post" accept-charset="UTF-8">
				<input type="hidden" id="year" name="year" value="<?php echo($factorObject->getYearApplication()); ?>"/>
			</form>
			<button class="buttonBack" type="button" onclick="document.forms.schoolFactor.submit()"><span>Regresar</span></button>
			<div class='text-center'>
				<h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
			</div>
			<hr />
			<?php

			$dependenceTeacherController = new DependenceTeacherController();
			$dependenceTeacherList = $dependenceTeacherController -> display2Action();
			$dependenceTeacherTotal = count($dependenceTeacherList);

			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));

			$factorStateController = new FactorStateController();
			$whereRegion = "factor LIKE :factor";
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$dependenceTeacherArray1 = array();
			$dependenceTeacherArray2 = array();
			$dependenceTeacherArray3 = array();
			$dependenceTeacherName1 = array("1" => "Nunca o casi nunca", "2" => "Algunas veces", "3" => "Siempre o casi siempre", "999" => "Sin respuesta");
            $dependenceTeacherNameAB = array("1" => "Muy parecidos (as) a mí", "2" => "Algo parecidos (as)", "3" => "Algo parecidos (as)", "4" => "Muy parecidos (as) a mí", "999" => "Sin respuesta");
			$colorGraphic = array("1" => "#F04747", "2" => "#E9F26D", "3" => "#3AC777", "999" => "#B0B0B0");
            $colorGraphicAB = array("1" => "#3AC777", "2" => "#E9F26D", "3" => "#E9F26D", "4" => "#3AC777", "999" => "#B0B0B0");
            $dependenceTeacherListAnswers = array();

			foreach ($dependenceTeacherList as $dependenceTeacherEntry) {
			    $dependenceTeacherListAnswers['P01'][] = $dependenceTeacherEntry['P01'];
                $dependenceTeacherListAnswers['P02'][] = $dependenceTeacherEntry['P02'];
                $dependenceTeacherListAnswers['P03'][] = $dependenceTeacherEntry['P03'];
			}



            $dependenceTeacherTotalAnswers[1] = array_count_values($dependenceTeacherListAnswers['P01']);
            $dependenceTeacherTotalAnswers[2] = array_count_values($dependenceTeacherListAnswers['P02']);
            $dependenceTeacherTotalAnswers[3] = array_count_values($dependenceTeacherListAnswers['P03']);

			$data1 = "[";
			for ($i = 4; $i >= 0; $i--) {
			    if($i == 0){
			        $j = 999;
			    }else{
                    $j = $i;
                }
				$dependenceTeacherPercent1 = round(($dependenceTeacherTotalAnswers[1][$j] / $dependenceTeacherTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$dependenceTeacherNameAB[$j]."', 'Frecuencia', '" . $dependenceTeacherTotalAnswers[1][$j] . "')";
				$data1 .= "['" . $dependenceTeacherNameAB[$j] . "'," . $dependenceTeacherPercent1 . ",'" . $dependenceTeacherPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphicAB[$j]."'],";
			}
			$data1 .= ']';

            $data1a = "[";
            for ($i = 4; $i >= 3; $i--) {
                $dependenceTeacherPercent1 = round(($dependenceTeacherTotalAnswers[1][$i] / $dependenceTeacherTotal * 100), 2);
                $funtionTooltip = "createCustomHTMLContent('" .$dependenceTeacherNameAB[$i]."', 'Frecuencia', '" . $dependenceTeacherTotalAnswers[1][$i] . "')";
                $data1a .= "['" . $dependenceTeacherNameAB[$i] . "'," . $dependenceTeacherPercent1 . ",'" . $dependenceTeacherPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphicAB[$i]."'],";
            }
            $data1a .= ']';

            $data1b = "[";
            for ($i = 2; $i >= 0; $i--) {
                if($i == 0){
                    $j = 999;
                }else{
                    $j = $i;
                }
                $dependenceTeacherPercent1 = round(($dependenceTeacherTotalAnswers[1][$j] / $dependenceTeacherTotal * 100), 2);
                $funtionTooltip = "createCustomHTMLContent('" .$dependenceTeacherNameAB[$j]."', 'Frecuencia', '" . $dependenceTeacherTotalAnswers[1][$j] . "')";
                $data1b .= "['" . $dependenceTeacherNameAB[$j] . "'," . $dependenceTeacherPercent1 . ",'" . $dependenceTeacherPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphicAB[$j]."'],";
            }
            $data1b .= ']';

			$data2 = "[";
			for ($i = 1; $i <= count($dependenceTeacherName1); $i++) {
			    if($i == count($dependenceTeacherName1)){
                    $i = 999;
                }
				$dependenceTeacherPercent2 = round(($dependenceTeacherTotalAnswers[2][$i] / $dependenceTeacherTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$dependenceTeacherName1[$i]."', 'Frecuencia', '" . $dependenceTeacherTotalAnswers[2][$i] . "')";
				$data2 .= "['" . $dependenceTeacherName1[$i] . "'," . $dependenceTeacherPercent2 . ",'" . $dependenceTeacherPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 1; $i <= count($dependenceTeacherName1); $i++) {
			    if($i == count($dependenceTeacherName1)){
                    $i = 999;
                }
				$dependenceTeacherPercent3 = round(($dependenceTeacherTotalAnswers[3][$i] / $dependenceTeacherTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$dependenceTeacherName1[$i]."', 'Frecuencia', '" . $dependenceTeacherTotalAnswers[3][$i] . "')";
				$data3 .= "['" . $dependenceTeacherName1[$i] . "'," . $dependenceTeacherPercent3 . ",'" . $dependenceTeacherPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$dataRegion = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
			if($factorStateList[0]->getMedia() > 0){
				$dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#3AC777'],";
			}else{
				$dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#E9F26D'],";
			}
			for ($i = 0; $i < count($factorRegionList); $i++) {
				if($factorRegionList[$i]->getMedia() > 0){
					$dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#3AC777'],";
				}else{
					$dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#E9F26D'],";
				}
			}
			$dataRegion .= ']';

			?>
			<div class="row">
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>Texto
					</p>
					<p>
						Texto
					</p>
				</div>
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"><br /></div>
				<div class="col-xs-12 col-md-12 text-center"><br /><br /><p><b>Con qué frecuencia mi maestro(a) realiza lo siguiente durante las clases:</b></p><br /></div>
				<div id="chart1_dependenceTeacher" class="col-xs-12 col-md-12 factorGraph" align="center"></div>
				<div id="chart1a_dependenceTeacher" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1b_dependenceTeacher" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart2_dependenceTeacher" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_dependenceTeacher" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			</div>
			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>

				var data1 = <?php echo $data1; ?>;
				var data1a = <?php echo $data1a; ?>;
				var data1b = <?php echo $data1b; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var dataRegion = <?php echo $dataRegion; ?>;

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart1a);
				google.charts.setOnLoadCallback(drawChart1b);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChartRegion);

				function drawChart1() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data1);

					var options = {
						height : 400,
						width : 800,
						title : 'Cuando algunos ni\u00F1os comenten un error, prefieren encontrar la respuesta correcta por s\u00ed mismos',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
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
								annotations: {textStyle: {fontSize: 12, color: 'black' }}
							}
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '75%',
							height: '70%'
						}
					};

					new google.visualization.ComboChart(document.getElementById('chart1_dependenceTeacher')).draw(data, options);

				}

				function drawChart1a() {
                    var data = new google.visualization.DataTable();
                     data.addColumn('string', 'Valor');
                     data.addColumn('number', 'Frecuencia');
                     data.addColumn({'type': 'string', 'role': 'annotation'});
                     data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
                     data.addColumn({'type': 'string', 'role': 'style'});
                     data.addRows(data1a);

                    var options = {
                        height : 400,
                        width : 600,
                        title : 'Cuando algunos ni\u00F1os comenten un error, prefieren encontrar la respuesta correcta por s\u00ed mismos',
                        legend : {
                            position : 'none',
                            alignment : 'left',
                            textStyle : {
                                fontSize : 12
                            }
                        },
                        tooltip: {
                            isHtml: true
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
                                annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
                            width: '75%',
                            height: '70%'
                        }
                    };

                    new google.visualization.ComboChart(document.getElementById('chart1a_dependenceTeacher')).draw(data, options);

                }

                function drawChart1b() {
                    var data = new google.visualization.DataTable();
                     data.addColumn('string', 'Valor');
                     data.addColumn('number', 'Frecuencia');
                     data.addColumn({'type': 'string', 'role': 'annotation'});
                     data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
                     data.addColumn({'type': 'string', 'role': 'style'});
                     data.addRows(data1b);

                    var options = {
                        height : 400,
                        width : 600,
                        title : 'Otros ni\u00F1os prefieren preguntar al maestro c\u00f3mo encontrar la respuesta correcta',
                        legend : {
                            position : 'none',
                            alignment : 'left',
                            textStyle : {
                                fontSize : 12
                            }
                        },
                        tooltip: {
                            isHtml: true
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
                                annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
                            width: '75%',
                            height: '70%'
                        }
                    };

                    new google.visualization.ComboChart(document.getElementById('chart1b_dependenceTeacher')).draw(data, options);

                }

				function drawChart2() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data2);

					var options = {
						height : 400,
						width : 600,
						title : 'A algunos ni\u00F1os les gusta tratar de resolver los problemas por s\u00ed mismos',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
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
								annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
							width: '75%',
							height: '70%'
						}
					};

					new google.visualization.ComboChart(document.getElementById('chart2_dependenceTeacher')).draw(data, options);

				}

				function drawChart3() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data3);

					var options = {
						height : 400,
						width : 600,
						title : 'Algunos ni\u00F1os hacen su trabajo en clase sin ayuda del maestro ',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
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
								annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
							width: '75%',
							height: '70%'
						}
					};

					new google.visualization.ComboChart(document.getElementById('chart3_dependenceTeacher')).draw(data, options);

				}

				function drawChartRegion() {
					var data = google.visualization.arrayToDataTable(dataRegion);

					var options = {
						height : 600,
						width : 1000,
						orientation: 'vertical',
						title : 'Media por estado y regi\u00F3n',
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
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [-3, -2, -1, 0, 1, 2, 3]
						},
						vAxis : {
							title : '',
							textPosition: 'out',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [0, 1, 2, 3, 4]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
							width: '85%',
							height: '80%'
						},
					};

					var chart = new google.visualization.BarChart(document.getElementById("chartRegion"));
					chart.draw(data, options);
				}

				function createCustomHTMLContent($category1, title1, frecuency1) {
					return '<div><span cclass="tooltiptext"><b>' + $category1 + '</b></span><br />'
						 +	  '<p>' + title1 + ': <b>' + frecuency1 + '</b></p>'
						 + '</div>';
				}
			</script>
			<script>
				var onResize = function() {
				  // apply dynamic padding at the top of the body according to the fixed navbar height
				  $("body").css("padding-top", $(".navbar-fixed-top").height());
				};

				// attach the function to the window resize event
				$(window).resize(onResize);

				// call it also when the page is ready after load or reload
				$(function() {
				  onResize();
				});
			</script>
		</div>
		<?php include ('../footer.php'); ?>
	</body>
</html>
