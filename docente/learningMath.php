<?php
require ('../checkSession.php');

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

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
			<button class="buttonBack" onclick="javascript:history.go(-1);"><span>Regresar</span></button>
			<div class='text-center'>
				<h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
			</div>
			<hr />
			
			<?php 
			
			$learningController = new LearningContextController();
			$learningList = $learningController -> displayAction();
			$learningTotal = count($learningList);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$learningArray5 = array();
			$learningArray6 = array();
			$learningArray7 = array();
			$learningArray8 = array();
			$learningName1 = array("0" => "No tengo la habilidad", "1" => "Tengo poca habilidad", "2" => "Tengo habilidad", "3" => "Tengo mucha habilidad", "4" => "Sin respuesta");
			$colorGraphic = array("0" => "#F04747", "1" => "#E9F26D", "2" => "#BFFEE6", "3" => "#3AC777", "4" => "#B0B0B0");
			
			foreach ($learningList as $learningEntry) {
				
				switch($learningEntry->getP14O5()) {
					case 0 :
						++$learningArray5[0];
						break;
					case 1 :
						++$learningArray5[1];
						break;
					case 2 :
						++$learningArray5[2];
						break;
					case 3 :
						++$learningArray5[3];
						break;
					case 999 :
						++$learningArray5[4];
						break;
				}
				
				switch($learningEntry->getP14O6()) {
					case 0 :
						++$learningArray6[0];
						break;
					case 1 :
						++$learningArray6[1];
						break;
					case 2 :
						++$learningArray6[2];
						break;
					case 3 :
						++$learningArray6[3];
						break;
					case 999 :
						++$learningArray6[4];
						break;
				}
				
				switch($learningEntry->getP14O7()) {
					case 0 :
						++$learningArray7[0];
						break;
					case 1 :
						++$learningArray7[1];
						break;
					case 2 :
						++$learningArray7[2];
						break;
					case 3 :
						++$learningArray7[3];
						break;
					case 999 :
						++$learningArray7[4];
						break;
				}
				
				switch($learningEntry->getP14O8()) {
					case 0 :
						++$learningArray8[0];
						break;
					case 1 :
						++$learningArray8[1];
						break;
					case 2 :
						++$learningArray8[2];
						break;
					case 3 :
						++$learningArray8[3];
						break;
					case 999 :
						++$learningArray8[4];
						break;
				}
			}
			
			$data5 = "[";
			for ($i = 0; $i < count($learningName1); $i++) {
				$learningPercent5 = round(($learningArray5[$i] / $learningTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$learningName1[$i]."', 'Frecuencia', '" . $learningArray5[$i] . "')";
				$data5 .= "['" . $learningName1[$i] . "'," . $learningPercent5 . ",'" . $learningPercent5 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data5 .= ']';

			$data6 = "[";
			for ($i = 0; $i < count($learningName1); $i++) {
				$learningPercent6 = round(($learningArray6[$i] / $learningTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$learningName1[$i]."', 'Frecuencia', '" . $learningArray6[$i] . "')";
				$data6 .= "['" . $learningName1[$i] . "'," . $learningPercent6 . ",'" . $learningPercent6 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data6 .= ']';

			$data7 = "[";
			for ($i = 0; $i < count($learningName1); $i++) {
				$learningPercent7 = round(($learningArray7[$i] / $learningTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$learningName1[$i]."', 'Frecuencia', '" . $learningArray7[$i] . "')";
				$data7 .= "['" . $learningName1[$i] . "'," . $learningPercent7 . ",'" . $learningPercent7 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data7 .= ']';

			$data8 = "[";
			for ($i = 0; $i < count($learningName1); $i++) {
				$learningPercent8 = round(($learningArray8[$i] / $learningTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$learningName1[$i]."', 'Frecuencia', '" . $learningArray8[$i] . "')";
				$data8 .= "['" . $learningName1[$i] . "'," . $learningPercent8 . ",'" . $learningPercent8 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data8 .= ']';
			
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
					<p>
					 	El factor autoeficacia en matem&aacute;ticas, compuesto de cuatro &iacute;tems, refiere a la convicci&oacute;n del estudiante 
					 	de resolver satisfactoriamente problemas de matem&aacute;ticas (OCDE, 2013, 2015). En este estudio se cuestion&oacute; el 
					 	sentido num&eacute;rico y algebraico. Los resultados muestran que los estudiantes de sexto grado se sienten con m&aacute;s 
					 	confianza en identificar la parte entera y decimal de un n&uacute;mero y utilizar los criterios de divisibilidad en la 
					 	identificaci&oacute;n del residuo; y lo que m&aacute;s consideran que se les dificulta es identificar los elementos de una 
					 	ecuaci&oacute;n, aunque esto &uacute;ltimo se ense&ntilde;a con mayor profundidad en el nivel de secundaria.
					</p>
				</div>
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div id="chart5_learning" class="col-xs-12 col-md-6 factorGraph"></div>
				<div id="chart6_learning" class="col-xs-12 col-md-6 factorGraph"></div>
				<div id="chart7_learning" class="col-xs-12 col-md-6 factorGraph"></div>
				<div id="chart8_learning" class="col-xs-12 col-md-6 factorGraph"></div>
			</div>
			
			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data5 = <?php echo $data5; ?>;
				var data6 = <?php echo $data6; ?>;
				var data7 = <?php echo $data7; ?>;
				var data8 = <?php echo $data8; ?>;
				var dataRegion = <?php echo $dataRegion; ?>;
	
				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart5);
				google.charts.setOnLoadCallback(drawChart6);
				google.charts.setOnLoadCallback(drawChart7);
				google.charts.setOnLoadCallback(drawChart8);
				google.charts.setOnLoadCallback(drawChartRegion);
				
				function drawChart5() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data5);
			
					var options = {
						height : 400,
						width : 600,
						title : 'Identificar la parte entera y parte decimal o fraccionaria de un n\u00FAmero.',
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
			
					new google.visualization.ComboChart(document.getElementById('chart5_learning')).draw(data, options);
			
				}
				
				function drawChart6() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data6);
			
					var options = {
						height : 400,
						width : 600,
						title : 'Utilizar los criterios de divisibilidad en la identificaci\u00F3n del residuo de diversas cantidades.',
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
			
					new google.visualization.ComboChart(document.getElementById('chart6_learning')).draw(data, options);
			
				}
				
				function drawChart7() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data7);
			
					var options = {
						height : 400,
						width : 600,
						title : 'Escribir en notaci\u00F3n cient\u00EDfica diversas cantidades.',
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
			
					new google.visualization.ComboChart(document.getElementById('chart7_learning')).draw(data, options);
			
				}
				
				function drawChart8() {
					var data = new google.visualization.DataTable();
					 data.addColumn('string', 'Valor');
					 data.addColumn('number', 'Frecuencia');
					 data.addColumn({'type': 'string', 'role': 'annotation'});
					 data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					 data.addColumn({'type': 'string', 'role': 'style'});
					 data.addRows(data8);
			
					var options = {
						height : 400,
						width : 600,
						title : 'Identificar los elementos de una ecuaci\u00F3n.',
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
			
					new google.visualization.ComboChart(document.getElementById('chart8_learning')).draw(data, options);
			
				}
				
				function drawChartRegion() {
					var data = google.visualization.arrayToDataTable(dataRegion);
			
					var options = {
						width : 1000,
						height : 600,
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
							width: '75%', 
							height: '70%'
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