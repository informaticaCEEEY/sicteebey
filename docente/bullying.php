<?php
require ('../checkSession.php');

error_reporting(E_ALL);
ini_set('display_errors', False);
ini_set('display_startup_errors', False);

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
			
			$bullyingController = new BullyingContextController();
			$bullyingList = $bullyingController -> displayAction();
			$bullyingTotal = count($bullyingList);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$bullyingArray1 = array();
			$bullyingArray2 = array();
			$bullyingArray3 = array();
			$bullyingArray4 = array();
			$bullyingName1 = array("0" => "Nunca", "1" => "Algunas veces", "2" => "Casi siempre", "3" => "Siempre", "4" => "Sin respuesta");
			$colorGraphic = array("0" => "#3AC777", "1" => "#BFFEE6", "2" => "#E9F26D", "3" => "#F04747", "4" => "#B0B0B0");			

			foreach ($bullyingList as $bullyingEntry) {
				switch($bullyingEntry->getP9O1()) {
					case 0 :
						++$bullyingArray1[0];
						break;
					case 1 :
						++$bullyingArray1[1];
						break;
					case 2 :
						++$bullyingArray1[2];
						break;
					case 3 :
						++$bullyingArray1[3];
						break;
					case 999 :
						++$bullyingArray1[4];
						break;
				}

				switch($bullyingEntry->getP9O2()) {
					case 0 :
						++$bullyingArray2[0];
						break;
					case 1 :
						++$bullyingArray2[1];
						break;
					case 2 :
						++$bullyingArray2[2];
						break;
					case 3 :
						++$bullyingArray2[3];
						break;
					case 999 :
						++$bullyingArray2[4];
						break;
				}

				switch($bullyingEntry->getP9O3()) {
					case 0 :
						++$bullyingArray3[0];
						break;
					case 1 :
						++$bullyingArray3[1];
						break;
					case 2 :
						++$bullyingArray3[2];
						break;
					case 3 :
						++$bullyingArray3[3];
						break;
					case 999 :
						++$bullyingArray3[4];
						break;
				}

				switch($bullyingEntry->getP9O4()) {
					case 0 :
						++$bullyingArray4[0];
						break;
					case 1 :
						++$bullyingArray4[1];
						break;
					case 2 :
						++$bullyingArray4[2];
						break;
					case 3 :
						++$bullyingArray4[3];
						break;
					case 999 :
						++$bullyingArray4[4];
						break;
				}
			}

			$data1 = "[";
			for ($i = 0; $i < count($bullyingName1); $i++) {
				$bullyingPercent1 = round(($bullyingArray1[$i] / $bullyingTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray1[$i] . "')";
				$data1 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent1 . ",'" . $bullyingPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';

			$data2 = "[";
			for ($i = 0; $i < count($bullyingName1); $i++) {
				$bullyingPercent2 = round(($bullyingArray2[$i] / $bullyingTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray2[$i] . "')";
				$data2 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent2 . ",'" . $bullyingPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($bullyingName1); $i++) {
				$bullyingPercent3 = round(($bullyingArray3[$i] / $bullyingTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray3[$i] . "')";
				$data3 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent3 . ",'" . $bullyingPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$data4 = "[";
			for ($i = 0; $i < count($bullyingName1); $i++) {
				$bullyingPercent4 = round(($bullyingArray4[$i] / $bullyingTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray4[$i] . "')";
				$data4 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent4 . ",'" . $bullyingPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data4 .= ']';

			$dataRegion = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
			if($factorStateList[0]->getMedia() > 0){
				$dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#E9F26D'],";
			}else{
				$dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#3AC777'],";
			}
			for ($i = 0; $i < count($factorRegionList); $i++) {
				if($factorRegionList[$i]->getMedia() > 0){
					$dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#E9F26D'],";	
				}else{
					$dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#3AC777'],";
				}				
			}
			$dataRegion .= ']';
						
			?>
			<div class="row">								
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>El factor de acoso escolar contiene cuatro &iacute;tems que se enfocan a la percepci&oacute;n de la frecuencia en que los 
						compa&ntilde;eros de aula realizan ciertas conductas durante las clases, que por su uso reiterativo pueden convertirse en 
						hostigamiento  (Mar&iacute;n-Mart&iacute;nez &amp; Reidl-Mart&iacute;nez, 2013). Se seleccionaron &iacute;tems que involucran 
						conductas de agresiones f&iacute;sicas y burlas entre compa&ntilde;eros y hacia el profesor. 
					</p>
					<p>	
						Siendo las peleas o empujones las conductas m&aacute;s comunes o frecuentes en las aulas, y la menos com&uacute;n o muy pocas 
						veces se realizan burlas hacia los maestros. Los valores bajos indican menor intensidad de acoso escolar; por el contrario, 
						valores altos indican mayor intensidad. El &iacute;ndice tiene valores entre -3.95 a 3.72, y una distribuci&oacute;n de 
						puntuaciones hacia valores bajos.
					</p>
				</div>
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"><br /></div>
				<div id="chart3_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart2_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>				
				<div id="chart4_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>				
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
						title : 'Agresiones f\u00EDsicas como peleas o empujones',
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
			
					new google.visualization.ComboChart(document.getElementById('chart1_bullying')).draw(data, options);
			
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
						title : 'Amenazas entre compa\u00F1eros',
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
			
					new google.visualization.ComboChart(document.getElementById('chart2_bullying')).draw(data, options);
			
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
						title : 'Burlas entre compa\u00F1eros',
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
			
					new google.visualization.ComboChart(document.getElementById('chart3_bullying')).draw(data, options);
			
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
						title : 'Burlas de tus compa\u00F1eros a los maestros',
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
			
					new google.visualization.ComboChart(document.getElementById('chart4_bullying')).draw(data, options);
			
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