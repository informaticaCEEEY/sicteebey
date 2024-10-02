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
		<link rel="icon" href="../img/favicon_.png">
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

			$socioaffectiveEnvironmentController = new SocioaffectiveEnvironmentController();
			$socioaffectiveEnvironmentList = $socioaffectiveEnvironmentController -> display2Action();
			$socioaffectiveEnvironmentTotal = count($socioaffectiveEnvironmentList);

			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));

			$factorStateController = new FactorStateController();
			$whereRegion = "factor LIKE :factor";
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$socioaffectiveEnvironmentArray1 = array();
			$socioaffectiveEnvironmentArray2 = array();
			$socioaffectiveEnvironmentArray3 = array();
			$socioaffectiveEnvironmentArray4 = array();
			$socioaffectiveEnvironmentName1 = array("1" => "Nunca o casi nunca", "2" => "Algunas veces", "3" => "Siempre o casi siempre", "999" => "Sin respuesta");
			$colorGraphic = array("1" => "#F04747", "2" => "#E9F26D", "3" => "#3AC777", "999" => "#B0B0B0");
            $socioaffectiveEnvironmentListAnswers = array();

			foreach ($socioaffectiveEnvironmentList as $socioaffectiveEnvironmentEntry) {
			    $socioaffectiveEnvironmentListAnswers['P01'][] = $socioaffectiveEnvironmentEntry['P01'];
                $socioaffectiveEnvironmentListAnswers['P02'][] = $socioaffectiveEnvironmentEntry['P02'];
                $socioaffectiveEnvironmentListAnswers['P03'][] = $socioaffectiveEnvironmentEntry['P03'];
                $socioaffectiveEnvironmentListAnswers['P04'][] = $socioaffectiveEnvironmentEntry['P04'];
			}



            $socioaffectiveEnvironmentTotalAnswers[1] = array_count_values($socioaffectiveEnvironmentListAnswers['P01']);
            $socioaffectiveEnvironmentTotalAnswers[2] = array_count_values($socioaffectiveEnvironmentListAnswers['P02']);
            $socioaffectiveEnvironmentTotalAnswers[3] = array_count_values($socioaffectiveEnvironmentListAnswers['P03']);
            $socioaffectiveEnvironmentTotalAnswers[4] = array_count_values($socioaffectiveEnvironmentListAnswers['P04']);

			$data1 = "[";
			for ($i = 1; $i <= count($socioaffectiveEnvironmentName1); $i++) {
			    if($i == count($socioaffectiveEnvironmentName1)){
			        $i = 999;
			    }
				$socioaffectiveEnvironmentPercent1 = round(($socioaffectiveEnvironmentTotalAnswers[1][$i] / $socioaffectiveEnvironmentTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$socioaffectiveEnvironmentName1[$i]."', 'Frecuencia', '" . $socioaffectiveEnvironmentTotalAnswers[1][$i] . "')";
				$data1 .= "['" . $socioaffectiveEnvironmentName1[$i] . "'," . $socioaffectiveEnvironmentPercent1 . ",'" . $socioaffectiveEnvironmentPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';

			$data2 = "[";
			for ($i = 1; $i <= count($socioaffectiveEnvironmentName1); $i++) {
			    if($i == count($socioaffectiveEnvironmentName1)){
                    $i = 999;
                }
				$socioaffectiveEnvironmentPercent2 = round(($socioaffectiveEnvironmentTotalAnswers[2][$i] / $socioaffectiveEnvironmentTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$socioaffectiveEnvironmentName1[$i]."', 'Frecuencia', '" . $socioaffectiveEnvironmentTotalAnswers[2][$i] . "')";
				$data2 .= "['" . $socioaffectiveEnvironmentName1[$i] . "'," . $socioaffectiveEnvironmentPercent2 . ",'" . $socioaffectiveEnvironmentPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 1; $i <= count($socioaffectiveEnvironmentName1); $i++) {
			    if($i == count($socioaffectiveEnvironmentName1)){
                    $i = 999;
                }
				$socioaffectiveEnvironmentPercent3 = round(($socioaffectiveEnvironmentTotalAnswers[3][$i] / $socioaffectiveEnvironmentTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$socioaffectiveEnvironmentName1[$i]."', 'Frecuencia', '" . $socioaffectiveEnvironmentTotalAnswers[3][$i] . "')";
				$data3 .= "['" . $socioaffectiveEnvironmentName1[$i] . "'," . $socioaffectiveEnvironmentPercent3 . ",'" . $socioaffectiveEnvironmentPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$data4 = "[";
			for ($i = 1; $i <= count($socioaffectiveEnvironmentName1); $i++) {
			    if($i == count($socioaffectiveEnvironmentName1)){
                    $i = 999;
                }
				$socioaffectiveEnvironmentPercent4 = round(($socioaffectiveEnvironmentTotalAnswers[4][$i] / $socioaffectiveEnvironmentTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$socioaffectiveEnvironmentName1[$i]."', 'Frecuencia', '" . $socioaffectiveEnvironmentTotalAnswers[4][$i] . "')";
				$data4 .= "['" . $socioaffectiveEnvironmentName1[$i] . "'," . $socioaffectiveEnvironmentPercent4 . ",'" . $socioaffectiveEnvironmentPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data4 .= ']';

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
				<div id="chart1_socioaffectiveEnvironment" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart2_socioaffectiveEnvironment" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_socioaffectiveEnvironment" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart4_socioaffectiveEnvironment" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			</div>
			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>

				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var data4 = <?php echo $data4; ?>;
				var dataRegion = <?php echo $dataRegion; ?>;

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChart4);
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
						width : 600,
						title : 'Se interesa por conocer mis preocupaciones, intereses e inquietudes personales',
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

					new google.visualization.ComboChart(document.getElementById('chart1_socioaffectiveEnvironment')).draw(data, options);

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
						title : 'Conversa con mis padres sobre mi desempe\u00F1o',
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

					new google.visualization.ComboChart(document.getElementById('chart2_socioaffectiveEnvironment')).draw(data, options);

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
						title : 'Reconoce, ante los dem\u00e1s, mis buenas ideas',
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

					new google.visualization.ComboChart(document.getElementById('chart3_socioaffectiveEnvironment')).draw(data, options);

				}

				function drawChart4() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data4);

					var options = {
						height : 400,
						width : 600,
						title : 'Me indica por qu\u00e9 est\u00e1 correcto lo que dije',
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

					new google.visualization.ComboChart(document.getElementById('chart4_socioaffectiveEnvironment')).draw(data, options);

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
