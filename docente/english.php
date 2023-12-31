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

if (!$factor) {
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
			<button class="buttonBack" onclick="javascript:history.go(-1);"><span>Regresar</span></button>
			<div class='text-center'>
				<h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
			</div>
			<hr />
			
			<?php 
			
			$englishController = new EnglishContextController();
			$englishList = $englishController->displayAction();
			$englishTotal = count($englishList);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$englishArray1 = array();
			$englishArray2 = array();
			$englishArray3 = array();
			$englishName1 = array("0" => "No tengo la habilidad", "1" => "Tengo poca habilidad", "2" => "Tengo habilidad", "3" => "Tengo mucha habilidad", "4" => "Sin respuesta");
			$colorGraphic = array("0" => "#F04747", "1" => "#E9F26D", "2" => "#BFFEE6", "3" => "#3AC777", "4" => "#B0B0B0");
			
			foreach ($englishList as $englishEntry) {

				switch($englishEntry->getP14O9()) {
					case 0 :
						++$englishArray1[0];
						break;
					case 1 :
						++$englishArray1[1];
						break;
					case 2 :
						++$englishArray1[2];
						break;
					case 3 :
						++$englishArray1[3];
						break;
					case 999 :
						++$englishArray1[4];
						break;
				}
				
				switch($englishEntry->getP14O10()) {
					case 0 :
						++$englishArray2[0];
						break;
					case 1 :
						++$englishArray2[1];
						break;
					case 2 :
						++$englishArray2[2];
						break;
					case 3 :
						++$englishArray2[3];
						break;
					case 999 :
						++$englishArray2[4];
						break;
				}
				
				switch($englishEntry->getP14O11()) {
					case 0 :
						++$englishArray3[0];
						break;
					case 1 :
						++$englishArray3[1];
						break;
					case 2 :
						++$englishArray3[2];
						break;
					case 3 :
						++$englishArray3[3];
						break;
					case 999 :
						++$englishArray3[4];
						break;
				}
				
				
				
			}

			$data1 = "[";
			for ($i = 0; $i < count($englishName1); $i++) {
				$englishPercent1 = round(($englishArray1[$i] / $englishTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$englishName1[$i]."', 'Frecuencia', '" . $englishArray1[$i] . "')";
				$data1 .= "['" . $englishName1[$i] . "'," . $englishPercent1 . ",'" . $englishPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';
			

			$data2 = "[";
			for ($i = 0; $i < count($englishName1); $i++) {
				$englishPercent2 = round(($englishArray2[$i] / $englishTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$englishName1[$i]."', 'Frecuencia', '" . $englishArray2[$i] . "')";
				$data2 .= "['" . $englishName1[$i] . "'," . $englishPercent2 . ",'" . $englishPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($englishName1); $i++) {
				$englishPercent3 = round(($englishArray3[$i] / $englishTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$englishName1[$i]."', 'Frecuencia', '" . $englishArray3[$i] . "')";
				$data3 .= "['" . $englishName1[$i] . "'," . $englishPercent3 . ",'" . $englishPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
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
					<p>
					 	Este factor, compuesto de tres &iacute;tems, valora la confianza del estudiante para leer textos escritos en idioma 
					 	ingl&eacute;s (CENEVAL, 2013). Los valores bajos del &iacute;ndice se&ntilde;alan poca confianza de su capacidad para leer 
					 	textos en ingl&eacute;s; y valores altos indican m&aacute;s confianza. El promedio del Estado es -.38, y la 
					 	distribuci&oacute;n del &iacute;ndice se inclina hacia valores bajos. Se encontr&oacute; que los estudiantes se perciben 
					 	con m&aacute;s confianza en comprender informaci&oacute;n en ingl&eacute;s del internet, y perciben menos confianza en 
					 	comprender libros de esparcimiento escritos en ingl&eacute;s.
					</p>
				</div>
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div id="chart1_english" class="col-xs-12 col-md-6 factorGraph"></div>
				<div id="chart2_english" class="col-xs-12 col-md-6 factorGraph"></div>
				<div id="chart3_english" class="col-xs-12 col-md-6 factorGraph"></div>
			</div>

			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var dataRegion = <?php echo $dataRegion; ?>;

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
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
						width : 600,
						title : 'Comprender informaci\u00F3n en ingl\u00E9s del Internet',
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
								annotations: {textStyle: {color: 'black' }}
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
			
					new google.visualization.ComboChart(document.getElementById('chart1_english')).draw(data, options);
			
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
						title : 'Comprender textos acad\u00E9micos (libros, revistas) en ingl\u00E9s',
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
								annotations: {textStyle: {color: 'black' }}
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
			
					new google.visualization.ComboChart(document.getElementById('chart2_english')).draw(data, options);
			
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
						title : 'Comprender libros de esparcimiento escritos en ingl\u00E9s',
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
								annotations: {textStyle: {color: 'black' }}
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
			
					new google.visualization.ComboChart(document.getElementById('chart3_english')).draw(data, options);
			
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
		</div>
		<?php include ('../footer.php'); ?>
	</body>
</html>